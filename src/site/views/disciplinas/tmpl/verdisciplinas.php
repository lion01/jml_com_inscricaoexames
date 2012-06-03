<?php 
// no direct access
defined('_JEXEC') or die('Restricted access'); 
?>
<H1><?php echo JText::_( 'VER_DISCIPLINAS' ); ?></H1>
<form id="adminForm" name="adminForm" action="index.php" method="post" onsubmit="return checkData('<?= JText::_('ERRO_NENHUMA_DISCIPLINA_SELECCIONADA') ?>');">
    <div id="editcell">
    	<table class="adminlist" width="100%">
    	<thead>
    		<tr align="center">
    			<th width="30"><?php echo JText::_( 'ID' ); ?></th>
    			<th width="30"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" /></th>
    			<th><?php echo JText::_( 'NOME_DA_DISCIPLINA' ); ?></th>
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
    			<td align="center"><?php echo $row->id; ?></td>
    			<td align="center"><?php echo $checked; ?></td>
    			<td><?php echo $row->designacao; ?></td>
    		</tr>
    		<?php
    		$k = 1 - $k;
    	}
    	?>
    	</table><BR>
    	<input type="submit" name="Submit" class="button" value="<?php echo JText::_( 'ELIMINAR_DISCIPLINAS' ); ?>">
    </div>

    <input type="hidden" name="option" value="com_inscricaoexames" />
    <input type="hidden" name="task" value="eliminar_disciplinas" />
    <input type="hidden" name="boxchecked" value="0" />
    
</form>

