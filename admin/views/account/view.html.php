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
 * Bank View
 *
 * @since  0.0.1
 */
class BankViewAccount extends JViewLegacy
{
	/**
	 * View form
	 *
	 * @var         form
	 */
	protected $form = null;
 
	/**
	 * Display the Bank view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	public function display($tpl = null)
	{
		dump($expensesModel,"BankViewAccount display in");
		
		// Determine the account id being used.
		$app = JFactory::getApplication ();
		$option = JRequest::getVar('option');
		$acc_id = $app->getUserStateFromRequest ( "$option.accounts.acc_id", 'id',0);
		dump($acc_id,"BankViewAccount display 0");
		
		$accountModel = $this->getModel("Account");
		dump($accountModel,"BankViewAccount display 1");
				
		// Get the Data
		$this->form = $accountModel->getForm();
		$this->item = $accountModel->getItem($acc_id);
		dump($this,"BankViewAccount display 4");
		dump($this->getModel("Expenses"),"BankViewAccount display 4a");
		
		$this->pagination	= $this->get(Pagination);
		dump($acc_id,"BankViewAccount display 4a");
		$this->items		= $this->get(Data);
		dump($this,"BankViewAccount display 5");
		
		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			dump($this,"BankViewAccount display 6");
				
			return false;
		}
 
 
		// Set the toolbar
		dump($this,"BankViewAccount display 7");
		$this->addToolBar();
		dump($this,"BankViewAccount display 8");
		
		dump($this, 'Account Testing');
		dump($tpl, 'Account Testing');
		
		// Display the template
		parent::display($tpl);

		dump($expensesModel,"BankViewAccount display out");
		
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
		dump($this,"BankViewAccount addToolBar in");
		
		$input = JFactory::getApplication()->input;
 
		// Hide Joomla Administrator Main menu
		// $input->set('hidemainmenu', true);
		$input->set('hidemainmenu', false);
		
		$isNew = ($this->item->id == 0);
 
		if ($isNew)
		{
			$title = JText::_('COM_BANK_MANAGER_ACCOUNT_NEW');
		}
		else
		{
			$title = JText::_('COM_BANK_MANAGER_ACCOUNT_EDIT');
		}
 
		JToolBarHelper::title($title, 'account');
		JToolBarHelper::custom('account.validate','refresh.png','refresh_f2.png','Value',false);
		JToolBarHelper::save('account.save');
		JToolBarHelper::cancel(
			'account.cancel',
			$isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'
		);
		
		
		JToolBarHelper::addNew('expense.expenseForm');
		JToolBarHelper::editList('expense.expenseForm');
		JToolBarHelper::deleteList('','expenses.delete');
		
		
		
		
		dump($this,"BankViewAccount addToolBar out");
	
	}
}