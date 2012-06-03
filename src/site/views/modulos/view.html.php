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
class inscricaoexamesViewmodulos extends JView{
	
	function display($tpl = null){
		// Assign data to the view
        $document = JFactory::getDocument();
        $document->addScript( JURI::base().'/components/com_inscricaoexames/js/modulos.js' );
        
		$this->setModel(JModel::getInstance('disciplinas', 'inscricaoexamesModel'));
		$modelDisciplinas = $this->getModel('disciplinas');
		
		//choose the layout
		switch(JRequest::getVar('layout')){
		    case 'inserirmodulos':
		    case 'editarmodulos':
	        	$this->numDisc = $modelDisciplinas->countDisciplinas();
	        	if($this->numDisc>0){
					$disciplinas=$modelDisciplinas->getDisciplinas();
					$this->assignRef('disciplinas',$disciplinas);
	        	}
		    break;
		}
		
		
        // Display the view
        parent::display($tpl);
	}
	
}
