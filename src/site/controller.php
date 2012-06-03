<?php

jimport('joomla.application.component.controller');

/**
 * Component Controller
 * @author Herberto Graça
 *
 * @package		inscricaoexames
 */
class inscricaoexamesController extends JController
{ 
	
	/**
	 * updates data in several courses
	 * @author Herberto Graça
	 * 
	 */	
	public function actualizar_cursos(){
						
	    $lista_de_cursos=JRequest::getVar('cursos');
	    
        $model = $this->getModel('cursos'); 
        
		if (!$model->insCursos($lista_de_cursos)){
			$msg=$model->getError();
			$msgType="Error";
		}
		else{
			$msg=JText::_( 'CURSOS_INSERIDOS' ); 
			$msgType="Message";
		}
		
		$link = 'index.php?option=com_inscricaoexames&view=cursos&layout=editarcursos';
        $this->setRedirect($link, $msg, $msgType);		
	}

	/**
	 * Creates courses
	 * @author Herberto Graça
	 *
	 */	
	public function criar_cursos(){
			    
	    $lista=JRequest::getVar('nomes_dos_cursos');
	    $lista=explode("\n",$lista);
	    
	    $i=0;
	    foreach ($lista as $linha){
			list($lista_de_cursos[$i]['designacao'], $lista_de_cursos[$i]['sigla'])=explode(";",$linha);
	    	$i++;
	    }  
	    
        $model = $this->getModel('cursos'); 
        
		if (!$model->insCursos($lista_de_cursos)){
			$msg=$model->getError();
			$msgType="Error";
		}
		else{
			$msg=JText::_( 'CURSOS_INSERIDOS' ); 
			$msgType="Message";
		}
		
		$link = 'index.php?option=com_inscricaoexames&view=cursos&layout=editarcursos';
        $this->setRedirect($link, $msg, $msgType);
		
	}
	
	/**
	 * deletes courses
	 * @author Herberto Graça
	 *
	 */	
	public function eliminar_cursos($cid=false){
			    
	    if(!$cid) $cid = count(JRequest::getVar('cid')) ? JRequest::getVar('cid') : array(); 
	       
        $model = $this->getModel('cursos'); 
        if(count($cid)){
			if (!$model->delCursos($cid)){
				$msg=$model->getError();
				$msgType="Error";
			}
			else{
				$msg=JText::_( 'CURSOS_ELIMINADOS' ); 
				$msgType="Message";
			}
        }
		else{
            $msg = JText::_( 'ERRO_NENHUM_CURSO_SELECCIONADO');
        }
        
		$link = 'index.php?option=com_inscricaoexames&view=cursos&layout=editarcursos';
        $this->setRedirect($link, $msg, $msgType);
	}

	/**
	 * create subjects
	 * @author Herberto Graça
	 *
	 */	
	public function criar_disciplinas(){
			    
	    $nomes_das_disciplinas=JRequest::getVar('nomes_das_disciplinas');
		
	    $lista_de_disciplinas=explode("\n",$nomes_das_disciplinas);
	       
        $model = $this->getModel('disciplinas'); 
        
		if (!$model->insDisciplinas($lista_de_disciplinas)){
			$msg=$model->getError();
			$msgType="Error";
		}
		else{
			$msg=JText::_( 'DISCIPLINAS_INSERIDAS' ); 
			$msgType="Message";
		}
		$link = 'index.php?option=com_inscricaoexames&view=disciplinas&layout=verdisciplinas';
        $this->setRedirect($link, $msg, $msgType);
	}

