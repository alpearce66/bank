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
class BankControllerAccount extends JControllerForm
{

	public function accountInfo()
	{
		dump($this,"BankControllerAccount accountValue in");
		$view = $this->getView('Account','html','BankView');
		dump($this,"BankControllerAccount accountValue 0");
		$view->setLayout ( 'default:edit' );
		dump($this,"BankControllerAccount accountValue 1");
		
		$view->setModel( $this->getModel('Account','BankModel'), true );
		dump($this->getModel('Account',"BankModel"),"ControllerAccount accountValue 2");
		$view->setModel( $this->getModel('Expenses','BankModel'),false);
		dump($this->getModel('Expenses',"BankModel"),"ControllerAccount accountValue 3");
		$view->display();

		dump($this,"BankControllerAccount accountValue out");
	}
	
	
}