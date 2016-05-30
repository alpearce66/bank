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
 * Banks View
 *
 * @since  0.0.1
 */
class BankViewExpenses extends JViewLegacy
{
	 
	/**
	 * Display the Bank view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	function display($tpl = null)
	{
		dump($this,"BankViewExpenses - display in");

		// Get data from the model
		$this->pagination	= $this->get('Pagination');
		$this->items		= $this->get('Data');
				
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
 
			return false;
		}
 
		// Set the toolbar
		$this->addToolBar();
		
		// Display the template
		parent::display($tpl);

		dump($this,"BankViewExpenses - display out");

	}
 
	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function addToolBar()
	{
		dump($this,"BankViewExpenses - addToolBar out");

		JToolBarHelper::title(JText::_('COM_BANK_MANAGE_ACCOUNT'));
		JToolBarHelper::addNew('expense.expenseForm');
		JToolBarHelper::editList('expense.expenseForm');
		JToolBarHelper::deleteList('', 'expenses.delete');
		JToolBarHelper::custom('banks.accountList','refresh.png','refresh_f2.png','Accounts',false);
		
		dump($this,"BankViewExpenses - addToolBar out");

	}
}