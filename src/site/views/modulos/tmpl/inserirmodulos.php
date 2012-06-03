<?php 
// no direct access
defined('_JEXEC') or die('Restricted access'); 
?>
<H1><?php echo JText::_( 'INSERIR_MODULOS' ); ?></H1>
<?php 
if($this->numDisc==0){
	echo '<H3>'.JText::_( 'NAO_EXISTEM_DISCIPLINAS' ).'</H3>';
}
else{
?>
	<p><?php echo JText::_( 'INSERIR_MODULOS_INSTRUCOES' ); ?></p>
	<form enctype="multipart/form-data" action="index.php" method="post" name="adminForm" onsubmit="return checkData(['disciplinas_id','nomes_dos_modulos'], '<?= JText::_('NAO_INSERIU_DADOS') ?>'); ">
		<H3><?php echo JText::_( 'DISCIPLINA' ); ?></H3>
		<select id="disciplinas_id" name="disciplinas_id">
			<option selected="selected"></option>
			<?php foreach($this->disciplinas as $row){?>
			<option value="<?php echo $row->id; ?>"><?php echo $row->designacao; ?></option>
			<?php }?>
		</select>
	
		<H3><?php echo JText::_( 'LISTA_DE_MODULOS' ); ?></H3>    
		<textarea id="nomes_dos_modulos" name="nomes_dos_modulos" rows="10" cols="60"></textarea>
	    
	    <DIV align="center">
	        <input type="hidden" name="option" value="com_inscricaoexames" />
	        <input type="hidden" name="task" value="criar_modulos" />
	        <BR><BR>
	        <input type="submit" name="Submit" class="button" value="<?php echo JText::_( 'GUARDAR_DADOS' ); ?>"/>
		</DIV>
	</form>
<?php 
}
?>
