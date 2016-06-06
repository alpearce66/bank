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
		dump($this,"BankControllerAccount accountInfo in");
		$view = $this->getView('Account','html','BankView');
		dump($this,"BankControllerAccount accountInfo 0");
		$view->setLayout ( 'default:edit' );
		dump($this,"BankControllerAccount accountInfo 1");
		
		$view->setModel( $this->getModel('Account','BankModel'), false );
		dump($this->getModel('Account',"BankModel"),"ControllerAccount accountInfo 2");
		$view->setModel( $this->getModel('Expenses','BankModel'),true);
		dump($this->getModel('Expenses',"BankModel"),"ControllerAccount accountInfo 3");
		$view->display();

		dump($this,"BankControllerAccount accountInfo out");
	}
	
	
}