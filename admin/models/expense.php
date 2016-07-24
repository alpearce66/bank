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
		
		dump ( $this, "BankModelExpense - __construct in" );
		
		parent::__construct ();
		
		$app = JFactory::getApplication ();
		
		// Get component name for use in saving state.
		$option = JRequest::getVar('option');
		
		// Clear the transaction ID as now saved.
		$trans_id = $app->input->get('trans_id', null, 'int');
		if (is_null($trans_id)) {
			$cids = $app->input->get('cid', null, 'array');
			$trans_id = $cids[0];
		}
		
		// Should be recieve with the view class.
		$app->setUserState("$option.expenses.trans_id", $trans_id);

		dump ( $trans_id, "BankModelExpense - __construct out" );
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

		dump ( $this, "BankModelExpense - getForm in" );
		
		// Get component name for use in saving state.
		$option = JRequest::getVar('option');
		
		// Get the form.
		$form = $this->loadForm ( "$option.expense", 'expense', array (
				'control' => 'jform',
				'load_data' => $loadData 
		) );
		
		if (empty ( $form )) {
			return false;
		}
		
		dump ( $this, "BankModelExpense - getForm out" );
		
		return $form;
	}
	

	public function getItem() {
	
		dump ( $this, "BankModelExpense - getItem in" );
	
		// Check the session for previously entered form data.
		$app = JFactory::getApplication();

		// Get component name for use in saving state.
		$option = JRequest::getVar('option');
		
		$cids = $app->getUserStateFromRequest ( '', 'cid', null, 'array' );
		$trans_id = (int)$cids[0];
		
		$data = $app->getUserState ( "$option.expense.data", array () );
	
		if (empty ( $data )) {
				
			// Initialize variables.
			$db = JFactory::getDbo ();
			$query = $db->getQuery ( true );
				
			// Check for a trans id on the request.
			//$trans_id = $app->input->get ( 'trans_id' );
				
			if ($trans_id == null) {
				$trans_id = $app->getUserState("$option.expenses.trans_id");
			}
				
			// Create the base select statement.
			$query->select ( '*' )->where ( $db->quoteName ( 'trans_id' ) . " = " . $db->quote ( $trans_id ) )->from ( $db->quoteName ( '#__bank_expense' ) );
				
			$db->setQuery ( $query );
			$row = $db->loadAssoc ();
				
			// Check that we have a result.
			if (empty ( $row )) {
				
				// If the trans_id was non zero this is and error, transaction not found.
				$data = false;
				
				// If the trans_id is zero we are adding a new record so set it up as necessary.
				if ($trans_id == null or $trans_id == 0) {
					$row->date = date('Y-m-d');
					$row->acc_id = $app->getUserState("$option.expenses.acc_id");
					$data = $this->getTable ();
					$res = $data->bind ( $row );
				}	
				
				
			} else {
				// Bind the object with the row and return.
				$data = $this->getTable ();
				$res = $data->bind ( $row );
			}
		}
	
		dump ( $data, "BankModelExpense - getItem out" );
		
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
		dump ( $this, "BankModelExpense - loadFormData in" );
		
		// Check the session for previously entered form data.
		$data = $this->getItem();
		
		$app = JFactory::getApplication ();
		
		$limit = $app->getUserStateFromRequest ( 'global.list.limit', 'limit', $app->getCfg ( 'list_limit' ), 'int' );
		
		dump ( $this, "BankModelExpense - loadFormData out" );
		
		return $data;
	}

	public function save($data) {

		dump ( $this, "BankModelExpense - save in" );
				
		$app = JFactory::getApplication ();
		
		// Get component name for use in saving state.
		$option = JRequest::getVar('option');
		
		$trans_id = $app->getUserState("$option.expenses.trans_id");
		$acc_id = $app->getUserState("$option.accounts.acc_id");
		
		// Check the session for previously entered form data.
		$data[date] = strtotime($data[date]);
		$data[acc_id] = $acc_id;
		
		$table   = $this->getTable();
		$isNew = true;
		$currentAmount=0;

		// Load the row if saving an existing item.
		if ($trans_id > 0)
		{
			$table->load($trans_id);
			$isNew = false;
				
			// Take into account any change in amount.
			$currentAmount=$table->amount;
				
		}
		
		dump ( $data, "BankModelExpense - what are we saving" );
				
		// Bind the data.
		if (!$table->bind($data))
		{
			$this->setError($table->getError());
			dump ( $this, "BankModelExpense - save out" );
				
			return false;
		}
		
		// Check the data.
		if (!$table->check())
		{
			$this->setError($table->getError());
			dump ( $this, "BankModelExpense - save out" );
				
			return false;
		}
		
		// Store the data.
		if (!$table->store())
		{
			$this->setError($table->getError());
			dump ( $this, "BankModelExpense - save out" );
				
			return false;
		}
		
		// Clean the cache.
		$this->cleanCache();
		
		$accountModel = $this->getInstance('Account', 'BankModel', array ('ignore_request' => true));
		
		// Update the balance.
		$acc_value = $accountModel->getAccountValue($acc_id);

		dump ( $acc_value, "BankModelExpense - Account current value" );
		dump ( $data[amount], "BankModelExpense - Account value to add" );

		$acc_value = $accountModel->getAccountValue($acc_id) + $data[amount] - $currentAmount;
		
		$accountModel->setAccountValue($acc_id,$acc_value);

		
		
		// Clear the transaction ID as now saved.
		$app->setUserState("$option.expenses.trans_id", 0);
		
		dump ( $this, "BankModelExpense - save out" );
		dump ( $acc_id, "BankModelExpense - save out acc_id" );
		
		$app->redirect("index.php?option=com_bank&task=account.accountInfo&id=$acc_id");
		$app->close();
		
		return true;
		
	}

}