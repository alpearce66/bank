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
		// Get data from the model
		dump($this,"1");
		dump($this->getLayout(),"BankViewExpenses.display Layout");
		dump($layout,"BankViewExpenses.display layout");
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
		JToolBarHelper::title(JText::_('COM_BANK_MANAGER_BANKS'));
		JToolBarHelper::addNew('bank.add');
		JToolBarHelper::editList('bank.edit');
		JToolBarHelper::deleteList('', 'banks.delete');
		JToolBarHelper::back('bank.banks');
	}
}