	/**
	 * delete subjects
	 * @author Herberto Graça
	 *
	 */	
	public function eliminar_disciplinas($cid=false){
			    
	    if(!$cid) $cid = count(JRequest::getVar('cid')) ? JRequest::getVar('cid') : array(); 
	       
        $model = $this->getModel('disciplinas'); 
        if(count($cid)){
			if (!$model->delDisciplinas($cid)){
				$msg=$model->getError();
				$msgType="Error";
			}
			else{
				$msg=JText::_( 'DISCIPLINAS_ELIMINADAS' ); 
				$msgType="Message";
			}
        }
		else{
			$msgType="Error";
            $msg = JText::_( 'ERRO_NENHUMA_DISCIPLINA_SELECCIONADA');
        }
        
		$link = 'index.php?option=com_inscricaoexames&view=disciplinas&layout=verdisciplinas';
        $this->setRedirect($link, $msg, $msgType);
	}
	
	/**
	 * Save subjects in a course
	 * @author Herberto Graça
	 *
	 */	
	public function editar_disc_cursos($disciplinas=false){
		
		if(!$disciplinas) $disciplinas = count(JRequest::getVar('cid')) ? JRequest::getVar('cid') : array(); 
		
		$curso=JRequest::getVar('curso');
	    
		$model = $this->getModel('cursosdisciplinas'); 
		
		if (!$model->delCurso($curso)){//elimina todas as ligações curso/disciplina deste curso
			$msg=$model->getError();
			$msgType="Error";
		}
		else{
			$msg=JText::_( 'DADOS_GUARDADOS' ); 
			$msgType="Message";
			
			if(count($disciplinas)){
				if (!$model->insCursoDisciplinas($curso, $disciplinas)){
					$msg=$model->getError();
					$msgType="Error";
				}
	        }
		}
        
		$link = 'index.php?option=com_inscricaoexames&view=cursos&layout=editardisccursos';
        $this->setRedirect($link, $msg, $msgType);
	}
	
	/**
	 * Create themes
	 * @author Herberto Graça
	 *
	 */	
	public function criar_modulos(){
			    
	    $nomes_dos_modulos=JRequest::getVar('nomes_dos_modulos');
	    $disciplinas_id=JRequest::getVar('disciplinas_id');
		
	    $lista_de_modulos=explode("\n",$nomes_dos_modulos);
	       
        $model = $this->getModel('modulos'); 
        
		if (!$model->insModulos($lista_de_modulos, $disciplinas_id)){
			$msg=$model->getError();
			$msgType="Error";
		}
		else{
			$msg=JText::_( 'MODULOS_INSERIDOS' ); 
			$msgType="Message";
		}
		
		$link = 'index.php?option=com_inscricaoexames&view=modulos&layout=inserirmodulos';
        $this->setRedirect($link, $msg, $msgType);
	}
	
	/**
	 * edit themes
	 * @author Herberto Graça
	 *
	 */	
	public function editar_modulos($cid=false){
		
		switch(JRequest::getVar('act')){
			
			case 'eliminar':
				if(!$cid) $cid = count(JRequest::getVar('cid')) ? JRequest::getVar('cid') : array(); 
			    
			    //print_r($cid);
			       
		        $model = $this->getModel('modulos'); 
		        if(count($cid)){
					if (!$model->delModulos($cid)){
						$msg=$model->getError();
						$msgType="Error";
					}
					else{
						$msg=JText::_( 'MODULOS_ELIMINADOS' ); 
						$msgType="Message";
					}
		        }
				else{
					$msgType="Error";
		            $msg = JText::_( 'ERRO_NENHUM_MODULO_SELECCIONADO');
		        }
			break;
			
			case 'guardar':
				$lista_de_modulos = JRequest::getVar('modulos'); 
		        $model = $this->getModel('modulos'); 
				if (!$model->updateModulos($lista_de_modulos)){
					$msg=$model->getError();
					$msgType="Error";
				}
				else{
					$msg=JText::_( 'MODULOS_ACTUALIZADOS' ); 
					$msgType="Message";
				}			
			break;
		}
	    
        
		$link = 'index.php?option=com_inscricaoexames&view=modulos&layout=editarmodulos';
        $this->setRedirect($link, $msg, $msgType);
	}
	
