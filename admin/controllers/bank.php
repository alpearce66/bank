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
class BankControllerBank extends JControllerForm
{

	public function accountValue()
	{
		dump($this,"BankControllerBank accountValue in");
		$view = $this->getView('Bank','html','BankView');
		$view->setLayout ( 'default:edit' );
		
		$view->setModel( $this->getModel('Bank','BankModel'), true );
		$view->setModel( $this->getModel('Expenses','BankModel'),false);
		$view->display();

		dump($this,"BankControllerBank accountValue out");
	}
	
	
}