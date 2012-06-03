<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

JHtml::addIncludePath(JPATH_COMPONENT.DS.'helpers');

if (!$this->print){
	echo '<H1>'.JText::_( 'VER_INSCRICOES' ).'</H1>';
} 
	
$n=count($this->lista);
if ($n==0){
	echo '<H3>'.JText::_( 'NAO_HA_INSCRICOES' ).'</H3>';
}
else{
			
	if (!$this->print){
		echo JHtml::_('icon.print_popup', $this->option, $this->view, $this->layout);
	}
?>
<table width="100%" id="invisivel">
<?php 
	for($i=0, $disc="", $mod=""; $i<$n; $i++){
		$row=$this->lista[$i];
		if ($disc!=$row['disciplinas_designacao']){
			$disc=$row['disciplinas_designacao'];?>
			<tr class="break"><td colspan="3"><?php if ($this->print) echo '<H1>'.JText::_( 'VER_INSCRICOES' ).'</H1>'; else echo '&nbsp;'; ?></td></tr>
			<tr><td colspan="3">&nbsp;</td></tr>
			<tr>
				<td colspan="3"><B><?php echo JText::_( 'DISCIPLINA' ); ?>:</B> <?php echo $row['disciplinas_designacao']; ?></td>
			</tr>
		<?php }
		if ($mod!=$row['modulos_designacao']){
			$mod=$row['modulos_designacao'];?>
			<tr><td colspan="3">&nbsp;</td></tr>
			<tr>
				<td width="50"></td>
				<td colspan="2"><B><?php echo JText::_( 'MODULO' ); ?>:</B> <?php echo $row['modulos_numero'].' - '.$row['modulos_designacao']; ?></td>
			</tr>
		<?php };?>
			<tr>
				<td width="50"></td>
				<td width="50"></td>
				<?php //TODO: Fazer com que na impressão dos exames, se o aluno for n integr. aparece a sigla do curso em vez da turma e nº ?>
				<td><?php echo $row['cursos_sigla'].' - '.$row['alunos_nome']; ?></td>
			</tr>
	<?php }?>
</table>
<?php }?>

