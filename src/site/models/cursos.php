<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelitem library
jimport('joomla.application.component.modelitem');

class inscricaoexamesModelcursos extends JModelItem{
	
	/**
	 * Returns a reference to the a Table object, always creating it.
	 * @author Herberto Graça
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
	public function getTable($type = 'cursos', $prefix = 'inscricaoexamesTable', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	/**
	 * Inserts data of a list of courses into the DB
	 * @author Herberto Graça
	 *
	 * @param	lista_de_cursos		associative array
	 * @return						true on success
	 */
    public function insCursos($lista_de_cursos){
        $erro="";
        $out=true;
        
        
    	foreach($lista_de_cursos as $curso) {
    		
        	
			if(!$this->insCurso($curso['id'], trim($curso['designacao'],'\r'), $curso['sigla'])){
				$erro.="\n<BR>".$this->getError();
				$out=false;
			}
		}
        if (!$out) $this->setError(JText::_( 'ERRO_INS_CURSOS' ).$erro);
        return $out;
    }    
    	
	/**
	 * Inserts a course data into the DB
	 * @author Herberto Graça
	 *
	 * @param	curso	The course name to be inserted
	 * @param	table	JTable representing the table where insertion is to be made
	 * @return			true on success
	 */
    private function insCurso($id, $designacao, $sigla){
        
        $row= $this->getTable();
        $row->set('id',$id);
        $row->set('designacao',$designacao);
        $row->set('sigla',$sigla);
        
        
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
	 * Counts the number of courses
	 * @author Herberto Graça
	 *			
	 * @return		int
	 */
    public function countCursos(){ 
    	
    	$query="SELECT 
					count(id) 
				FROM 
					#__inscricaoexames_cursos";				
		    	
		$db =JFactory::getDBO();   	
		$db->setQuery($query);
		        
		return $db->loadResult();
    }
	/**
	 * Gets the list of courses data from the DB
	 * @author Herberto Graça
	 *
	 * @return	array the list of courses data
	 */
    public function getCursos(){
		$query = "SELECT * FROM #__inscricaoexames_cursos ORDER BY designacao ASC";
		return $this->_getList( $query );
    }
    
	/**
	 * Deletes the course from the DB
	 *
	 * @param	id		The course id
	 * 
	 * @return	true on success
	 */
    private function delCurso($id, $row){
    	        
        if(!$row->delete($id)){
            //handle failed delete
            $this->setError($row->getErrorMsg());
            return false;
        }
        return true;
    }

	/**
	 * Deletes the list of courses data from the DB
	 * @author Herberto Graça
	 *
	 * @param	id_list		An array with the courses id
	 * 
	 * @return	true on success
	 */
    public function delCursos($id_list){
        $erro="";
        $out=true;
        
        
    	foreach($id_list as $id) {
    		
        	$row= $this->getTable();
        	
			if(!$this->delCurso($id, $row)){
				$erro.="\n<BR>".$this->getError();
				$out=false;
			}
		}
        if (!$out) $this->setError(JText::_( 'ERRO_DEL_CURSOS' ).$erro);
        return $out;
    }

	/**
	 * Gets a list of course/disciplinas data
	 * @author Herberto Graça
	 *
	 * @param	curso		The course id
	 * @return				array comas disciplinas do curso
	 */
    public function getCursoDisciplinas($curso){
        $erro="";
        $out=true;
        
		$db =JFactory::getDBO();
		
		$query="SELECT disciplinas_id FROM `#__inscricaoexames_cursos_disciplinas` WHERE curso_id=$curso";
		$db->setQuery($query);	
		
		$id=$db->loadResult();
		$id=$db->loadNextRow();
		
        return $out;
    }
}

