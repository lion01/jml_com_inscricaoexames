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
class inscricaoexamesViewdisciplinas extends JView{
	
	function display($tpl = null){
		
		
		//choose the layout and assign data to the view
		switch(JRequest::getVar('layout')){
		    case 'verdisciplinas':
        		$document = JFactory::getDocument();
                $document->addScript( JURI::base().'/components/com_inscricaoexames/js/disciplinas.js' );
        	    // Get data from the model
        		$items = $this->get('Disciplinas');
        		$this->assignRef('items',$items);
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
