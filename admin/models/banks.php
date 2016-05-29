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
class BankModelBanks extends JModelList
{
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
 
		// Create the base select statement.
		$query->select('*')
				->order('user_id')
                ->from($db->quoteName('#__bank_acc'));
 
		return $query;
	}
	
}