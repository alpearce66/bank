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
class BankViewBank extends JViewLegacy
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

		// Determine the account id being used.
		$app = JFactory::getApplication ();
		$option = JRequest::getVar('option');
		$acc_id = $app->getUserStateFromRequest ( "$option.banks.acc_id", 'id',0);
		
		// Update the balance if expenses model is visible
		if (!is_null($this->getModel("Expenses"))) {
			$balance=$this->getModel("Expenses")->validateAccountValue($acc_id);
			$this->getModel()->setAccountValue($acc_id,$balance);
		}
		
		// Get the Data
		$this->form = $this->get('Form');
		$this->item = $this->getModel()->getItem($acc_id);
		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
 
			return false;
		}
 
 
		// Set the toolbar
		$this->addToolBar();
 
		dump($this, 'Bank Testing');
		dump($tpl, 'Bank Testing');
		
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
		$input = JFactory::getApplication()->input;
 
		// Hide Joomla Administrator Main menu
		// $input->set('hidemainmenu', true);
		$input->set('hidemainmenu', false);
		
		$isNew = ($this->item->id == 0);
 
		if ($isNew)
		{
			$title = JText::_('COM_BANK_MANAGER_BANK_NEW');
		}
		else
		{
			$title = JText::_('COM_BANK_MANAGER_BANK_EDIT');
		}
 
		JToolBarHelper::title($title, 'bank');
		JToolBarHelper::custom('bank.accountValue','refresh.png','refresh_f2.png','Value',false);
		JToolBarHelper::save('bank.save');
		JToolBarHelper::cancel(
			'bank.cancel',
			$isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'
		);
		
	}
}