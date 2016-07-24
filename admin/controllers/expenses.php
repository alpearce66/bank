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
 * Banks Controller
 *
 * @since  0.0.1
 */
class BankControllerExpenses extends JControllerAdmin
{
	/**
	 * Proxy for getModel.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  object  The model.
	 *
	 * @since   1.6
	 */
	
	public function getModel($name = 'Expenses', $prefix = 'BankModel', $config = array('ignore_request' => true))
	{
		dump ( $this, "BankControllerExpenses getModel in" );
		$model = parent::getModel($name, $prefix, $config);
		dump ( $model, "BankControllerExpenses getModel out" );
		
		return $model;
	}
	
	
	public function expenseList()
	{

		dump ( $this, "BankControllerExpenses expenseList in" );
		
// 		$view = $this->getView('Expenses','html','BankView');
// 		$view->setModel( $this->getModel(), true );
// 		$view->display();	

		
		
// 		$bankModel = $this->getInstance('Account', 'BankModel', array ('ignore_request' => true));
// 		dump ( $bankModel, "BankControllerExpenses expenseList bank model" );
// 		$view = $this->getView('Account','html','BankView');
// 		dump ( $view, "BankControllerExpenses expenseList view" );
// 		$view->setModel( $bankModel, true );
		

		
		
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
		
		
		
		
		dump ( $this, "BankControllerExpenses expenseList out" );
		
	}
	
	public function delete() {
		
		dump ( $this, "BankControllerExpenses - delete in" );
	
		$model = $this->getModel();
		
		$model->deleteExpense();
		$this->expenseList();
		
		dump ( $this, "BankControllerExpenses - delete out" );
	
	}
	
		
}