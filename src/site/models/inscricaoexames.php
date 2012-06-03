<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelitem library
jimport('joomla.application.component.modelitem');

class inscricaoexamesModelinscricaoexames extends JModelItem{

	/**
	 * Counts the nbr of themes a student is enrolled in
	 * @author Herberto Graça
	 *			
	 * @param	$alunos_bi		the student ID
	 * @param	$disciplina_id	the subject ID
	 * @return					int
	 */
    public function countInscricoes($alunos_bi, $disciplina_id=false){ 
    	
    	$query="SELECT 
					count(alunos_bi) 
				FROM 
					#__inscricaoexames_inscricoes, #__inscricaoexames_modulos, #__inscricaoexames_disciplinas
				WHERE 
					#__inscricaoexames_inscricoes.modulos_id=#__inscricaoexames_modulos.id AND 
					#__inscricaoexames_modulos.disciplinas_id=#__inscricaoexames_disciplinas.id AND 
					#__inscricaoexames_inscricoes.alunos_bi=$alunos_bi";
		
    	if($disciplina_id) $query.=" AND #__inscricaoexames_disciplinas.id=$disciplina_id";
    	
		$db =JFactory::getDBO();   	
		$db->setQuery($query);
		        
		return $db->loadResult();
    }
    
	/**
	 * Deletes all enrollments in the application, or all the enrollments of a givem student
	 * @author Herberto Graça
	 *			
	 * @param	$alunos_id	if given, deletes all enrollments of the givem student
	 * @return				true on success
	 */
    public function resetInscricoes($alunos_bi=false){ 
		$db =JFactory::getDBO();  
		
    	If($alunos_bi){
    		$query="DELETE FROM #__inscricaoexames_inscricoes WHERE alunos_bi=$alunos_bi";
    	}
    	else{
			$query="DELETE FROM #__inscricaoexames_inscricoes";
    	}
		$db->setQuery($query);
		$out1=$db->query();
		
		$query="UPDATE `#__inscricaoexames_alunos` SET `autorizado` = '0'";
    	If($alunos_bi){
    		$query.=" WHERE bi=$alunos_bi";
    	}
		$db->setQuery($query);
		$out2=$db->query();
		        
		return ($out1 && $out2);
    }
    
	/**
	 * Deletes student enrollment in a given theme 
	 * @author Herberto Graça
	 *
	 * @param	alunos_bi		student ID
	 * @param	modulos_id		theme ID
	 * @param	db				database table object
	 * @return					true on success
	 */
    public function resetInscricao($alunos_bi, $modulos_id, $db){    	
		$query="DELETE FROM `#__inscricaoexames_inscricoes` WHERE alunos_bi=$alunos_bi AND modulos_id=$modulos_id";
		$db->setQuery($query);
		        
		return $db->query();
    }
    		
	/**
	 * enrolls a student in a given theme 
	 * @author Herberto Graça
	 *
	 * @param	alunos_bi		student ID
	 * @param	modulos_id		theme ID
	 * @param	db				database table object
	 * @return					true on success, or error message
	 */
    public function setInscricao($alunos_bi, $modulos_id, $db){   
    	     
		$query="INSERT INTO `#__inscricaoexames_inscricoes` VALUES ($alunos_bi, $modulos_id)";
		$db->setQuery($query);
		
		return $db->query();
    }
	
	
	/**  
	 * Returns an associative array with the themes IDs in which the student is enrolled
	 * @author Herberto Graça
	 *
	 * @param	alunos_bi	student ID
	 * @return				false ou um resultArray
	 */
    public function getIDsModulosInscritos($alunos_bi){
		$db =JFactory::getDBO();
		
		$query="SELECT modulos_id FROM `#__inscricaoexames_inscricoes` WHERE alunos_bi=$alunos_bi";
		$db->setQuery($query);
				
        return $db->loadResultArray();
    }
	
	/**  
	 * Returns the list of themes a student is enrolled in. 
	 * If autorizacao is given, it returns all students authorized enrrolments
	 * @author Herberto Graça
	 *
	 * @param	autorizacao		boolean, if we want only the authorized enrollments
	 * @param	alunos_id		student ID		
	 * @return					false ou um resultArray
	 */
    public function getModulosInscritos($autorizacao=false, $alunos_id=false){
    	
    	if (!$alunos_id){
    		$aluno="";
			if($autorizacao){
				$op='AND #__inscricaoexames_alunos.autorizado=1 ';
			}
			else{
				$op='';
			}			
    	}		
    	else{ 
    		$aluno="AND #__inscricaoexames_alunos.id=$alunos_id ";
    	}
    	
    	$db =JFactory::getDBO();
		$query="
		SELECT 
			#__inscricaoexames_alunos.nome AS alunos_nome, 
			#__inscricaoexames_modulos.numero AS modulos_numero, 
			#__inscricaoexames_modulos.designacao AS modulos_designacao, 
			#__inscricaoexames_disciplinas.designacao AS disciplinas_designacao , 
			#__inscricaoexames_cursos.sigla AS cursos_sigla 
		FROM 
			#__inscricaoexames_inscricoes, 
			#__inscricaoexames_modulos, 
			#__inscricaoexames_disciplinas, 
			#__inscricaoexames_alunos, 
			#__inscricaoexames_cursos
		WHERE 
			#__inscricaoexames_cursos.id = #__inscricaoexames_alunos.cursos_id AND 
			#__inscricaoexames_alunos.bi=#__inscricaoexames_inscricoes.alunos_bi AND 
			#__inscricaoexames_inscricoes.modulos_id=#__inscricaoexames_modulos.id AND 
			#__inscricaoexames_modulos.disciplinas_id=#__inscricaoexames_disciplinas.id $aluno $op
		ORDER BY 
			disciplinas_designacao, 
			modulos_numero, 
			cursos_sigla, 
			alunos_nome ASC";
		
		$db->setQuery($query);
		
        return $db->loadAssocList();
    }
    
}
