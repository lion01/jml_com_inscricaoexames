<?php 
// no direct access
defined('_JEXEC') or die('Restricted access'); 
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
	
	    		<select id="disciplinas_id" name="disciplinas_id" onchange="actualiza_modulos(this.options[this.selectedIndex].value, 'lista');">
					<option selected="selected"></option>
					<?php foreach($this->disciplinas as $row){?>
					<option value="<?php echo $row->id; ?>"><?php echo $row->designacao; ?></option>
					<?php }?>
				</select><BR>
			<BR>
			
			<H3><?php echo JText::_( 'MODULOS' ); ?></H3>
			<DIV id="updating">&nbsp;</DIV>
			
	    	<DIV id="lista">
		    	<table class="adminlist" width="100%">
		    	<thead>
		    		<tr align="center">
		    			<th width="30"><?php echo JText::_( 'ID' ); ?></th>
		    			<th width="30"></th>
		    			<th width="30"><?php echo JText::_( 'NUMERO_DO_MODULO' ); ?></th>
		    			<th><?php echo JText::_( 'NOME_DO_MODULO' ); ?></th>
		    		</tr>			
		    	</thead>
		    	</table>
	    	</DIV>
	    </div>
	</form>
<?php 
}?>




















