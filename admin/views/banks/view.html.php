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
class BankViewBanks extends JViewLegacy
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
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		
		
		$myView=$this->getName();
		$myModel=$this->getModel();
		$myLayout=$this->getLayout();
		
		dump($myView,"BankViewBanks display View");
		dump($myModel->getName(),"BankViewBanks display Model");
		dump($myLayout,"BankViewBanks display Layout");
		
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
	}
}