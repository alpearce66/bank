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
class BankModelAccEntries extends JModelList
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
	 	parent::__construct();
	 
	  	$mainframe = JFactory::getApplication();
	 
		// Get pagination request variables
		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = JRequest::getVar('limitstart', 0, '', 'int');
		
		// Should be recieve with the view class.
		$acc_id = $mainframe->getUserStateFromRequest('acc_id', 'acc_id', 0, 'int');
		
		// In case limit has been changed, adjust it
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
	 
		// $this->setState('limit', $limit);
		$this->setState('acc_id', $acc_id);
		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
		
	  }
  
	  function getData()
	  {
	  	// if data hasn't already been obtained, load it
		if (empty($this->_data)) {

			$query = $this->getListQuery();
			dump($this->getState('limitstart'),"getData limitstart");
			dump($this->getState('limit'),"getData limit");
			$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
	  		dump($this,"getData has data...");
			$this->_total = $this->_getListCount($query);
		
		}
		return $this->_data;
	  }
	  
	  function getTotal()
	  {
	  	// Load the content if it doesn't already exist
	  	if (empty($this->_total)) {
	  		$query = $this->getListQuery();
	  		$this->_total = $this->_getListCount($query);
	  	}
	  	return $this->_total;
	  }
	  
	  
	  function getPagination()
	  {
	  	// Load the content if it doesn't already exist
	  	if (empty($this->_pagination)) {
	  		jimport('joomla.html.pagination');
	  		$this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
	  	}
	  	return $this->_pagination;
	  }
	  
	  /**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return      string  An SQL query
	 */
	protected function getListQuery()
	{
		// Initialize variables.
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		$acc_id = JFactory::getApplication()->input->get('acc_id');
		
		if ($acc_id == null)
		{
			$acc_id = $this->getState('acc_id');
		}
		
		// Create the base select statement.
		$query->select('*')
		        ->where($db->quoteName('acc_id')." = ".$db->quote($acc_id))
                ->from($db->quoteName('#__bank_expense'));
 
		return $query;
	}
}