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
 * Bank Controller
 *
 * @package Joomla.Administrator
 * @subpackage com_bank
 * @since 0.0.9
 */
class BankControllerExpense extends JControllerForm {
	
	public function expenseForm() {

		dump ( $this, "BankControllerExpense - expenseForm in" );
		
		$view = $this->getView ( 'Expense', 'html', 'BankView' );
		$view->setModel ( parent::getModel ( 'Expense', 'BankModel', array (
				'ignore_request' => true 
		) ), true );
		$view->setLayout ( 'default:expense' );
		$view->display ();
		
		dump ( $this, "BankControllerExpense - expenseForm out" );
		
	}
}