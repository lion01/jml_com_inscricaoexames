<?php

// No direct access
defined('_JEXEC') or die('Restricted access');

// import Joomla table library
jimport('joomla.database.table');

/**
 * Maps a php object to a database table
 *
 * @author herberto
 *
 */
class inscricaoexamesTablemodulos extends JTable
{
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function __construct(& $db) {
		parent::__construct('#__inscricaoexames_modulos', 'id', $db);
	}

}
?>
