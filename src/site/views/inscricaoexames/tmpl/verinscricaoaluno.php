<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

JHtml::addIncludePath(JPATH_COMPONENT.DS.'helpers');
	
	echo '<H1>'.JText::_( 'VER_INSCRICOES' ).'</H1>';
		
	if (!$this->print){
		echo JHtml::_('icon.print_popup', $this->option, $this->view, $this->layout, $this->user_id);
	}
		
	?>	
	<H3><?php echo JText::_( 'IDENTIFICACAO' ); ?></H3>
	<B><?php echo JText::_( 'NOME' ); ?>:</B> <?php echo $this->aluno->nome;?>
	<BR>
	<B><?php echo JText::_( 'CURSO' ); ?>:</B> <?php echo $this->aluno->curso; ?>
	<?php 
	if ($this->autorizar_inscr){?>
		<BR>
		<BR>
		<?php 
		if ($this->secretaria && !$this->print){
			echo '<B>'.JText::_( 'AUTORIZAR_INSCRICAO' ).'</B> '; 
			if ($this->aluno->autorizado){
				$checked='checked';
			}
			else{
				$checked='';
			}
			
			?>
			<input id="autorizacao" name="autorizacao" type="checkbox" onclick="autorizarInscricao(this.checked, <?php echo $this->aluno->bi; ?>);" <?php echo $checked; ?>>
			<DIV id="updating"> &nbsp; </DIV>
			<?php 
		}
		else{
			if ($this->aluno->autorizado){
				echo '<B>'.JText::_( 'INSCRICAO_AUTORIZADA' ).'</B>';
			}
			else{
				echo '<B>'.JText::_( 'INSCRICAO_N_AUTORIZADA' ).'</B>';
			}
		}
	}?>
	<BR>
	<BR>
	<H3><?php echo JText::_( 'INSCRICOES_ALUNO' ); ?></H3>
	<table width="100%"  id="invisivel">
	<?php for($i=0, $n=count($this->lista), $disc=""; $i<$n; $i++){
		$row=$this->lista[$i];
		if ($disc!=$row['disciplinas_designacao']){
			$disc=$row['disciplinas_designacao'];?>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3"><B><?php echo JText::_( 'DISCIPLINA' ); ?>:</B> <?php echo $row['disciplinas_designacao']; ?></td>
			</tr>
			<tr>
				<td width="50"></td>
				<td width="30" align="center"><B><?php echo JText::_( 'NUMERO_DO_MODULO' ); ?></B></td>
				<td><B><?php echo JText::_( 'NOME_DO_MODULO' ); ?></B></td>
			</tr>
		<?php }?>
			<tr>
				<td width="50"></td>
				<td width="30" align="center"><?php echo $row['modulos_numero']; ?></td>
				<td><?php echo $row['modulos_designacao']; ?></td>
			</tr>
	<?php }?>
	</table>
