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
 * Bank Controller
 *
 * @package     Joomla.Administrator
 * @subpackage  com_bank
 * @since       0.0.9
 */
class BankControllerExpense extends JControllerForm
{
	
	public function expenseForm()
	{
	
		dump($this,"In expenseForm");
	
		$view = $this->getView('Expense','html','BankView');
		dump($this,"In expenseForm1");
		$view->setModel( parent::getModel('Expense', 'BankModel', array('ignore_request' => true)), true );
		dump($this,"In expenseForm2");
		$view->setLayout('default:expense');
		dump($this,"In expenseForm3");
		$view->display();
		dump($this,"In expenseForm4");
}
	
	
}