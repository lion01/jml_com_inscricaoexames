<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');


class InscricaoexamesViewOpcoes extends JView{
	
    public function display($tpl = null){	
            
    	//choose the activity
        switch(JRequest::getVar('act')){
			case 'setOpcoes':
        		// Set the toolbar
				$this->addToolBar();
				
				// Get data from the model
				$model = $this->getModel('opcoes');
        		$this->grupoComp = $model->getOpcao('OP_GRP_ALUNOS');
        		$this->gruposJoomla = $this->get('GruposJoomla');
        		
        		$this->aprovar = $model->getOpcao('OP_APROVAR_INS');
        		$this->limite_total = $model->getOpcao('OP_LIMITE_INSCR_TOTAL');
        		$this->limite_disc = $model->getOpcao('OP_LIMITE_INSCR_DISC');
			break;    
		}
        parent::display($tpl);
        
		// Set the document
		$this->setDocument();
	}

	/**
	 * Setting the toolbar
	 */
	public function addToolBar(){
		JToolBarHelper::title(JText::_('COM_INSCRICAOEXAMES_ADMINISTRATION'), 'icon');
		JToolBarHelper::apply("opcoes.setOpcoes");
	}
	
	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	public function setDocument(){
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_INSCRICAOEXAMES_ADMINISTRATION'));
	}
}