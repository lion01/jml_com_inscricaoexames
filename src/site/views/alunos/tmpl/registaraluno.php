<?php 
// no direct access
defined('_JEXEC') or die('Restricted access'); 

//dump(JFactory::getUser(), 'user');

?>
<H1><?php echo JText::_( 'REGISTAR_NA_APLICACAO' ); ?></H1>
<?php 
if($this->numCursos==0){
	echo '<H3>'.JText::_( 'NAO_EXISTEM_DADOS' ).'</H3>';
}
else{
	if(!$this->registado){?>
	<form id="adminForm" name="adminForm" action="index.php" method="post" onsubmit="return checkData(['bi'], '<?= JText::_('NAO_INSERIU_DADOS') ?>');">
	    <div id="editcell">
	    	<B><?php echo JText::_( 'BI' ).': '; ?></B><input type="text" id="bi" name="bi" size="10" value=""/> <?php echo JText::_( 'ULTIMOS_DIGITOS_CARTAO_CIDADAO' ); ?>
	    	<BR><BR>
	    	<input type="submit" name="Submit" class="button" value="<?php echo JText::_( 'GUARDAR' ); ?>">
	    </div>
	
	    <input type="hidden" name="option" value="com_inscricaoexames" />
	    <input type="hidden" name="task" value="registar_aluno" />
	    
	</form>
	<?php 
	}
	else{
		echo '<H3>'.JText::_( 'JA_ESTA_REGISTADO' ).$this->registado.'</H3>';
	}
}
?>
