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
 * Bank View
 *
 * @since 0.0.1
 */
class BankViewExpense extends JViewLegacy {
	/**
	 * View form
	 *
	 * @var form
	 */
	protected $form = null;
	
	protected $item;
	
	/**
	 * Display the Bank view
	 *
	 * @param string $tpl
	 *        	The name of the template file to parse; automatically searches through the template paths.
	 *        	
	 * @return void
	 */
	public function display($tpl = null) {
		
		dump($this,"BankViewExpense - display in");
		
		// Get the Data
		$this->item = $this->get ( 'Item' );
		$this->form = $this->get ( 'Form' );
		
		// Check for errors.
		if (count ( $errors = $this->get ( 'Errors' ) )) {
			JError::raiseError ( 500, implode ( '<br />', $errors ) );
			
			return false;
		}
		
		// Set the toolbar
		$this->addToolBar ();
		
		// Display the template
		parent::display ( $tpl );

		dump($this,"BankViewExpense - display out");
		
	}
	
	/**
	 * Add the page title and toolbar.
	 *
	 * @return void
	 *
	 * @since 1.6
	 */
	protected function addToolBar() {

		dump($this,"BankViewExpense - addToolBar in");
		
		$input = JFactory::getApplication ()->input;
		
		// Hide Joomla Administrator Main menu
		$input->set ( 'hidemainmenu', false );
		
		
		$app = JFactory::getApplication();
		
		// Load state from the request.
		$pk = $app->input->getInt('grid.id');
		
		$isNew = ($this->item->trans_id == 0);
		
		if ($isNew) {
			$title = JText::_ ( 'COM_BANK_EXPENSE_NEW' );
		} else {
			$title = JText::_ ( 'COM_BANK_EXPENSE_EDIT' );
		}
		
		JToolBarHelper::title ( $title, 'expense' );
		JToolBarHelper::save ( 'expense.save' );
		JToolBarHelper::cancel ( 'expenses.expenseList', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE' );

		dump($this,"BankViewExpense - addToolBar out");
		
	}
}