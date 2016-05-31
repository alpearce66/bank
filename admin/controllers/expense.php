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
		
		$model = parent::getModel ( 'Expense', 'BankModel', array ('ignore_request' => true) );		
		$view = $this->getView ( 'Expense', 'html', 'BankView' );
		$view->setModel ( $model, true );
		$view->setLayout ( 'default:expense' );
		
		$account = parent::getModel ( 'Account', 'BankModel', array ('ignore_request' => true) );		
		$account->_name = 'model_account';
		$view->setModel( $account );		
		
		$view->display ();
		
		dump ( $this, "BankControllerExpense - expenseForm out" );
		
	}
}