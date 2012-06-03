<?php

/**
 * Extension used in Portuguese K12 schools to allow for students to enroll in internal exams.
 * @author Herberto Graça
 */
// no direct access
defined('_JEXEC') or die('Restricted access');

// Include dependencies
jimport('joomla.application.component.controller');

$document = JFactory::getDocument();
$cssFile = JURI::base(true).'/components/com_inscricaoexames/css/inscricaoexames.css';
$document->addStyleSheet($cssFile, 'text/css', null, array());

// Get the Controller
$controller = JController::getInstance('inscricaoexames');

// Perform the Request task
$controller->execute(JRequest::getCmd('task')); 

// Redirect if set by the controller
$controller->redirect();
