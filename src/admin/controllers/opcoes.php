<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');
 
/**
 * Opcoes Controller (Joomla back-end)
 */
class inscricaoexamesControllerOpcoes extends JController
{
	/**
	 * Proxy for getModel.
	 * @since	1.6
	 */
	public function getModel($name = 'opcoes', $prefix = 'inscricaoexamesModel') 
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
	
	/**
	 * Saves options
	 * @author Herberto Graça
	 *
	 */	
	public function setOpcoes(){
		$mainframe = JFactory::getApplication();
		$grupoJoomla=JRequest::getVar('grupoJoomla');
		$aprovar=JRequest::getVar('aprovar');
		$limite_total=JRequest::getVar('OP_LIMITE_INSCR_TOTAL');
		$limite_disc=JRequest::getVar('OP_LIMITE_INSCR_DISC');
		$modelOpcoes = $this->getModel('opcoes');
		
		$erro=false;
		//Save the Joomla group associated with the students
		if (!$modelOpcoes->setOpcao('OP_GRP_ALUNOS', $grupoJoomla)){
			$mainframe->enqueueMessage(JText::_( 'ERRO_GUARDAR_DADOS' ).$modelOpcoes->getError(), 'error');
			$erro=true;
		}
		//Save option about mandatory authorisation for exam enrollment
		if (!$modelOpcoes->setOpcao('OP_APROVAR_INS', $aprovar)){
			$mainframe->enqueueMessage(JText::_( 'ERRO_GUARDAR_DADOS' ).$modelOpcoes->getError(), 'error');
			$erro=true;
		}
		//Save option about total exams limit
		if (!$modelOpcoes->setOpcao('OP_LIMITE_INSCR_TOTAL', $limite_total)){
			$mainframe->enqueueMessage(JText::_( 'ERRO_GUARDAR_DADOS' ).$modelOpcoes->getError(), 'error');
			$erro=true;
		}
		//Save option about exam limit for a subject
		if (!$modelOpcoes->setOpcao('OP_LIMITE_INSCR_DISC', $limite_disc)){
			$mainframe->enqueueMessage(JText::_( 'ERRO_GUARDAR_DADOS' ).$modelOpcoes->getError(), 'error');
			$erro=true;
		}
		
		if (!$erro) $msg=JText::_( 'DADOS_GUARDADOS' );
		
		$link = 'index.php?option=com_inscricaoexames&view=opcoes';
        $this->setRedirect($link, $msg, $msgType);
	}		
}