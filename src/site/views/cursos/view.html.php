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
class inscricaoexamesViewcursos extends JView{
	
	function display($tpl = null){
		//choose the layout and assign data to the view
		switch(JRequest::getVar('layout')){
		    case 'editarcursos':
        		$document = JFactory::getDocument();
                $document->addScript( JURI::base().'/components/com_inscricaoexames/js/cursos.js' );                
        	    // Get data from the model
        		$items = $this->get('Cursos');
        		$this->assignRef('items',$items);        		
    		break;
    		
		    case 'editardisccursos':
		    	//contar os cursos
		    	$modelCursos = $this->getModel('cursos');
        		$this->numCursos = $modelCursos->countCursos();
		    	if($this->numCursos>0){
			    	//contar as disciplinas
	        		$this->setModel(JModel::getInstance('disciplinas', 'inscricaoexamesModel'));
	        		$modelDisciplinas = $this->getModel('disciplinas');
	        		$this->numDisc = $modelDisciplinas->countDisciplinas();
		    		if($this->numDisc>0){
		        		$document = JFactory::getDocument();
		                $document->addScript( JURI::base().'/components/com_inscricaoexames/js/cursos.js' );
		        	    // Get data from the model
		        		$cursos = $this->get('Cursos');
		        		$this->cursos=$cursos;
		        		$disciplinas=$modelDisciplinas->getDisciplinas();
		        		$this->disciplinas=$disciplinas;
		    		}
		    	}
    		break;
		}		
		// Check for errors.
		if (count($errors = $this->get('Errors'))){
			JError::raiseError(500, implode('<br />', $errors));
            return false;
        }    			
        // Display the view
        parent::display($tpl);
	}
	
}
