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
class BankViewAccounts extends JViewLegacy
{
	/**
	 * Display the Accounts view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	function display($tpl = null)
	{
		dump ( $this, "BankViewAccounts display in" );
		
		// Get data from the model
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		
		
		$myView=$this->getName();
		$myModel=$this->getModel();
		$myLayout=$this->getLayout();
		
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
		
		dump ( $this, "BankViewAccounts display out" );
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
		dump ( $this, "BankViewAccounts addToolBar in" );
		
		JToolBarHelper::title(JText::_('COM_BANK_MANAGER_ACCOUNTS'));
		JToolBarHelper::addNew('account.add');
		JToolBarHelper::editList('account.edit');
		JToolBarHelper::deleteList('', 'accounts.delete');
		
		dump ( $this, "BankViewAccounts addToolBar out" );
	}
}