<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelitem library
jimport('joomla.application.component.modelitem');

class inscricaoexamesModelModulos extends JModelItem{
	
	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
	public function getTable($type = 'modulos', $prefix = 'inscricaoexamesTable', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	/**
	 * Returns the subject ID for which a theme belongs to
	 *
	 * @param	$modulos_id			theme ID
	 * @return	int					subject ID
	 */
    public function getDiscID($modulos_id){
		$db =JFactory::getDBO();
		$query="SELECT disciplinas_id FROM `#__inscricaoexames_modulos` WHERE id=$modulos_id";
		$db->setQuery($query);
        return $db->loadResult();
    }
    	
	/**
	 * Inserts a module data into the DB
	 *
	 * @param	modulo	The module name to be inserted
	 * @param	table	JTable representing the table where insertion is to be made
	 * @return			true on success
	 */
    private function insModulo($numero, $modulo, $disciplinas_id, $row){
        
        $row->set('numero',$numero);
        $row->set('designacao',$modulo);
        $row->set('disciplinas_id',$disciplinas_id);
        
        
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
	 * Inserts a list of modules data into the DB
	 *
	 * @param	lista_de_modulos	Array with the modules data to be inserted
	 * @return						true on success
	 */
    public function insModulos($lista_de_modulos, $disciplinas_id){
        $erro="";
        $out=true;
        
        
    	foreach($lista_de_modulos as $modulo) {
    		
        	$numUltimoMod=$this->getUltimoModulo($disciplinas_id);
        	
        	$row= $this->getTable();
        	
			if(!$this->insModulo($numUltimoMod+1, trim($modulo,'\r'), $disciplinas_id, $row)){
				$erro.="\n<BR>".$this->getError();
				$out=false;
			}
		}
        if (!$out) $this->setError(JText::_( 'ERRO_INS_MODULOS' ).$erro);
        return $out;
    }	
    	
	/**
	 * Gets the number of the last inserted module, for the given discipline
	 *
	 * @param	disciplinas_id	Array with the modules data to be inserted
	 * @return					the number on success, false on error
	 */
    private function getUltimoModulo($disciplinas_id){
    	
		$db =JFactory::getDBO();
		
		$query="SELECT numero FROM `#__inscricaoexames_modulos` WHERE disciplinas_id=$disciplinas_id ORDER BY numero DESC";
		$db->setQuery($query);
		
		if(!$db->query()){ 
			$this->setError(JText::_( 'ERRO_GET_ULTIMO_MODULO' )."\n<BR>".$this->getError());
			return false;
		}
        return $db->loadResult();
    }	
    
	/**
	 * Gets the list of modules in a subject
	 *
	 * @return	array the list of modules
	 */
    public function getModulos($disciplinas_id){
		$query = "SELECT * FROM #__inscricaoexames_modulos WHERE disciplinas_id=$disciplinas_id ORDER BY numero ASC";
		return $this->_getList( $query );
    }   
    
	/**
	 * Gets a theme data
	 *
	 * @return	array 
	 */
    public function getModulo($id){
		$query = "SELECT * FROM #__inscricaoexames_modulos WHERE id=$id";
		$db =JFactory::getDBO();
		$db->setQuery($query);
		return $db->loadAssoc();
    }   
    
	/**
	 * Deletes the theme from the DB
	 *
	 * @param	id		The theme id	 * 
	 * @return	true on success
	 */
    private function delModulo($id, $row){
    	        
        if(!$row->delete($id)){
            //handle failed delete
            $this->setError($row->getErrorMsg());
            return false;
        }
        return true;
    }
    
	/**
	 * Deletes the list of themes data from the DB
	 *
	 * @param	id_list		An array with the themes id	 * 
	 * @return				true on success
	 */
    public function delModulos($id_list){
        $erro="";
        $out=true;
        
        
    	foreach($id_list as $id) {
    		
        	$row= $this->getTable();
        	
			if(!$this->delModulo($id, $row)){
				$erro.="\n<BR>".$this->getError();
				$out=false;
			}
		}
        if (!$out) $this->setError(JText::_( 'ERRO_DEL_MODULOS' ).$erro);
        return $out;
    }


	/**
	 * Inserts a theme data into the DB
	 *
	 * @param	id			The theme id
	 * @param	numero		The theme number
	 * @param	designacao	the theme name
	 * @param	table		JTable representing the table where insertion is to be made
	 * @return				true on success
	 */
    private function updateModulo($id, $numero, $designacao, $row){
        
        $row->set('id',$id);
        $row->set('numero',$numero);
        $row->set('designacao',$designacao);
        
        
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
	 * Updates a list of themes
	 *
	 * @param	lista_de_modulos	The theme list to update
	 * @return						true on success
	 */
    public function updateModulos($lista_de_modulos){
        $erro="";
        $out=true;
        
        
    	foreach($lista_de_modulos as $modulo) {
    		
        	$row= $this->getTable();
        	
			if(!$this->updateModulo($modulo['id'], $modulo['numero'], $modulo['designacao'], $row)){
				$erro.="\n<BR>".$this->getError();
				$out=false;
			}
		}
        if (!$out) $this->setError(JText::_( 'ERRO_UPDATE_MODULOS' ).$erro);
        return $out;
    }
    
}













