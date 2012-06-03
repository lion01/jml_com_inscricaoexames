<?php 
// no direct access
defined('_JEXEC') or die('Restricted access'); 
?>
<H1><?php echo JText::_( 'EDITAR_OPCOES' ); ?></H1>


<form id="adminForm" name="adminForm" action="index.php" method="post">
<div id="editcell">
	<table width="100%">
	<thead>
		<tr align="center">
			<th width="50%">
				<?php echo JText::_( 'OPCAO' ); ?>
			</th>
			<th width="50%">
				<?php echo JText::_( 'VALOR' ); ?>
			</th>		
		</tr>			
	</thead>
	<?php $k=0; ?>
	<tr class="<?php echo "row$k"; ?>">
		<td align="center">
			<?php echo JText::_( 'OP_APROVAR_INS' ); ?>
		</td>
		<td align="center">
			<?php 
			$selected0=$selected1='';
			if (!$this->aprovar) $selected0='selected';
			else $selected1='selected';
			$select='<select name="aprovar"><option value="0" '.$selected0.'>'.JText::_( 'NAO' ).'</option><option value="1" '.$selected1.'>'.JText::_( 'SIM' ).'</option></select>';
			echo $select; ?>
		</td>
	</tr>
	<?php $k=1-$k; ?>
	<tr class="<?php echo "row$k"; ?>">
		<td align="center">
			<?php echo JText::_( 'OP_LIMITE_INSCR_TOTAL' ); ?>
		</td>
		<td align="center">
			<input type="text" name="OP_LIMITE_INSCR_TOTAL" size="5" value="<?php echo $this->limite_total;?>"/><?php echo ' '.JText::_( '0_DESLIGA' ); ?>
		</td>
	</tr>
	<?php $k=1-$k; ?>
	<tr class="<?php echo "row$k"; ?>">
		<td align="center">
			<?php echo JText::_( 'OP_LIMITE_INSCR_DISC' ); ?>
		</td>
		<td align="center">
			<input type="text" name="OP_LIMITE_INSCR_DISC" size="5" value="<?php echo $this->limite_disc;?>"/><?php echo ' '.JText::_( '0_DESLIGA' ); ?>
		</td>
	</tr>
	</table>
</div>
    <input type="submit" name="Submit" class="button" value="<?php echo JText::_( 'GUARDAR_DADOS' ); ?>">
    <input type="hidden" name="option" value="com_inscricaoexames" />
    <input type="hidden" name="task" value="opcoes.setOpcoes" />
</form>
