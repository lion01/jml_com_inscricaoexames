<?php 
// no direct access
defined('_JEXEC') or die('Restricted access'); 
?>
<H1><?php echo JText::_( 'VER_CURSOS' ); ?></H1>
<form id="adminForm" name="adminForm" action="index.php" method="post" onsubmit="return checkData_editarcursos('document.getElementById('task').value', '<?= JText::_('ERRO_NENHUM_CURSO_SELECCIONADO') ?>');">
    <div id="editcell">
    	<table class="adminlist" width="100%">
    	<thead>
    		<tr align="center">
    			<th width="30"><?php echo JText::_( 'ID' ); ?></th>
    			<th width="30"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" /></th>
    			<th width="100"><?php echo JText::_( 'SIGLA' ); ?></th>
    			<th><?php echo JText::_( 'NOME_DO_CURSO' ); ?></th>
    		</tr>			
    	</thead>
    	<?php
    	$k = 0;
    	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
    	{
    		$row = $this->items[$i];
    		$checked 	= JHTML::_('grid.id',   $i, $row->id );		
    		?>
    		<tr class="<?php echo 'row'.$k; ?>">
    			<td align="center"><input type="hidden" name="cursos[<?php echo $i; ?>][id]" value="<?php echo $row->id; ?>" /><?php echo $row->id; ?></td>
    			<td align="center"><?php echo $checked; ?></td>
    			<td align="center"><input type="text" name="cursos[<?php echo $i; ?>][sigla]" size="10" value="<?php echo $row->sigla; ?>"/></td>
    			<td align="center"><input type="text" name="cursos[<?php echo $i; ?>][designacao]" size="60" value="<?php echo $row->designacao; ?>"/></td>
    		</tr>
    		<?php
    		$k = 1 - $k;
    	}
    	?>
    	</table><BR>
    	<input type="submit" name="Submit" class="button" value="<?php echo JText::_( 'ELIMINAR_CURSOS' ); ?>" onclick="document.getElementById('task').value='eliminar_cursos'">
    	<input type="submit" name="Submit" class="button" value="<?php echo JText::_( 'GUARDAR_ALTERACOES' ); ?>" onclick="document.getElementById('task').value='actualizar_cursos'">
    </div>

    <input type="hidden" name="option" value="com_inscricaoexames" />
    <input type="hidden" id="task" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    
</form>

