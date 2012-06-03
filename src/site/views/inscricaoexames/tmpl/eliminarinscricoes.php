<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<H1><?php echo JText::_( 'ELIMINAR_INSCRICOES' ); ?></H1>
<H3><?php echo JText::_( 'ELIMINAR_INSCRICOES_QUESTAO' ); ?></H3>

<form id="adminForm" name="adminForm" action="index.php" method="post">

    <input type="submit" name="Submit" class="button" value="<?php echo JText::_( 'ELIMINAR' ); ?>">
    <input type="hidden" name="option" value="com_inscricaoexames" />
    <input type="hidden" name="task" value="eliminar_inscricoes" />

</form>

