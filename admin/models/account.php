<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_bank
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
/**
 * Account Model
 *
 * @since  0.0.1
 */
class BankModelAccount extends JModelAdmin
{
	/**
	 * Method to get a table object, load it if necessary.
	 *
	 * @param   string  $type    The table name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  JTable  A JTable object
	 *
	 * @since   1.6
	 */
	public function getTable($type = 'Account', $prefix = 'BankTable', $config = array())
	{
		dump ( $this, "BankModelAccount getTable in" );
		$table = JTable::getInstance($type, $prefix, $config);
		dump ( $table, "BankModelAccount getTable out" );
		return $table;
	}
 
	/**
	 * Method to get the record form.
	 *
	 * @param   array    $data      Data for the form.
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
	 *
	 * @return  mixed    A JForm object on success, false on failure
	 *
	 * @since   1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		dump ( $this, "BankModelAccount getForm in" );

		$app = JFactory::getApplication ();
		$option = JRequest::getVar('option');

		// Get the form.
		$form = $this->loadForm(
			"$option.account.edit.form",
			'account',
			array(
				'control' => 'jform',
				'load_data' => $loadData
			)
		);
 
		if (empty($form))
		{
			return false;
		}
 
		
		dump ( $this, "BankModelAccount getForm out" );
		return $form;
	}
 
	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return  mixed  The data for the form.
	 *
	 * @since   1.6
	 */
	protected function loadFormData()
	{
		dump ( $this, "BankModelAccount loadFormData in" );

		$app = JFactory::getApplication ();
		$option = JRequest::getVar('option');

		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState(
			"$option.account.edit.form", array()
		);
 
		if (empty($data))
		{

			$acc_id = $app->getUserStateFromRequest ( "$option.accounts.acc_id", 'id',0);
			$data = $this->getItem($acc_id);
			$app->setUserState("$option.accounts.acc_id", $acc_id);
				
		}
 
		dump ( $data, "BankModelAccount loadFormData out" );
		return $data;
	}
	
	protected function validateAccountValue($account)
	{
		
		dump ( $account, "BankModelAccount - validateAccountValue in" );
		
		$expenseModel = $this->getInstance('Expenses', 'BankModel', array ('ignore_request' => true));
		$totalValue=$expenseModel->validateAccountValue($account);
		
		dump ( $totalValue, "BankModelAccount - validateAccountValue out" );
		
		return $totalValue;
								
	}
	
	function setAccountValue($account,$value)
	{
		
		dump ( gettype($value), "BankModelAccount - setAccountValue in" );
		
		if (is_double($value)) {
			
			$entry = new stdClass();
			$entry->id = $account;
			$entry->balance=$value;
				
			// Insert the object into the user profile table.
			$result = JFactory::getDbo()->updateObject('#__bank_acc', $entry, 'id');
				
		}
		
		dump ( $result, "BankModelAccount - setAccountValue out" );
		
	}
	
	function getAccountValue($account)
	{

		dump ( $this, "BankModelAccount - getAccountValue in" );
		
		// Initialize variables.
		$balance=null;
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		if (is_int($account)) {
			$query->select($db->quoteName(array('balance')));
			$query->from($db->quoteName('#__bank_acc'));
			$query->where($db->quoteName('id') . ' = '. $account);
			$db->setQuery($query);
			$balance = $db->loadResult();
				
		}

		dump ( $balance, "BankModelAccount - getAccountValue out" );
		
		return $balance;
		
	}
	
}