<?php 
// no direct access
defined('_JEXEC') or die('Restricted access'); 
?>

<form id="adminForm" name="adminForm" action="index.php" method="post">
<div id="editcell">
	<table class="adminlist">
	<thead>
		<tr>
			<th width="200">
				<?php echo JText::_( 'OPCAO' ); ?>
			</th>
			<th width="200">
				<?php echo JText::_( 'VALOR' ); ?>
			</th>		
		</tr>			
	</thead>
	<?php $k=0; ?>
	<tr class="<?php echo "row$k"; ?>">
		<td align="center">
			<?php echo JText::_( 'OP_GRP_ALUNOS' ); ?>
		</td>
		<td align="center">
			<?php 
			$select='<select name="grupoJoomla"><option></option>';
			foreach($this->gruposJoomla as $row){
				if ($this->grupoComp==$row['id']) $selected='selected';
				else $selected='';
				$select.='<option value="'.$row['id'].'" '.$selected.'>'.$row['title'].'</option>';
			}
			$select.='</select>';
			
			echo $select; ?>
		</td>
	</tr>
	<?php $k=1-$k; ?>
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
    <input type="hidden" name="option" value="com_inscricaoexames" />
    <input type="hidden" name="task" value="" />
</form>