	/**
	 * creates classes
	 * @author Herberto Graça
	 * @deprecated
	 */	
	/*
	public function criar_turmas(){
			    
	    $dados=JRequest::getVar('dados');
	    $cursos_id=JRequest::getVar('cursos_id');
		
	    $lista=explode("\n",$dados);
	    
	    $i=0;
	    foreach ($lista as $linha)
	    	$lista_de_turmas[$i++]=explode(";",$linha);
	    	
	    //dump($lista_de_turmas, '$lista_de_turmas');
	       
        $model = $this->getModel('turmas'); 
        
		if (!$model->insTurmas($lista_de_turmas, $cursos_id)){
			$msg=$model->getError();
			$msgType="Error";
		}
		else{
			$msg=JText::_( 'TURMAS_INSERIDAS' ); 
			$msgType="Message";
		}
		
		$link = 'index.php?option=com_inscricaoexames&view=turmas&layout=inserirturmas';
        $this->setRedirect($link, $msg, $msgType);
	}
	*/
	/**
	 * edit classes
	 * @author Herberto Graça
	 * @deprecated
	 */		
	/*
	public function editar_turmas($cid=false){
		
		switch(JRequest::getVar('act')){
			
			case 'eliminar':
				if(!$cid) $cid = count(JRequest::getVar('cid')) ? JRequest::getVar('cid') : array(); 
			    
			    //print_r($cid);
			       
		        $model = $this->getModel('turmas'); 
		        if(count($cid)){
					if (!$model->delTurmas($cid)){
						$msg=$model->getError();
						$msgType="Error";
					}
					else{
						$msg=JText::_( 'TURMAS_ELIMINADAS' ); 
						$msgType="Message";
					}
		        }
				else{
					$msgType="Error";
		            $msg = JText::_( 'ERRO_NENHUMA_TURMA_SELECCIONADA');
		        }
			break;
			
			case 'guardar':
				$lista = JRequest::getVar('turmas'); 
		        $model = $this->getModel('turmas'); 
				if (!$model->updateTurmas($lista)){
					$msg=$model->getError();
					$msgType="Error";
				}
				else{
					$msg=JText::_( 'TURMAS_ACTUALIZADAS' ); 
					$msgType="Message";
				}			
			break;
		}
	    
        
		$link = 'index.php?option=com_inscricaoexames&view=turmas&layout=editarturmas';
        $this->setRedirect($link, $msg, $msgType);
	}
	*/
	/**
	 * Inserts in DB the ID of students who are allowed to register in the application
	 * @author Herberto Graça
	 * 
	 */	
	public function criar_alunos(){
		   
	    $dados=JRequest::getVar('dados'); //lista: nº de BI, e o nome
	    
	    $cursos_id=JRequest::getVar('cursos_id');
		
	    $lista=explode("\n",$dados);
	    
	    $i=0;
	    foreach ($lista as $linha){
	    	$linha=rtrim($linha);
	    	$lista_de_alunos[$i++]=explode(";",$linha);
	    }
	    		       
        $model = $this->getModel('alunos'); 
        
		if ($model->insAlunos($lista_de_alunos, $cursos_id)){
			$msg=JText::_( 'ALUNOS_INSERIDOS' ); 
		}
		
		$link = 'index.php?option=com_inscricaoexames&view=alunos&layout=inseriralunos';
        $this->setRedirect($link, $msg);
	}
	
