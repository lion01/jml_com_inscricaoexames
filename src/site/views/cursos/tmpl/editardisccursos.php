<?php 
// no direct access
defined('_JEXEC') or die('Restricted access'); 
?>
<H1><?php echo JText::_( 'EDITAR_DISC_CURSOS' ); ?></H1>

<?php 
if($this->numCursos==0){
	echo '<H3>'.JText::_( 'NAO_EXISTEM_CURSOS' ).'</H3>';
}
elseif($this->numDisc==0){
	echo '<H3>'.JText::_( 'NAO_EXISTEM_DISCIPLINAS' ).'</H3>';
}
else{
?>
	<form id="adminForm" name="adminForm" action="index.php" method="post" onsubmit="return checkData('<?= JText::_('ERRO_NENHUM_CURSO_SELECCIONADO') ?>');">
	    <div id="editcell">
	    	<H3><?php echo JText::_( 'NOME_DO_CURSO' ); ?></H3>
	    		<select id="curso" name="curso" onchange="actualiza_disciplinas(document.getElementById('curso').options[document.getElementById('curso').selectedIndex].value);">
					<option selected="selected"></option>
					<?php foreach($this->cursos as $row){?>
					<option value="<?php echo $row->id; ?>"><?php echo $row->designacao; ?></option>
					<?php }?>
				</select>
			<BR><DIV id="updating"">&nbsp;</DIV><BR><BR>
	    	<H3><?php echo JText::_( 'DISCIPLINAS_DO_CURSO' ); ?></H3>
			
	    	<table class="adminlist" width="100%">
	    	<thead>
	    		<tr align="center">
	    			<th width="30"><?php echo JText::_( 'ID' ); ?></th>
	    			<th width="30"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->disciplinas ); ?>);" /></th>
	    			<th><?php echo JText::_( 'NOME_DA_DISCIPLINA' ); ?></th>
	    		</tr>			
	    	</thead>
	    	<?php
	    	$k = 0;
	    	for ($i=0, $n=count( $this->disciplinas ); $i < $n; $i++)
	    	{
	    		$row = $this->disciplinas[$i];
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
	    	</table>		
			
			<BR><BR>
	    	<input type="submit" name="Submit" class="button" value="<?php echo JText::_( 'GUARDAR_DADOS' ); ?>">
	    </div>
	
	    <input type="hidden" name="option" value="com_inscricaoexames" />
	    <input type="hidden" name="task" value="editar_disc_cursos" />
	    <input type="hidden" name="boxchecked" value="0" />
	    
	</form>
<?php 
}
?>
