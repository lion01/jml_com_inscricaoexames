<?php 
// no direct access
defined('_JEXEC') or die('Restricted access'); 

$linkInsCursos="index?option=com_inscricaoexames&view=cursos&layout=inserircursos";
$linkInsDisc="index?option=com_inscricaoexames&view=disciplinas&layout=inserirdisciplinas";
$linkCursosDisc="index?option=com_inscricaoexames&view=cursos&layout=editardisccursos";
$linkInsModulos="index?option=com_inscricaoexames&view=modulos&layout=inserirmodulos";
$linkInsAlunos="index?option=com_inscricaoexames&view=alunos&layout=inseriralunos";

$linkEditCursos="index?option=com_inscricaoexames&view=cursos&layout=editarcursos";
$linkEditDisc="index?option=com_inscricaoexames&view=disciplinas&layout=verdisciplinas";
$linkEditModulos="index?option=com_inscricaoexames&view=modulos&layout=editarmodulos";
$linkEditAlunos="index?option=com_inscricaoexames&view=alunos&layout=editaralunos";

$linkInscrVerTodas="index?option=com_inscricaoexames&view=inscricaoexames&layout=default";
$linkInscrVerUma="index?option=com_inscricaoexames&view=inscricaoexames&layout=escolheralunos";
$linkInscrEliminarTodas="index?option=com_inscricaoexames&view=inscricaoexames&layout=eliminarinscricoes";

$linkOpcoes="index?option=com_inscricaoexames&view=opcoes&layout=default";
?>
<H1><?php echo JText::_( 'MENU_ADMIN_EXAMES' ); ?></H1>

<table width="100%">
  <thead align="center" valign="middle">
    <tr>
      <th width="33%">Inserir dados</th>
      <th width="33%">Consultar/editar dados</th>
      <th width="33%">Exames</th>
    </tr>
  </thead>
  <tbody align="center" valign="middle">
    <tr>
    	<td><a href="<?php echo $linkInsCursos;?>">Cursos</a></td>
    	<td><a href="<?php echo $linkEditCursos;?>">Cursos</a></td>
    	<td><a href="<?php echo $linkInscrVerTodas;?>">Ver todas as inscrições</a></td>
    </tr>
    <tr>
    	<td><a href="<?php echo $linkInsDisc;?>">Disciplinas</a></td>
    	<td><a href="<?php echo $linkEditDisc;?>">Disciplinas</a></td>
    	<td><a href="<?php echo $linkInscrVerUma;?>">Ver/aceitar inscrições de um aluno</a></td>
    </tr>
    <tr>
    	<td><a href="<?php echo $linkCursosDisc;?>">Cursos/disciplinas</a></td>
    	<td><a href="<?php echo $linkCursosDisc;?>">Cursos/disciplinas</a></td>
    	<td><a href="<?php echo $linkInscrEliminarTodas;?>">Eliminar inscrições</a></td>
    </tr>
    <tr>
    	<td><a href="<?php echo $linkInsModulos;?>">Módulos</a></td>
    	<td><a href="<?php echo $linkEditModulos;?>">Módulos</a></td>
    	<td></td>
    </tr>
    <tr>
    	<td><a href="<?php echo $linkInsAlunos;?>">Alunos</a></td>
    	<td><a href="<?php echo $linkEditAlunos;?>">Alunos</a></td>
    	<td><a href="<?php echo $linkOpcoes;?>">Editar opções</a></td>
    </tr>
  </tbody>
</table>

