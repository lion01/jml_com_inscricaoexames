<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');
 
/**
 * Grupos Controller
 * @author Herberto Graça
 *
 * @package		inscricaoexames
 */
class inscricaoexamesControllerOpcoes extends JController{
	
	/**
	 * Sets application options
	 * @author Herberto Graça
	 *
	 */	
	public function setOpcoes(){
		$mainframe = JFactory::getApplication();
		$aprovar=JRequest::getVar('aprovar');
		$limite_total=JRequest::getVar('OP_LIMITE_INSCR_TOTAL');
		$limite_disc=JRequest::getVar('OP_LIMITE_INSCR_DISC');
		$modelOpcoes = $this->getModel('opcoes');
		
		$erro=false;
		//Saves option about mandatory authorization for student enrollment in exams
		if (!$modelOpcoes->setOpcao('OP_APROVAR_INS', $aprovar)){
			$mainframe->enqueueMessage(JText::_( 'ERRO_GUARDAR_DADOS' ).$modelOpcoes->getError(), 'error');
			$erro=true;
		}
		//Saves option about total exams limit
		if (!$modelOpcoes->setOpcao('OP_LIMITE_INSCR_TOTAL', $limite_total)){
			$mainframe->enqueueMessage(JText::_( 'ERRO_GUARDAR_DADOS' ).$modelOpcoes->getError(), 'error');
			$erro=true;
		}
		//Saves option about exams limit in each subject
		if (!$modelOpcoes->setOpcao('OP_LIMITE_INSCR_DISC', $limite_disc)){
			$mainframe->enqueueMessage(JText::_( 'ERRO_GUARDAR_DADOS' ).$modelOpcoes->getError(), 'error');
			$erro=true;
		}
		
		if (!$erro) $msg=JText::_( 'DADOS_GUARDADOS' );
		
		$link = 'index.php?option=com_inscricaoexames&view=opcoes';
        $this->setRedirect($link, $msg, $msgType);
	}		
}