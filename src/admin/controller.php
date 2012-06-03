<?php

jimport('joomla.application.component.controller');

/**
 * Component Admin Controller
 *
 * @package		inscricaoexames
 */
class inscricaoexamesController extends JController{ 
    
	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	public function display( ){    
	    
		// choose the activity
		switch(JRequest::getVar('act')){
			case 'setOpcoes':
			default:
				JRequest::setVar( 'layout', 'default'  );
				JRequest::setVar( 'act', 'setOpcoes' );
				JRequest::setVar( 'view', 'opcoes' );
			break;			    
		}

		parent::display();
	}
	
}