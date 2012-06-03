<?php 
// no direct access
defined('_JEXEC') or die('Restricted access'); 

?>
<H1><?php echo JText::_( 'INSERIR_ALUNOS' ); ?></H1>
<?php 
if($this->numCursos==0){
	echo '<H3>'.JText::_( 'NAO_EXISTEM_CURSOS' ).'</H3>';
}
else{
?>
	<form enctype="multipart/form-data" action="index.php" method="post" name="adminForm" onsubmit="return checkData_inseriralunos(['integrados', 'turmas_id', 'cursos_id', 'dados'], '<?= JText::_('NAO_INSERIU_DADOS') ?>'); ">
		<H3><?php echo JText::_( 'CURSO' ); ?> </H3> 
		<select id="cursos_id" name="cursos_id">
			<option selected="selected"></option>
			<?php foreach($this->cursos as $row){?>
			<option value="<?php echo $row->id; ?>">
			<?php echo $row->designacao; ?>
			</option>
			<?php }?>
		</select>
		<BR><?php echo JText::_( 'INSERIR_ALUNOS_NAO_INTEGRADOS_INSTRUCOES' ); ?><BR>
	
		<H3><?php echo JText::_( 'LISTA_DE_ALUNOS' ); ?></H3> 
		<textarea id="dados" name="dados" rows="10" cols="60"></textarea>
	    
	    <DIV align="center">
	        <input type="hidden" name="option" value="com_inscricaoexames" />
	        <input type="hidden" name="task" value="criar_alunos" />
	        <BR><BR>
	        <input value="<?php echo JText::_( 'GUARDAR_DADOS' ); ?>" name="B1" type="submit" />
		</DIV>
	</form>
<?php 
}
?>
