<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelitem library
jimport('joomla.application.component.modelitem');

class inscricaoexamesModelcursosdisciplinas extends JModelItem{
		
	/**
	 * Inserts a course/disciplina data into the DB
	 *
	 * @param	curso		The course id to be inserted
	 * @param	disciplinas	The disciplina id to be inserted
	 * @param	db			The database object
	 * @return				true on success
	 */
    public function delCurso($curso, $db=null){
    	if ($db==null) $db =JFactory::getDBO();
    	
		$query="DELETE FROM `#__inscricaoexames_cursos_disciplinas` WHERE cursos_id=$curso";
		$db->setQuery($query);
				
		if(!$db->query()) return false;
		        
        return true;
    }
    		
	/**
	 * Inserts a course/disciplina data into the DB
	 *
	 * @param	curso		The course id to be inserted
	 * @param	disciplinas	The disciplina id to be inserted
	 * @param	db			The database object
	 * @return				true on success
	 */
    private function insCursoDisciplina($curso, $disciplina, $db){
        
		$query="INSERT INTO `#__inscricaoexames_cursos_disciplinas` VALUES ($curso, $disciplina)";
		$db->setQuery($query);
		
		if(!$db->query()) return false;
		        
        return true;
    }
	
	/**
	 * Inserts a list of course/disciplinas data into the DB
	 *
	 * @param	curso		The course id to be inserted
	 * @param	disciplinas	An array with the disciplinas id
	 * @return				true on success
	 */
    public function insCursoDisciplinas($curso, $disciplinas){
        $erro="";
        $out=true;
        
		$db =JFactory::getDBO();
		
    	foreach($disciplinas as $disciplina) {
    		        	
			if(!$this->insCursoDisciplina($curso, $disciplina, $db)){
				$erro.="\n<BR>".$db->getError();
				$out=false;
			}
			
		}
		
        if (!$out) $this->setError(JText::_( 'ERRO_GUARDAR_DADOS' ).$erro);
        return $out;
    }
	
	/**
	 * Inserts a list of course/disciplinas data into the DB
	 *
	 * @param	curso		The course id to be inserted
	 * @param	disciplinas	An array with the disciplinas id
	 * @return				true on success
	 */
    public function getDisciplinas($curso){
    	
		$db =JFactory::getDBO();
		
		$query="SELECT disciplinas_id FROM `#__inscricaoexames_cursos_disciplinas` WHERE cursos_id=$curso";
		$db->setQuery($query);
		
		if(!$db->query()) return false;
		
        return $db->loadResultArray();
    }

}

