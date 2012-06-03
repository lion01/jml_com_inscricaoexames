<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');

/**
 * Classe used to deal with this view AJAX requests
 *
 * @author herberto
 *
 */
class inscricaoexamesViewcursos extends JView{
	
	function display($tpl = null){
	    
		// choose the activity
		switch(JRequest::getVar('act')){
		    case "getDisciplinas":
		    	
		    	$curso=JRequest::getVar('curso');
		    	
		    	$this->setModel(JModel::getInstance('cursosdisciplinas', 'inscricaoexamesModel'));
        		$model = $this->getModel('cursosdisciplinas');
        		$disciplinas=$model->getDisciplinas($curso);
		    	
        		$out="";
        		for($i=0, $n=count($disciplinas); $i<$n; $i++)
        			$out.=$disciplinas[$i].'|';
        		
        		$out=rtrim($out, '|');
		        
				echo $out;
		    break;
		}
	}

}