<?php 
// no direct access
defined('_JEXEC') or die('Restricted access'); 
?>
<H1><?php echo JText::_( 'EDITAR_ALUNOS' ); ?></H1>
<?php 
if($this->numCursos==0){
	echo '<H3>'.JText::_( 'NAO_EXISTEM_CURSOS' ).'</H3>';
}
else{
?>
	<form id="adminForm" name="adminForm" action="index.php" method="post" onsubmit="return checkData(['turmas_id'], '<?= JText::_('NAO_INSERIU_DADOS') ?>');">
	    <div id="editcell">
	    
				<H3><?php echo JText::_( 'CURSO' ); ?> </H3> 
				<select id="cursos_id" name="cursos_id" onchange="actualiza_lista_alunos(this.options[this.selectedIndex].value, 'lista_alunos');">
					<option value="0" selected="selected"></option>
					<?php foreach($this->cursos as $row){?>
					<option value="<?php echo $row->id; ?>">
					<?php echo $row->designacao; ?>
					</option>
					<?php }?>
				</select>
				<BR><BR><BR>
		    	<H3><?php echo JText::_( 'ALUNOS' ); ?></H3>
				<DIV id="updating_nao_integrado">&nbsp;</DIV>
				
				
				<DIV id="lista_alunos">
		    	<table class="adminlist" width="100%">
		    	<thead>
		    		<tr align="center">
		    			<th width="30"><?php echo JText::_( 'ID' ); ?></th>
		    			<th width="30"><?php echo JHTML::_('tooltip', JText::_( 'ELIMINAR' ), null, null, JText::_( 'ELIM' )); ?><BR><input type="checkbox" name="toggle" value="" onclick="select_all('cid', this.checked);" /></th>
		    			<th width="80"><?php echo JText::_( 'BI' ); ?></th>
		    			<th width="80"><?php echo JText::_( 'CURSO' ); ?></th>
		    			<th><?php echo JText::_( 'NOME' ); ?></th>
		    		</tr>			
		    	</thead>
		    	</table>
		    	</DIV>
			
			<BR><BR>
	    	<input type="submit" name="Submit" class="button" value="<?php echo JText::_( 'ELIMINAR_ALUNOS' ); ?>" onclick="document.getElementById('act').value='eliminar'">
	    	<input type="submit" name="Submit" class="button" value="<?php echo JText::_( 'GUARDAR_ALUNOS' ); ?>" onclick="document.getElementById('act').value='guardar'">
	    </div>
	
	    <input type="hidden" name="option" value="com_inscricaoexames" />
	    <input type="hidden" name="task" value="editar_alunos" />
	    <input type="hidden" name="act" id="act" value="" />
	    <input type="hidden" name="boxchecked" value="0" />
	    
	</form>
<?php 
}
?>

