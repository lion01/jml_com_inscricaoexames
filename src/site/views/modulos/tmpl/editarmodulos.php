<?php 
// no direct access
defined('_JEXEC') or die('Restricted access'); 
?>
<H1><?php echo JText::_( 'EDITAR_MODULOS' ); ?></H1>
<?php 
if($this->numDisc==0){
	echo '<H3>'.JText::_( 'NAO_EXISTEM_DISCIPLINAS' ).'</H3>';
}
else{
?>
	<form id="adminForm" name="adminForm" action="index.php" method="post" onsubmit="return checkData(['disciplinas_id'], '<?php echo JText::_('NAO_INSERIU_DADOS'); ?>'); ">
	    <div id="editcell">
	    	<H3><?php echo JText::_( 'NOME_DA_DISCIPLINA' ); ?></H3>
	    		<select id="disciplinas_id" name="disciplinas_id" onchange="actualiza_modulos(document.getElementById('disciplinas_id').options[document.getElementById('disciplinas_id').selectedIndex].value, 'listaModulos');">
					<option selected="selected"></option>
					<?php foreach($this->disciplinas as $row){?>
					<option value="<?php echo $row->id; ?>"><?php echo $row->designacao; ?></option>
					<?php }?>
				</select>
			<BR><BR><BR>
	    	<H3><?php echo JText::_( 'MODULOS_DA_DISCIPLINA' ); ?></H3>
			<DIV id="updating"">&nbsp;</DIV><BR>
			<DIV id="listaModulos"">
		    	<table class="adminlist" width="100%">
		    	<thead>
		    		<tr align="center">
		    			<th width="30"><?php echo JText::_( 'ID' ); ?></th>
		    			<th width="30"><input type="checkbox" name="toggle" value="" onclick="select_all('cid', this.checked);" /></th>
		    			<th width="30"><?php echo JText::_( 'NUMERO_DO_MODULO' ); ?></th>
		    			<th><?php echo JText::_( 'NOME_DO_MODULO' ); ?></th>
		    		</tr>			
		    	</thead>
		    	<tbody>
		    	
		    	</tbody>
		    	</table>		
			</DIV>
			<BR><BR>
	    	<input type="submit" name="Submit" class="button" value="<?php echo JText::_( 'ELIMINAR_MODULOS' ); ?>" onclick="document.getElementById('act').value='eliminar'">
	    	<input type="submit" name="Submit" class="button" value="<?php echo JText::_( 'GUARDAR_MODULOS' ); ?>" onclick="document.getElementById('act').value='guardar'">
	    </div>
	
	    <input type="hidden" name="option" value="com_inscricaoexames" />
	    <input type="hidden" name="task" value="editar_modulos" />
	    <input type="hidden" name="act" id="act" value="" />
	    <input type="hidden" name="boxchecked" value="0" />
	    
	</form>
<?php 
}
?>

