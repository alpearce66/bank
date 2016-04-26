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
	
	/**
	 * Display the Bank view
	 *
	 * @param string $tpl
	 *        	The name of the template file to parse; automatically searches through the template paths.
	 *        	
	 * @return void
	 */
	public function display($tpl = null) {
		// Get the Data
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
	}
	
	/**
	 * Add the page title and toolbar.
	 *
	 * @return void
	 *
	 * @since 1.6
	 */
	protected function addToolBar() {
		$input = JFactory::getApplication ()->input;
		
		// Hide Joomla Administrator Main menu
		$input->set ( 'hidemainmenu', false );
		
		dump($this,"addToolBar - start");
		
		$isNew = ($this->item->id == 0);
		
		if ($isNew) {
			$title = JText::_ ( 'COM_BANK_EXPENSE_NEW' );
		} else {
			$title = JText::_ ( 'COM_BANK_EXPENSE_EDIT' );
		}
		
		JToolBarHelper::title ( $title, 'expense' );
		JToolBarHelper::save ( 'accentries.expenseList' );
		JToolBarHelper::cancel ( 'accentries.expenseList', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE' );
	}
}