	/**
	 * edit students
	 * @author Herberto Graça
	 *
	 */	
	public function editar_alunos($cid=false){
		
		switch(JRequest::getVar('act')){
			
			case 'eliminar':
				if(!$cid){
					$cid = count(JRequest::getVar('cid')) ? JRequest::getVar('cid') : array(); 
				}
			       
		        $model = $this->getModel('alunos'); 
		        if(count($cid)){
					if (!$model->delAlunos($cid)){
						$msg=$model->getError();
						$msgType="Error";
					}
					else{
						$msg=JText::_( 'ALUNOS_ELIMINADOS' ); 
						$msgType="Message";
					}
		        }
				else{
					$msgType="Error";
		            $msg = JText::_( 'ERRO_NENHUM_ALUNO_SELECCIONADO');
		        }
			break;
			
			case 'guardar':
				$lista = JRequest::getVar('alunos'); 
		        $model = $this->getModel('alunos'); 
				if (!$model->updateAlunos($lista)){
					$msg=$model->getError();
					$msgType="Error";
				}
				else{
					$msg=JText::_( 'ALUNOS_ACTUALIZADOS' ); 
					$msgType="Message";
				}			
			break;
		}
	    
        
		$link = 'index.php?option=com_inscricaoexames&view=alunos&layout=editaralunos';
        $this->setRedirect($link, $msg, $msgType);
	}
	
	/**
	 * save student data
	 * @author Herberto Graça
	 *
	 */	
	public function guardar_aluno(){
			    
	    $numero=JRequest::getVar('numero');
	    $turmas_id=JRequest::getVar('turmas_id');
		$user = JFactory::getUser();
		
        $model = $this->getModel('alunos'); 
        
		if (!$model->insAluno($user->id, $numero, $turmas_id)){
			$msg='ERRO: '.$model->getError();
			$msgType="Error";
		}
		else{
			$msg=JText::_( 'DADOS_INSERIDOS' ); 
			$msgType="Message";
		}
		
		$link = 'index.php?option=com_inscricaoexames&view=alunos&layout=turmaenumaluno';
        $this->setRedirect($link, $msg, $msgType);
	}	
	
	/**
	 * deletes exam enrollment
	 * @author Herberto Graça
	 *
	 */	
	public function eliminar_inscricoes(){
			    		
        $model = $this->getModel('inscricaoexames'); 
        
		if (!$model->resetInscricoes()){
			$msg=$model->getError();
			$msgType="Error";
		}
		else{
			$msg=JText::_( 'DADOS_ELIMINADOS' ); 
			$msgType="Message";
		}
		
		$link = 'index.php?option=com_inscricaoexames&view=inscricaoexames';
        $this->setRedirect($link, $msg, $msgType);
	}
	
