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
 * BankList Model
 *
 * @since  0.0.1
 */
class BankModelExpenses extends JModelList
{

	/**
	 * Items total
	 * @var integer
	 */
	var $_total = null;
	
	/**
	 * Pagination object
	 * @var object
	 */
	var $_pagination = null;
	
	  function __construct()
	  {

	  	dump ( $this, "BankModelExpenses __construct in" );
	  	
	  	parent::__construct();
	 
	 	// Setup application state for list pagination.
	 	$app = JFactory::getApplication();

	 	// Get component name for use in saving state.
	 	$option = JRequest::getVar('option');
	 	 
	 	// Take the list limit size from global config values.
	 	$limit = $app->getUserStateFromRequest(
	 					'global.list.limit',		// Key value 
	 			 		'limit', 					// Request parameter
	 			        $app->getCfg('list_limit'), // Default 
	 			        'int');
	 	
	 	// Take the currently stored list start. This will be different
	 	// for the bank list and expenses list.
	 	$limitstart = $app->getUserStateFromRequest(
	 			"$option.expenses.limitstart", 
	 			limitstart, 
	 			0, 
	 			'int');

	 	// Retrieve the current account ID being processed.
	 	$acc_id = $app->getUserStateFromRequest("$option.expenses.acc_id", 'acc_id', 0, 'int');
	 			
		// In case limit has been changed, adjust it
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
	 
		// Save the state information for future use.
		$app->setUserState("$option.expenses.acc_id", $acc_id);
		$app->setUserState("$option.expenses.limitstart", $limitstart);
		
	  	dump ( $this, "BankModelExpenses __construct out" );
	  
	  }
  
	  function getData()
	  {

	  	dump ( $this, "BankModelExpenses getData in" );
	  	
	  	// Setup application state for list pagination.
	  	$app = JFactory::getApplication();
	  	
	 	// Get component name for use in saving state.
	 	$option = JRequest::getVar('option');
	 	 
	  	// if data hasn't already been obtained, load it
		if (empty($this->_data)) {

			$query = $this->getListQuery();
			$this->_data = $this->_getList($query, 
					$app->getUserState("$option.expenses.limitstart"), 
					$app->getCfg('list_limit'));

			$this->_total = $this->_getListCount($query);
		
		}
		
		dump ( $this, "BankModelExpenses getData out" );
		
		return $this->_data;
		
	  }
	  
	  function deleteExpense()
	  {

	  	dump ( $this, "BankModelExpenses deleteExpense in" );
	  	
	  	// Setup application state for list pagination.
		$app = JFactory::getApplication();
		
	 	// Get component name for use in saving state.
	 	$option = JRequest::getVar('option');
	 	 
	 	$cids = JRequest::getVar('cid', null, 'default', 'array' );
	 	dump ( $cids, "BankControllerExpenses - delete 0" );
	 	 
	 	
	 	$trans_id = $app->getUserState("$option.expenses.trans_id");
	  	$acc_id = $app->getUserState("$option.expenses.acc_id");
	  	
	  	dump ( $trans_id, "BankControllerExpenses - delete 1" );
	  	dump ( $acc_id, "BankControllerExpenses - delete 2" );
	  	
	  	
		// Remove the schema version
// 		$query = $db->getQuery(true)
// 		->delete('#__schemas')
// 		->where('extension_id = ' . $row->extension_id);
// 		$db->setQuery($query);
// 		$db->execute();
		
	  	dump ( $this, "BankModelExpenses deleteExpense out" );
	  	
	  	
	  }
	  
	  function getTotal()
	  {
	  	
	  	dump ( $this, "BankModelExpenses getTotal in" );
	  	
	  	// Load the content if it doesn't already exist
	  	if (empty($this->_total)) {
	  		$query = $this->getListQuery();
	  		$this->_total = $this->_getListCount($query);
	  	}
	  	
	  	dump ( $this, "BankModelExpenses getTotal out" );
	  	
	  	return $this->_total;
	  }
	  
	  
	  function getPagination()
	  {
	  	dump ( $this, "BankModelExpenses getPagination in" );
	  	
	  	// Setup application state for list pagination.
		$app = JFactory::getApplication();
		
	 	// Get component name for use in saving state.
	 	$option = JRequest::getVar('option');
	 	 
		// Load the content if it doesn't already exist
	  	if (empty($this->_pagination)) {
	  		jimport('joomla.html.pagination');

	  		$this->_pagination = new JPagination(
	  				$this->getTotal(), 
	  				$app->getUserState("$option.expenses.limitstart"), 
	  				$app->getCfg('list_limit') );
	  	}
	  	
	  	dump ( $this->_pagination, "BankModelExpenses getPagination out" );
	  	
	  	return $this->_pagination;
	  }
	  
	  /**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return      string  An SQL query
	 */
	protected function getListQuery()
	{
		
	  	dump ( $this->_pagination, "BankModelExpenses getListQuery in" );
	  	
		// Setup application state for list pagination.
		$app = JFactory::getApplication();
		
		// Get component name for use in saving state.
	 	$option = JRequest::getVar('option');
	 	 
		// Initialize variables.
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		// Check for the account ID comming in on the request.
		$acc_id = $app->input->get("acc_id");
		
		// If it wasn't found use the stored state.
		if ($acc_id == null)
		{
			$acc_id = $app->getUserState("$option.expenses.acc_id");
		}
		
		// Create the base select statement.
		$query->select('*')
		        ->where($db->quoteName('acc_id')." = ".$db->quote($acc_id))
                ->from($db->quoteName('#__bank_expense'));
 
	  	dump ( $query, "BankModelExpenses getListQuery out" );
                
	  	return $query;
	}
}