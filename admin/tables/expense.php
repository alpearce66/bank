<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_bank
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die('Restricted access');
 
/**
 * Hello Table class
 *
 * @since  0.0.1
 */

class ExpenseTableExpense extends JTable
{
	/**
	 * Constructor
	 *
	 * @param   JDatabaseDriver  &$db  A database connector object
	 */
	function __construct(&$db)
	{
		dump($this,"ExpenseTableExpense - __construct in");
		parent::__construct('#__bank_expense', 'trans_id', $db);
		dump($this,"ExpenseTableExpense - __construct out");
	}
}