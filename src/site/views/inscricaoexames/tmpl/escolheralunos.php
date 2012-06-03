<?php 
// no direct access
defined('_JEXEC') or die('Restricted access'); 
?>
<H1><?php echo JText::_( 'ESCOLHER_ALUNO' ); ?></H1>
<form id="adminForm" name="adminForm" action="index.php" method="post" onsubmit="return checkData(['turmas_id'], '<?= JText::_('NAO_INSERIU_DADOS') ?>');">
    <div id="editcell">
    
			<H3><?php echo JText::_( 'CURSO' ); ?> </H3> 
			<select id="cursos_id" name="cursos_id" onchange="actualiza_lista_alunos(this.options[this.selectedIndex].value, 'lista_alunos');">
				<option value="0" selected="selected"></option>
				<?php foreach($this->cursos as $row){?>
				<option value="<?php echo $row->id; ?>">
				<?php echo $row->designacao; ?>
				</option>
				<?php }?>
			</select>
			<BR><BR><BR>
	    	<H3><?php echo JText::_( 'ALUNOS' ); ?></H3>
			<DIV id="updating_nao_integrado">&nbsp;</DIV>
			
			
			<DIV id="lista_alunos">
	    	<table class="adminlist" width="100%">
	    	<thead>
	    		<tr align="center">
	    			<th width="30"><?php echo JText::_( 'ID' ); ?></th>
	    			<th width="80"><?php echo JText::_( 'BI' ); ?></th>
	    			<th><?php echo JText::_( 'NOME' ); ?></th>
	    		</tr>			
	    	</thead>
	    	</table>
	    	</DIV>
    </div>

    <input type="hidden" name="option" value="com_inscricaoexames" />
    <input type="hidden" name="task" value="editar_alunos" />
    
</form>

