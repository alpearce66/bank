<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_bank
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined ( '_JEXEC' ) or die ( 'Restricted access' );

/**
 * Bank Model
 *
 * @since 0.0.1
 */
class BankModelExpense extends JModelAdmin {
	function __construct() {
		
		parent::__construct ();
		
		dump ( $trans_id, "ExpenseForm - __construct xx in" );
		$mainframe = JFactory::getApplication ();
		
		// Should be recieve with the view class.
		$trans_id = $mainframe->getUserStateFromRequest ( 'trans_id', 'trans_id', 0, 'int' );
		$this->setState ( 'trans_id', $trans_id );
		
		dump ( $trans_id, "ExpenseForm - __construct xx out" );
	}
	
	/**
	 * Method to get a table object, load it if necessary.
	 *
	 * @param string $type
	 *        	The table name. Optional.
	 * @param string $prefix
	 *        	The class prefix. Optional.
	 * @param array $config
	 *        	Configuration array for model. Optional.
	 *        	
	 * @return JTable A JTable object
	 *        
	 * @since 1.6
	 */
	public function getTable($type = 'Expense', $prefix = 'ExpenseTable', $config = array()) {
		return JTable::getInstance ( $type, $prefix, $config );
	}
	
	/**
	 * Method to get the record form.
	 *
	 * @param array $data
	 *        	Data for the form.
	 * @param boolean $loadData
	 *        	True if the form is to load its own data (default case), false if not.
	 *        	
	 * @return mixed A JForm object on success, false on failure
	 *        
	 * @since 1.6
	 */
	public function getForm($data = array(), $loadData = true) {
		// Get the form.
		dump ( $this, "ExpenseForm - getForm" );
		
		$form = $this->loadForm ( 'com_bank.expense', 'expense', array (
				'control' => 'jform',
				'load_data' => $loadData 
		) );
		
		if (empty ( $form )) {
			return false;
		}
		
		return $form;
	}
	

	public function getItem() {
	
		// Check the session for previously entered form data.
		dump ( $this, "ExpenseForm - returnData" );
	
		$data = JFactory::getApplication ()->getUserState ( 'com_bank.expense.data', array () );
	
		if (empty ( $data )) {
				
			// Initialize variables.
			$db = JFactory::getDbo ();
			$query = $db->getQuery ( true );
				
			$trans_id = JFactory::getApplication ()->input->get ( 'trans_id' );
				
			if (trans_id == null) {
				$trans_id = $this->getState ( 'trans_id' );
			}
				
			// Create the base select statement.
			$query->select ( '*' )->where ( $db->quoteName ( 'trans_id' ) . " = " . $db->quote ( $trans_id ) )->from ( $db->quoteName ( '#__bank_expense' ) );
				
			$db->setQuery ( $query );
			$row = $db->loadAssoc ();
				
			// Check that we have a result.
			if (empty ( $row )) {
				$data = false;
			} else {
				// Bind the object with the row and return.
				$data = $this->getTable ();
				$res = $data->bind ( $row );
			}
		}
	
		return $data;
	}
	
	
	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return mixed The data for the form.
	 *        
	 * @since 1.6
	 */
	protected function loadFormData() {
		// Check the session for previously entered form data.
		dump ( $this, "ExpenseForm - loadFormData" );
		
		$data = $this->getItem();
		
		$mainframe = JFactory::getApplication ();
		$limit = $mainframe->getUserStateFromRequest ( 'global.list.limit', 'limit', $mainframe->getCfg ( 'list_limit' ), 'int' );
		$limitstart1 = $mainframe->getUserStateFromRequest ( 'limitstart', 'limitstart', 0, 'int' );
		
		return $data;
	}

	public function save() {
		// Check the session for previously entered form data.
		dump ( $this, "Expense - save" );
		
		$table   = $this->getTable();
		$isNew = true;
		
		// Load the row if saving an existing item.
		if ($trans_id > 0)
		{
			$table->load($trans_id);
			$isNew = false;
		}
		
		// Bind the data.
		if (!$table->bind($data))
		{
			$this->setError($table->getError());
		
			return false;
		}
		
		// Check the data.
		if (!$table->check())
		{
			$this->setError($table->getError());
		
			return false;
		}
		
		// Store the data.
		if (!$table->store())
		{
			$this->setError($table->getError());
		
			return false;
		}
		
		// Clean the cache.
		$this->cleanCache();
		
		return true;
		
	}

}