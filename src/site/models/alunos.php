<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelitem library
jimport('joomla.application.component.modelitem');

class inscricaoexamesModelAlunos extends JModelItem{
	
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
	public function getTable($type = 'alunos', $prefix = 'inscricaoexamesTable', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Checks if a student is registered in the application. If there is no Joomla ID associated with a personal ID, returns false.
	 * @author Herberto Graça
	 *
	 * @param	id			Joomla user ID (opcional)
	 * @return	boolean		
	 */
    public function registado($id=false){
    	if (!$id){
    		$user = JFactory::getUser();
    		$id=$user->id;
    	}
    	
    	$query = "SELECT bi FROM #__inscricaoexames_alunos WHERE id = $id";
    	$db=JFactory::getDBO();
    	$db->setQuery($query);
		    
		$result= $db->loadResult();
		
		if ($result) return $result;
		else return false;
    }
    
	/**
	 * Check if a student exists in the application
	 * @author Herberto Graça
	 *
	 * @param	bi			student personal ID nbr
	 * @return	boolean
	 */
    public function existe($bi){
        $table= $this->getTable();
        if (!$table->load($bi)) return false;
        return true;
    }
    
	/**
	 * Returns a Joomla ID associated with a personal ID
	 * Devolve o ID do Joomla correspondente a um BI da aplicação. Se o seu BI não existir na BD, devolve false. Se o ID n existir devolve null.
	 * @author Herberto Graça
	 *
	 * @param	bi		personal student ID
	 * @return			The Joomla ID correspondent to the personal ID given. False if the personal ID doesn't exist, NULL if the Joomla ID doesn't exist.
	 */
    public function getAlunoID($bi){
        $table= $this->getTable();
        if (!$table->load($bi)) return false;
        return $table->id;
    }
    
   	/**
	 * Associates a Joomal ID to a personal ID
	 * @author Herberto Graça
	 *
	 * @param	bi		personal student ID
	 * @return			true if successfull
	 */
    public function setAlunoID($bi, $id=false){
    	if (!$id){
    		$user = JFactory::getUser();
    		$id=$user->id;
    	}
        $db=JFactory::getDBO();
        $query = "UPDATE #__inscricaoexames_alunos SET id=$id WHERE bi=$bi";
		//dump($query,'$query');	
    	$db->setQuery($query);
		$out= $db->query();
			
		if(!$out) $this->setError(' '.$db->getError.' SQL: '.$query);
		return $out;
    }

   	/**
   	 * Deletes the association between a Joomla ID and a personal ID
   	 * @author Herberto Graça
   	 *
   	 * @param	bi		personal student ID
   	 * @return			true if successfull
	 */
    public function unSetAlunoID($bi){
        $db=JFactory::getDBO();
        $query = "UPDATE #__inscricaoexames_alunos SET id=NULL WHERE bi=$bi";	
    	$db->setQuery($query);
		$out= $db->query();
		
		if(!$out) $this->setError(' '.$db->getError);
		return $out;
    }   
	
	/**
	 * Insert student data
	 * @author Herberto Graça
	 *
	 * @param	id						Joomla ID
	 * @param	bi						personal ID
	 * @param	nome					student name
	 * @param	num						student nbr
	 * @param	$cursos_id				course ID
	 * @return							true on success
	 */
    public function setAluno($id, $bi, $nome, $cursos_id){
       
    	$db=JFactory::getDBO();
    	
    	if ($this->existe($bi)){ //if exists, update (the key is not autoincrement and the store() method assumes it should do an update because we give the ID )
	        $id = ($id == '') ? 'null' : $id;
        	
    		$query = "UPDATE #__inscricaoexames_alunos SET id=$id, nome='$nome', cursos_id=$cursos_id WHERE bi=$bi";
				
    		$db->setQuery($query);
		    
			$out= $db->query();
			
			if(!$out) $this->setError(' '.$db->getError.' SQL: '.$query);

			return $out;
    	}
    	else{ //if it doesn't exist, update
	        $query = "INSERT INTO #__inscricaoexames_alunos (bi, nome, cursos_id) VALUES ($bi, '$nome', $cursos_id)";
    		$db->setQuery($query);
		    
			return $db->query();
    	}
    }
		
	/**
	 * Insert student list in a course
	 * @author Herberto Graça
	 *
	 * @param	lista_de_items		Array with the class data to be inserted
	 * @param	$curso_id			The course ID
	 * @return						true on success
	 */
    public function insAlunos($lista_de_items, $curso_id){
        $erro="";
        $out=true;
        $mainframe = JFactory::getApplication();
        
    	foreach($lista_de_items as $item) {
    		if(!$this->setAluno(null, $item[0], $item[1], $curso_id)){
				$mainframe->enqueueMessage(JText::_( 'ERRO_GUARDAR_DADOS' ).$this->getError(), 'error');
				$out=false;
			}
		}
        return $out;
    }	 	
        
	/**
	 * Gets the list of alunos in a course
	 * @author Herberto Graça
	 * 
	 * @param	turmas_id	The course id
	 * @return	array 		the list of modules
	 */
    public function getAlunos($turmas_id){
    	$turmas_id=($turmas_id==0)? ' IS NULL' : '='.$turmas_id;
		$query = "SELECT * FROM #__inscricaoexames_alunos WHERE turmas_id$turmas_id AND integrado=1 ORDER BY numero, nome ASC";
		return $this->_getList( $query );
    }   
 
	/**
	 * Deletes a student
	 * @author Herberto Graça
	 *
	 * @param	id		student id
	 * @param	row		table object
	 * @return			true on success
	 */
    private function delAluno($id, $row){
    	        
        if(!$row->delete($id)){
            //handle failed delete
            $this->setError($row->getErrorMsg());
            return false;
        }
        return true;
    }
    
	/**
	 * delete a student list
	 * @author Herberto Graça
	 *
	 * @param	id_list		array with students IDs
	 * @return				true on success
	 */
    public function delAlunos($id_list){
        $erro="";
        $out=true;
        
        
    	foreach($id_list as $id) {
    		
        	$row= $this->getTable();
        	
			if(!$this->delAluno($id, $row)){
				$erro.="\n<BR>".$this->getError();
				$out=false;
			}
		}
        if (!$out) $this->setError(JText::_( 'ERRO_DEL_ALUNOS' ).$erro);
        return $out;
    }

	/**
	 * update several student data
	 * @author Herberto Graça
	 *
	 * @param	lista		array with student data
	 * @return				true on success
	 */
    public function updateAlunos($lista){
        $out=true;
        $mainframe = JFactory::getApplication();
        
    	foreach($lista as $linha) {
        	
			if(!$this->setAluno($linha['id'], $linha['bi'], $linha['nome'], $linha['cursos_id'])){
				$mainframe->enqueueMessage(JText::_( 'ERRO_UPDATE_ALUNOS' ).$this->getError(), 'error');
				$out=false;
			}
		}
        return $out;
    }

	/**
	 * Returns a student data (alunos, cursos)
	 * @author Herberto Graça
	 *
	 * @param	id		student id
	 * @return	Object	[id, nome, cursos_id, curso]
	 */
    public function getAluno($user_id){
		$query = "
		SELECT #__inscricaoexames_alunos.id, #__inscricaoexames_alunos.bi, #__inscricaoexames_alunos.nome, #__inscricaoexames_alunos.autorizado, #__inscricaoexames_cursos.id AS cursos_id, #__inscricaoexames_cursos.designacao AS curso
		FROM #__inscricaoexames_alunos, #__inscricaoexames_cursos 
		WHERE #__inscricaoexames_alunos.id=$user_id AND #__inscricaoexames_alunos.cursos_id=#__inscricaoexames_cursos.id";
				
		return $this->_getList( $query );
		
    }
    
	/**
	 * Deletes association between students and classes, putting all student nbr and class ID as NULL
	 * @author Herberto Graça
	 *
	 * @return				true on success
	 * @deprecated
	 */
    /*
    public function resetAlunosTurmas(){ 
		$db =JFactory::getDBO();   	
		$query = "UPDATE #__inscricaoexames_alunos SET numero=null, turmas_id=null";
		$db->setQuery($query);
		        
		return $db->query();
    }
    */
	/**
	 * Returns a list of the students in a course
	 * @author Herberto Graça
	 *
	 * @param	cursos_id		course ID
	 * @return					associative array
	 */
    public function getAlunosCurso($cursos_id){   		
		$query = "SELECT * FROM #__inscricaoexames_alunos WHERE cursos_id=$cursos_id ORDER BY nome ASC";
		return $this->_getList( $query );
    }

	/**
	 * Puts the user in the students group
	 * @author Herberto Graça
	 *
	 * @param	userID			
	 * @param	grpID			
	 * @return					associative array
	 * @deprecated
	 */
    /*
    public function setGrupo($userID, $grpID){  
		$db =JFactory::getDBO();
		$query='INSERT INTO `#__user_usergroup_map` VALUES ('.$userID.','.$grpID.')';
		$db->setQuery($query);	
		return $db->query();
    }
	*/
	/**
	 * set the exam authorization for a student 
	 * @author Herberto Graça
	 * 
	 * @param	alunos_bi		the student ID
	 * @param	value			boolean, the value to set
	 * @return					true on success
	 */
    public function setAutorizacao($alunos_bi,$value){
		$db =JFactory::getDBO();
    	$query="UPDATE `#__inscricaoexames_alunos` SET `autorizado` = '$value' WHERE `#__inscricaoexames_alunos`.`bi` =$alunos_bi";
		$db->setQuery($query);	
		return $db->query();
    }

}