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
class InscricaoexamesViewOpcoes extends JView{
	
	function display($tpl = null){
		
		// Get data from the model
		$model = $this->getModel('opcoes');
		$this->aprovar = $model->getOpcao('OP_APROVAR_INS');
		$this->limite_total = $model->getOpcao('OP_LIMITE_INSCR_TOTAL');
		$this->limite_disc = $model->getOpcao('OP_LIMITE_INSCR_DISC');

        // Display the view
        parent::display($tpl);
	}
	
}
