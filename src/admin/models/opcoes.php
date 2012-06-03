<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelitem library
jimport('joomla.application.component.modelitem');

class inscricaoexamesModelOpcoes extends JModelItem{
	
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
	public function getTable($type = 'opcoes', $prefix = 'inscricaoexamesTable', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	/**
	 * Returns a list of all the Joomla user groups available
	 * @author Herberto Graça
	 *
	 * @return	array 	associative array with all data from table usergroups
	 */
    public function getGruposJoomla(){        
		$db =JFactory::getDBO();		
		$query="SELECT * FROM `#__usergroups`";
		$db->setQuery($query);	
		return $db->loadAssocList();
    }
	
	/**
	 * Returns one of the application options 
	 * @author Herberto Graça
	 * 
	 * @param	$op 	one of the variables of the options table (OP_GRP_ALUNOS, OP_APROVAR_INS)
	 * @return	array 	associative array with all data from table opcoes
	 */
    public function getOpcao($op){  
		$db =JFactory::getDBO();	
		$query="SELECT value FROM `#__inscricaoexames_opcoes` WHERE var='$op'";
		$db->setQuery($query);	
		$out=$db->loadAssocList();
		return $out[0]['value'];
    }
    
	/**
	 * set one of the application options
	 * @author Herberto Graça
	 *
	 * @param	$var 		one of the variables of the options table (OP_GRP_ALUNOS, OP_APROVAR_INS)
	 * @param	$value 		new value
	 * @return	boolean
	 */
    public function setOpcao($var, $value){  
    
        $table= $this->getTable();
        if ($value=='') $value=null;
        $table->set('value',$value);
        $table->set('var',$var);
        
        // Make sure the record is valid
        if (!$table->check()) {
            $this->setError($table->getError());
            return false;
        }
    
        // Store the data in the database
        if (!$table->store(true)) {
            $this->setError($table->getError());
            return false;
        }
        
        return true;
    }
    	
	/**
	 * Links a Joomla users group with one of the application group
	 * @author Herberto Graça
	 * @deprecated
	 *
	 * @return	boolean
	 */
    /*
    public function setGruposComp($IDComp, $IDJoomla){  
    
        $table= $this->getTable();
        
	    if (!$table->load($IDComp)){
            $this->setError($table->getError());			
            return false;
		}
		
        if ($IDJoomla=='') $IDJoomla=null;
        $table->set('usergroups_id',$IDJoomla);
        
        // Make sure the record is valid
        if (!$table->check()) {
            $this->setError($table->getError());
            return false;
        }
    
        // Store the data in the database
        if (!$table->store(true)) {
            $this->setError($table->getError());
            return false;
        }
        
        return true;
    }
    */
}

