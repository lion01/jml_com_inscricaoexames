<?php 
// no direct access
defined('_JEXEC') or die('Restricted access'); 
?>
<H1><?php echo JText::_( 'INSERIR_CURSOS' ); ?></H1>
<p><?php echo JText::_( 'INSERIR_CURSOS_INSTRUCOES' ); ?></p>
<form enctype="multipart/form-data" action="index.php" method="post" name="adminForm" onsubmit="return checkData('<?= JText::_('NAO_INSERIU_DADOS') ?>'); ">
    
	<textarea id="nomes_dos_cursos" name="nomes_dos_cursos" rows="10" cols="60"></textarea>
    
    <DIV align="center">
        <input type="hidden" name="option" value="com_inscricaoexames" />
        <input type="hidden" name="task" value="criar_cursos" />
        <BR><?php echo JText::_( 'SE_CURSO_EXISTE_IGNORA' ); ?><BR><BR>
        <input type="submit" name="Submit" class="button" value="<?php echo JText::_( 'CRIAR_CURSOS' ); ?>"/>
	</DIV>
</form>

