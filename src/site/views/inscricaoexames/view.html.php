<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');

/**
 * Classe used to show a view
 *
 * @author herberto
 *
 */
class inscricaoexamesViewinscricaoexames extends JView{
	
	public function display($tpl = null){
		
		// Assign data to the view    
        $user = JFactory::getUser();
		$this->user_id=$user->id;
		
		$this->option	= JRequest::getVar('option');
		$this->view		= JRequest::getVar('view');
		$this->layout	= JRequest::getVar('layout');
		$this->print	= JRequest::getBool('print');
			        
		//choose the layout and assign data to the view    
		switch(JRequest::getVar('layout')){
			
		    case 'fazerinscricao':			    		    			    	
		        $document = JFactory::getDocument();		        
		        $this->prepareDocument($document);		        
		    	$this->inscricao();		    		
		    break; 		 
		           
		    case 'fazerinscricao2':		    	
		    	$this->inscricao();		    	
				foreach($this->disciplinas as $row){
					$this->tabelasDeModulos[$row->id]=$this->tabelaDeModulos($row->id, $this->aluno->bi);
				}										
		    break;
		    
		    case 'verinscricaoaluno':
		        $document = JFactory::getDocument();		        
		        $this->prepareDocument($document, 'Listagem dos exames em que o aluno se inscreveu.');
		    	
		    	if(JRequest::getVar('user_id')){
		    		$this->user_id=JRequest::getVar('user_id');
		    		$this->secretaria=true; 
		    	}
		    	
				$this->setModel(JModel::getInstance('opcoes', 'inscricaoexamesModel'));
				$modelOp = $this->getModel('opcoes');
				$this->autorizar_inscr = $modelOp->getOpcao('OP_APROVAR_INS');		    	
						    			    	
				$this->setModel(JModel::getInstance('alunos', 'inscricaoexamesModel'));
				$model = $this->getModel('alunos');
				$aluno=$model->getAluno($this->user_id);
				$this->aluno=$aluno[0];
								
				$model = $this->getModel('inscricaoexames');
				$modulos=$model->getModulosInscritos($this->autorizar_inscr, $this->user_id);		
				$this->lista=$modulos;
		    break;
		    
		    case 'escolheralunos':
		        $document = JFactory::getDocument();
		        $document->addScript( JURI::base().'components/com_inscricaoexames/js/inscricaoexames.js' );  
				$this->setModel(JModel::getInstance('cursos', 'inscricaoexamesModel'));
				$model = $this->getModel('cursos');
        		$this->cursos=$model->getCursos();		    	
		    break;
		    
		    default:
		        $document = JFactory::getDocument();		        
		        $this->prepareDocument($document, 'Listagem dos exames em que os alunos se inscreveram.');
				
				$this->setModel(JModel::getInstance('opcoes', 'inscricaoexamesModel'));
				$modelOp = $this->getModel('opcoes');
				$this->autorizar_inscr = $modelOp->getOpcao('OP_APROVAR_INS');
				$model = $this->getModel('inscricaoexames');
				$modulos=$model->getModulosInscritos($this->autorizar_inscr);		
				$this->assignRef('lista',$modulos);		    		
		    break;
		}
		
        // Display the view
        parent::display($tpl);
	}
	
	/**
	 * common code in "fazerinscricao" template
	 */
	private function inscricao(){
				$this->setModel(JModel::getInstance('opcoes', 'inscricaoexamesModel'));
				$model = $this->getModel('opcoes');
				$this->autorizar_inscr = $model->getOpcao('OP_APROVAR_INS');
				$this->limite_total = $model->getOpcao('OP_LIMITE_INSCR_TOTAL');
				$this->limite_disc = $model->getOpcao('OP_LIMITE_INSCR_DISC');
				
				
				$this->setModel(JModel::getInstance('alunos', 'inscricaoexamesModel'));
				$model = $this->getModel('alunos');
				$aluno=$model->getAluno($this->user_id);
				$this->aluno=$aluno[0];
				
				$this->setModel(JModel::getInstance('disciplinas', 'inscricaoexamesModel'));
				$model = $this->getModel('disciplinas');
				$this->disciplinas==$model->getDisciplinas($this->aluno->cursos_id);
		
	}
	
	
	/**
	 * Loads JS and CSS files into the document and sets the document title, metadata, decription and a small script to popup aprint window
	 * 
	 * @param obj $document
	 * @param string $description
	 */
	private function prepareDocument($document, $description=false){
        $document->addScript( JURI::base().'components/com_inscricaoexames/js/inscricaoexames.js' );  
        $document->addStyleSheet( JURI::base().'components/com_inscricaoexames/css/inscricaoexames.css' );
        
		if ($this->print && $description!==false){
			$document->setTitle(JText::_( 'EXAMS_PRINT_FILENAME' ));
			$document->setMetaData('robots', 'noindex, nofollow');
			$document->setDescription($description);
			$document->addScriptDeclaration( 'window.onload = window.print()' );
		}		
	}
	
	/**
	 * Creates an HTML table with the themes in a subject, and a checkbox for each theme. It's used in the form "fazerinscricao2.php", so that a student can enroll in exams.
	 * @author Herberto Graça
	 * 
	 * @return  String An HTML table with the themes in a subject
	 */		
	private	function tabelaDeModulos($disciplinas_id, $alunos_bi){	
		    					
		$this->setModel(JModel::getInstance('modulos', 'inscricaoexamesModel'));
		$model = $this->getModel('modulos');
		$modulos=$model->getModulos($disciplinas_id);
		
		$model = $this->getModel('inscricaoexames');
		$modulosInscritos=$model->getIDsModulosInscritos($alunos_bi);
		
        $out='
			<table width="100%">
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
			$checkbox = '<input '.$checked.' id="cb0" name="modulos_id[]" value="'.$row->id.'" type="checkbox">';
					
        	$out.='<tr><td align="center">'.$row->id.'</td><td align="center">'.$checkbox.'</td><td align="center">'.$row->numero.'</td><td>'.$row->designacao.'</td></tr>'."\n";
        }
		return $out."</tbody></table>";	
	}	
	
}
