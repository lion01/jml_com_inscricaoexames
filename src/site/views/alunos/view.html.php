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
class inscricaoexamesViewalunos extends JView{
	
	function display($tpl = null){
		
		// Assign data to the view
        $document = JFactory::getDocument();
        $document->addScript( JURI::base().'/components/com_inscricaoexames/js/alunos.js' );
        
		//count the courses
		$this->setModel(JModel::getInstance('cursos', 'inscricaoexamesModel'));
		$modelCursos = $this->getModel('cursos');
        $this->numCursos = $modelCursos->countCursos();
        
		if($this->numCursos>0){
			
			//choose the layout and assign data to the view
			switch(JRequest::getVar('layout')){
			    case 'registaraluno':		
					$model = $this->getModel('alunos');
					$this->registado=$model->registado();
				break;
							    	
			    case 'inseriralunos':
			    case 'editaralunos':
	        		$cursos = $modelCursos->getCursos();
	        		$this->assignRef('cursos',$cursos);
				break;
			}
			
		}
		
        // Display the view
        parent::display($tpl);
	}
	
}
