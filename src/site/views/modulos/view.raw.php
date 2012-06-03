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
class inscricaoexamesViewmodulos extends JView{
	
	function display($tpl = null){
		
		// choose the activity
		switch(JRequest::getVar('act')){
		    case "getModulos":
		    	
		    	$disciplinas_id=JRequest::getVar('disciplinas_id');
		    					
				$modelModulos = $this->getModel('modulos');
				$modulos=$modelModulos->getModulos($disciplinas_id);
		    	
        		$out='
        		<table class="adminlist" width="100%">
			    	<thead>
			    		<tr align="center">
			    			<th width="30">'.JText::_( ID ).'</th>
			    			<th width="30"><input type="checkbox" name="toggle" value="" onclick="select_all(\'cid\', this.checked);" /></th>
			    			<th width="30">'.JText::_( 'NUMERO_DO_MODULO' ).'</th>
			    			<th>'.JText::_( 'NOME_DO_MODULO' ).'</th>
			    		</tr>			
			    	</thead>
			    	<tbody>';
        		for($i=0, $n=count($modulos); $i<$n; $i++){
        			$row = $modulos[$i];
					$checked = JHTML::_('grid.id',   $i, $row->id );
					
        			$out.='<tr><td align="center"><input type="hidden" name="modulos['.$i.'][id]" value="'.$row->id.'" />'.$row->id.'</td><td align="center">'.$checked.'</td><td align="center"><input type="text" name="modulos['.$i.'][numero]" size="1" value="'.$row->numero.'"/></td><td><input type="text" name="modulos['.$i.'][designacao]" size="70" value="'.$row->designacao.'" /></td></tr>'."\n";
        		}
				echo $out.'
			    	</tbody>
			    </table>';
		    break;
		}
	}

}