	/**
	 * Deletes connection between students and classes
	 * @author Herberto Graça
	 * @deprecated
	 */	
	/*
	public function eliminar_alunos_turmas(){
			    		
        $model = $this->getModel('alunos'); 
        
		if (!$model->resetAlunosTurmas()){
			$msg=$model->getError();
			$msgType="Error";
		}
		else{
			$msg=JText::_( 'DADOS_ELIMINADOS' ); 
			$msgType="Message";
		}
		
		$link = 'index.php?option=com_inscricaoexames&view=inscricaoexames';
        $this->setRedirect($link, $msg, $msgType);
	}
	*/
	/**
	 * enroll a student in exams
	 * @author Herberto Graça
	 * 
	 */	
	public function fazer_inscricao(){
		$mainframe = JFactory::getApplication();
		$user = JFactory::getUser();
		$modelAlunos = $this->getModel('alunos');
		$aluno=$modelAlunos->getAluno($user->id);
    	$alunos_bi=$aluno[0]->bi;
		
		$modulos_id=JRequest::getVar('modulos_id');
		
		$modelOp = $this->getModel('opcoes');
		$limite_total = $modelOp->getOpcao('OP_LIMITE_INSCR_TOTAL');
		$limite_disc = $modelOp->getOpcao('OP_LIMITE_INSCR_DISC');
		
		if(($limite_total>0) && ($limite_total<count($modulos_id))){
			$mainframe->enqueueMessage(JText::_( 'MAXIMO_INSCR_TOTAL_ATINGIDO' )." ($limite_total)"."<BR>".JText::_( 'NAO_FORAM_REALIZADAS_ALTERACOES' ), 'error');
		}
		else{
			$db =JFactory::getDBO();
			$model_inscr = $this->getModel('inscricaoexames');		
			$model_modulos = $this->getModel('modulos');
			
			if (!$model_inscr->resetInscricoes($alunos_bi)){
				$mainframe->enqueueMessage(JText::_( 'ERRO_ELIMINAR_DADOS' ).$model_inscr->getError(), 'error');
			}
			else{
				$mainframe->enqueueMessage(JText::_( 'INSCRICOES_ANTERIORES_ELIMINADAS' ));
			
				for ($i=0, $n=count($modulos_id); $i<$n; $i++){
					
					$mod_id=$modulos_id[$i];
					$modulo=$model_modulos->getModulo($mod_id);
					if(($limite_disc>0) && ($limite_disc<=$model_inscr->countInscricoes($alunos_bi,$model_modulos->getDiscID($mod_id)))){
						$mainframe->enqueueMessage(JText::_( 'MSG_N_INSCRICAO' ).$modulo['numero'].' - '.$modulo['designacao'].'<BR>'.JText::_( 'MAXIMO_INSCR_DISC_ATINGIDO' )." ($limite_disc)", 'error');
		    		}
			    	else{
						if ($model_inscr->setInscricao($alunos_bi, $mod_id, $db)){
							$mainframe->enqueueMessage(JText::_( 'MSG_INSCRICAO' ).$modulo['numero'].' - '.$modulo['designacao']);
						}
						else{
							$mainframe->enqueueMessage(JText::_( 'ERRO_GUARDAR_DADOS' ).$modulo['numero'].' - '.$modulo['designacao'].'<BR>'.$db->getErrorMsg(), 'error');
						}
			    	}
					
				}
			}
		}
		
		$link = 'index.php?option=com_inscricaoexames&view=inscricaoexames&layout=verinscricaoaluno';
        $this->setRedirect($link);
	}
	
	/**
	 * Registers a student in the application using hes ID, the joomla user_id, and other data as student nbr or course
	 * If the student is already registered, hes data is removed and registry is remade
	 * @author Herberto Graça
	 * 
	 */	
	public function registar_aluno(){	
		$mainframe = JFactory::getApplication();
		$bi=JRequest::getVar('bi');
		$modelAlunos = $this->getModel('alunos');
		
		if(!$modelAlunos->existe($bi)){
			$mainframe->enqueueMessage(JText::_( 'BI_NAO_EXISTE' ), 'error');
		}
		elseif($modelAlunos->getAlunoID($bi)){
			$mainframe->enqueueMessage(JText::_( 'BI_JA_REGISTADO' ), 'error');
		}
		else{
			//inserir o aluno no grupo de alunos.
			$user = JFactory::getUser();
			$modelOps = $this->getModel('opcoes');
			$grp=$modelOps->getOpcao('OP_GRP_ALUNOS');
			
			if (!$grp){
				$mainframe->enqueueMessage(JText::_( 'ERRO_NAO_EXISTE_GRUPO_ALUNOS_ASSOCIADO' ), 'error');
			}
			elseif(!$modelAlunos->setAlunoID($bi)){
				$mainframe->enqueueMessage(JText::_( 'ERRO').$modelAlunos->getError(), 'error');
			}
			elseif(!$modelAlunos->setGrupo($user->id, $grp)){
				$mainframe->enqueueMessage(JText::_( 'ERRO').$modelAlunos->getError(), 'error');
				if(!$modelAlunos->unSetAlunoID($bi)){
					$mainframe->enqueueMessage(JText::_( 'ERRO_ALUNO_REG_MAS_N_INSERIDO_EM_GRUPO').$modelAlunos->getError(), 'error');
				}
			}
			else{//all OK
				$mainframe->enqueueMessage(JText::_( 'REGISTO_OK' ));
			}
		}
		
		$link = 'index.php?option=com_inscricaoexames&view=alunos&layout=registaraluno';
        $this->setRedirect($link);
        
	}
}
