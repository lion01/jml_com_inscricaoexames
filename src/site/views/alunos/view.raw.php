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
class inscricaoexamesViewalunos extends JView{
	
	function display($tpl = null){
	    
		// choose the activity
		switch(JRequest::getVar('act')){
		    case "getAlunos":
		    	
		    	$cursos_id=JRequest::getVar('cursos_id');
		    					
				$model = $this->getModel('alunos');
				$alunos=$model->getAlunosCurso($cursos_id);
		    	
				$this->setModel(JModel::getInstance('cursos', 'inscricaoexamesModel'));
				$modelCursos = $this->getModel('cursos');
				$cursos=$modelCursos->getCursos();
				
						    	
        		$out='
	    	<table class="adminlist" width="100%">
	    	<thead>
	    		<tr align="center">
	    			<th width="30">'.JText::_( 'ID' ).'</th>
	    			<th width="30">'.JHTML::_('tooltip', JText::_( 'ELIMINAR' ), null, null, JText::_( 'ELIM' )).'<BR><input type="checkbox" name="toggle" value="" onclick="select_all(\'cid\', this.checked);" /></th>
	    			<th width="80">'.JText::_( 'BI' ).'</th>
	    			<th width="80">'.JText::_( 'CURSO' ).'</th>
	    			<th>'.JText::_( 'NOME' ).'</th>
	    		</tr>			
	    	</thead>
	    	<body>';
        		for($i=0, $n=count($alunos); $i<$n; $i++){
        			$row = $alunos[$i];
					$cb_eliminar = JHTML::_('grid.id',   $i, $row->bi );
					
					$select_cursos='
					<select name="alunos['.$i.'][cursos_id]">
						<option></option>';
					foreach($cursos as $curso){
						$selected='';
						if ($curso->id==$cursos_id) $selected='selected';
						$select_cursos.='<option value="'.$curso->id.'" '.$selected.'>'.$curso->sigla.'&nbsp;&nbsp;</option>';
					}
					$select_cursos.='</select>';
					
					
        			$out.='<tr><td align="center"><input type="hidden" name="alunos['.$i.'][id]" value="'.$row->id.'" />'.$row->id.'</td><td align="center">'.$cb_eliminar.'</td><td align="center"><input type="hidden" name="alunos['.$i.'][bi]" value="'.$row->bi.'" />'.$row->bi.'</td><td align="center">'.$select_cursos.'</td><td align="center"><input type="text" name="alunos['.$i.'][nome]" size="50" value="'.$row->nome.'"/></td></tr>'."\n";
        		}
				echo $out.'
	    	</body>
	    	</table>';
		    break;
		}
	}

}