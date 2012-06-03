<?php 
// no direct access
defined('_JEXEC') or die('Restricted access');  
// import Joomla view library
jimport('joomla.application.component.view');
?>
<H1><?php echo JText::_( 'FAZER_INSCRICAO' ); ?></H1>
<?php 
if($this->autorizar_inscr && $this->aluno->autorizado){
	echo JText::_( 'INSCRICAO_AUTORIZADA' );
}
else{
?>
	<form id="adminForm" name="adminForm" action="index.php" method="post">
	    <div id="editcell">
	    	<p><?php echo JText::_( 'AVISO_INSCRICAO' ); ?>
	    	<?php if ($this->limite_total) echo '<BR>'.JText::_( 'OP_LIMITE_INSCR_TOTAL' ).': '.$this->limite_total; ?>
	    	<?php if ($this->limite_disc) echo '<BR>'.JText::_( 'OP_LIMITE_INSCR_DISC' ).': '.$this->limite_disc; ?>
	    	</p>
			<H3><?php echo JText::_( 'IDENTIFICACAO' ); ?></H3>
			<B><?php echo JText::_( 'NOME' ); ?>:</B> <?php echo $this->aluno->nome;?><BR>
			<B><?php echo JText::_( 'CURSO' ); ?>:</B> <?php echo $this->aluno->curso; ?><BR>
			<BR>
			<H3><?php echo JText::_( 'DISCIPLINA' ); ?></H3>
			<?php 
			echo JHtml::_('sliders.start');
			{
				foreach($this->disciplinas as $row){
					echo JHtml::_('sliders.panel', $row->designacao, 'panel_'.$row->id);
					echo $this->tabelasDeModulos[$row->id];
				}
			}
			echo JHtml::_('sliders.end');?>
	    </div>    
	    <BR><BR>
	    <input type="submit" name="Submit" class="button" value="<?php echo JText::_( 'INSCREVER' ); ?>">
	    <input type="hidden" name="option" value="com_inscricaoexames" />
	    <input type="hidden" name="task" value="fazer_inscricao" />
	</form>
<?php 
}?>
