<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelitem library
jimport('joomla.application.component.modelitem');

class inscricaoexamesModeldisciplinas extends JModelItem{
	
	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
	public function getTable($type = 'disciplinas', $prefix = 'inscricaoexamesTable', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Conta o número de disciplinas. Se $cursos_id for fornecido, conta o num de disciplinas daquele curso. 
	 * @author Herberto Graça
	 *			
	 * @param	$cursos_id	Se existir, conta as disciplinas deste curso especifico
	 * @return				int
	 */
    public function countDisciplinas($cursos_id=false){ 
    	
    	$query="SELECT 
					count(id) 
				FROM 
					#__inscricaoexames_disciplinas";				
		
    	if($cursos_id) $query.="
    			WHERE 
					#__inscricaoexames_disciplinas.id=#__inscricaoexames_cursos_disciplinas.disciplinas_id AND
					#__inscricaoexames_cursos_disciplinas.cursos_id=$cursos_id";
    	
		$db =JFactory::getDBO();   	
		$db->setQuery($query);
		        
		return $db->loadResult();
    }
    	
	/**
	 * Inserts a course data into the DB
	 *
	 * @param	disciplina		The course name to be inserted
	 * @param	row			JTable representing the table where insertion is to be made
	 * @return					true on success
	 */
    private function insDisciplina($disciplina, $row){
        
        $row->set('designacao',$disciplina);
        
        
        // Make sure the record is valid
        if (!$row->check()) {
            $this->setError($row->getError());
            return false;
        }
    
        // Store the data in the database
        if (!$row->store()) {
            $this->setError($row->getError());
            return false;
        }
        
        return true;
    }
	
	/**
	 * Inserts a list of courses data into the DB
	 *
	 * @param	lista_de_disciplinas		The courses data to be inserted
	 * @return								true on success
	 */
    public function insDisciplinas($lista_de_disciplinas){
        $erro="";
        $out=true;
        
        
    	foreach($lista_de_disciplinas as $disciplina) {
    		
        	$row= $this->getTable();
        	
			if(!$this->insDisciplina(trim($disciplina,'\r'), $row)){
				$erro.="\n<BR>".$this->getError();
				$out=false;
			}
		}
        if (!$out) $this->setError(JText::_( 'ERRO_INS_DISCIPLINAS' ).$erro);
        return $out;
    }
    
	/**
	 * Gets the list of subjects from the DB
	 * If the course ID is given, it returns the list of subjects in that course
	 *
	 * @param	$curso_id	the course ID
	 * @return	array 		the list of courses data
	 */
    public function getDisciplinas($curso_id=false){
    	if (!$curso_id)
			$query = "SELECT * FROM #__inscricaoexames_disciplinas ORDER BY designacao ASC";
		else
			$query = "SELECT * FROM #__inscricaoexames_disciplinas, #__inscricaoexames_cursos_disciplinas WHERE #__inscricaoexames_cursos_disciplinas.cursos_id=$curso_id AND #__inscricaoexames_cursos_disciplinas.disciplinas_id=#__inscricaoexames_disciplinas.id ORDER BY designacao ASC";
		return $this->_getList( $query );
    }
    
	/**
	 * Gets the subject a given theme belongs to
	 *
	 * @param	modulos_id		the theme ID
	 * @return	array 			the list of courses data
	 */
    public function getDisciplinaModulo($modulos_id){
    	$query = "
    		SELECT 
    			#__inscricaoexames_disciplinas.id, 
    			#__inscricaoexames_disciplinas.designacao 
    		FROM 
    			#__inscricaoexames_disciplinas, 
    			#__inscricaoexames_modulos 
    		WHERE 
    			#__inscricaoexames_modulos.id=$modulos_id AND 
    			#__inscricaoexames_modulos.disciplinas_id=#__inscricaoexames_disciplinas.id";
		
		$db =JFactory::getDBO();
		$db->setQuery($query);
		return $db->loadAssoc();
    }
    
	/**
	 * Deletes the course from the DB
	 *
	 * @param	id				The course id
	 * @param	row		JTable	A database object 
	 * @return					true on success
	 */
    private function delDisciplina($id, $row){
    	        
        if(!$row->delete($id)){
            //handle failed delete
            $this->setError($row->getErrorMsg());
            return false;
        }
        return true;
    }

	/**
	 * Deletes the list of courses data from the DB
	 *
	 * @param	id_list		An array with the courses id
	 * @return				true on success
	 */
    public function delDisciplinas($id_list){
        $erro="";
        $out=true;
        
        
    	foreach($id_list as $id) {
    		
        	$row= $this->getTable();
        	
			if(!$this->delDisciplina($id, $row)){
				$erro.="\n<BR>".$this->getError();
				$out=false;
			}
		}
        if (!$out) $this->setError(JText::_( 'ERRO_DEL_DISCIPLINAS' ).$erro);
        return $out;
    }
    
}
