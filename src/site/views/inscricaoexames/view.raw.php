<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');

/**
 * Classe used to deal with this view AJAX requests
 *
 * @author herberto
 *
 */
class inscricaoexamesViewinscricaoexames extends JView{
	
	function display($tpl = null){
	    
		// choose the activity
		switch(JRequest::getVar('act')){
		    case "getModulos":		    	
		    	$disciplinas_id=JRequest::getVar('disciplinas_id');
		    	
        		$user = JFactory::getUser();
		    	$user_id=$user->id;
		    	
				$this->setModel(JModel::getInstance('alunos', 'inscricaoexamesModel'));
				$modelAlunos = $this->getModel('alunos');
				$aluno=$modelAlunos->getAluno($user_id);
		    	$alunos_bi=$aluno[0]->bi;
		    					
				$this->setModel(JModel::getInstance('modulos', 'inscricaoexamesModel'));
				$model = $this->getModel('modulos');
				$modulos=$model->getModulos($disciplinas_id);
				$model = $this->getModel('inscricaoexames');
				$modulosInscritos=$model->getIDsModulosInscritos($alunos_bi);
        		$out='
			    	<table class="adminlist" width="100%">
			    	<thead>
			    		<tr align="center">
			    			<th width="30">'.JText::_( 'ID' ).'</th>
			    			<th width="30"></th>
			    			<th width="30">'.JText::_( 'NUMERO_DO_MODULO' ).'</th>
			    			<th>'.JText::_( 'NOME_DO_MODULO' ).'</th>
			    		</tr>			
			    	</thead>
			    	<tbody>
			    	';
        		for($i=0, $n=count($modulos); $i<$n; $i++){
        			$row = $modulos[$i];
        			if (in_array($row->id,$modulosInscritos)) $checked='checked';
        			else $checked='';
					$checkbox = '<input '.$checked.' id="cb'.$row->id.'" name="modulos_id" value="'.$row->id.'" onclick="inscrever(this.checked, this.value, '.$alunos_bi.');" type="checkbox">';
					$out.='<tr><td align="center">'.$row->id.'</td><td align="center">'.$checkbox.'</td><td align="center">'.$row->numero.'</td><td>'.$row->designacao.'</td></tr>'."\n";
        		}
				echo $out."</tbody></table>";
		    break;
		    
		    case "setInscricao":
		    	$modulos_id=JRequest::getVar('modulos_id');
		    	$alunos_bi=JRequest::getVar('alunos_bi');
		    	
    			$db =JFactory::getDBO();
				$modelInscr = $this->getModel('inscricaoexames');
				$this->setModel(JModel::getInstance('modulos', 'inscricaoexamesModel'));
				$modelMod = $this->getModel('modulos');
				$this->setModel(JModel::getInstance('opcoes', 'inscricaoexamesModel'));
				$modelOp = $this->getModel('opcoes');
				
				$limite_total = $modelOp->getOpcao('OP_LIMITE_INSCR_TOTAL');
				$limite_disc = $modelOp->getOpcao('OP_LIMITE_INSCR_DISC');
				
				if(($limite_total>0) && ($limite_total<=$modelInscr->countInscricoes($alunos_bi))){
					echo '2|'.JText::_( 'ERRO_GUARDAR_DADOS' ).' '.JText::_( 'MAXIMO_INSCR_TOTAL_ATINGIDO' )." ($limite_total)";	
				}
		    	elseif(($limite_disc>0) && ($limite_disc<=$modelInscr->countInscricoes($alunos_bi,$modelMod->getDiscID($modulos_id)))){
		    		echo '3|'.JText::_( 'ERRO_GUARDAR_DADOS' ).' '.JText::_( 'MAXIMO_INSCR_DISC_ATINGIDO' )." ($limite_disc)";	
		    	}
		    	else{
					if ($modelInscr->setInscricao($alunos_bi, $modulos_id, $db)){
						$modulo=$modelMod->getModulo($modulos_id);
						echo '0|'.JText::_( 'MSG_INSCRICAO' ).$modulo['numero'].' - '.$modulo['designacao'];
					}
			    	else{
			    		echo '1|'.JText::_( 'ERRO_GUARDAR_DADOS' ).$db->getErrorMsg();		    		
			    	}
		    	}		    	
		    break;
		    
		    case "resetInscricao":
		    	$modulos_id=JRequest::getVar('modulos_id');
		    	$alunos_bi=JRequest::getVar('alunos_bi');
		    	
    			$db =JFactory::getDBO();
				$model = $this->getModel('inscricaoexames');
				if ($model->resetInscricao($alunos_bi, $modulos_id, $db)){
					$this->setModel(JModel::getInstance('modulos', 'inscricaoexamesModel'));
					$model = $this->getModel('modulos');
					$modulo=$model->getModulo($modulos_id);
					echo '0|'.JText::_( 'MSG_DESINSCRICAO' ).$modulo['numero'].' - '.$modulo['designacao'];
				}
		    	else{
		    		echo '1|'.JText::_( 'ERRO_GUARDAR_DADOS' ).$db->getErrorMsg();		    		
		    	}
		    break;
		    
		    case "getAlunos":		    	
		    	$cursos_id=JRequest::getVar('cursos_id');
		    			    					
				$this->setModel(JModel::getInstance('alunos', 'inscricaoexamesModel'));
				$model = $this->getModel('alunos');
				$alunos=$model->getAlunosCurso($cursos_id);
		    	
				$this->setModel(JModel::getInstance('cursos', 'inscricaoexamesModel'));
				$modelCursos = $this->getModel('cursos');
				$cursos=$modelCursos->getCursos();
				
				$link="index?option=com_inscricaoexames&view=inscricaoexames&layout=verinscricaoaluno&user_id=";
						    	
        		$out='
			    	<table class="adminlist" width="100%">
			    	<thead>
			    		<tr align="center">
			    			<th width="30">'.JText::_( 'ID' ).'</th>
			    			<th width="80">'.JText::_( 'BI' ).'</th>
			    			<th>'.JText::_( 'NOME' ).'</th>
			    		</tr>			
			    	</thead>
			    	<body>';
        		for($i=0, $n=count($alunos); $i<$n; $i++){
        			$row = $alunos[$i];					
        			$out.='<tr><td align="center">'.$row->id.'</td><td align="center">'.$row->bi.'</td><td><a href="'.$link.$row->id.'">'.$row->nome.'</a></td></tr>'."\n";
        		}
				echo $out.'
			    	</body>
			    	</table>';
		    break;
		    
		    case "setAutorizacao":	
    			$db =JFactory::getDBO();
		    	$alunos_bi=JRequest::getVar('alunos_bi');
		    	$value=JRequest::getVar('value');	    			    					
				$this->setModel(JModel::getInstance('alunos', 'inscricaoexamesModel'));
				$model = $this->getModel('alunos');
				if($model->setAutorizacao($alunos_bi,$value)){
					if($value){
						echo '0|'.JText::_( 'MSG_AUTORIZACAO' );
					}
					else{
						echo '0|'.JText::_( 'MSG_DESAUTORIZACAO' );
					}
				}
		    	else{
		    		echo '1|'.JText::_( 'ERRO_GUARDAR_DADOS' ).$db->getErrorMsg();		    		
		    	}
		    break;
		}
	}

}
