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
		$model = parent::getModel($name, $prefix, $config);
		
		return $model;
	}
	
	
	public function expenseList()
	{

		dump ( $this, "BankControllerExpenses - expenseList in" );
		
		$view = $this->getView('Expenses','html','BankView');
		$view->setModel( $this->getModel(), true );
		$view->display();	

		dump ( $this, "BankControllerExpenses - expenseList out" );
		
	}
	
	public function delete() {
		
		dump ( $this, "BankControllerExpenses - delete in" );
	
		$view = $this->getView ( 'Expenses', 'html', 'BankView' );
		$view->setModel ( parent::getModel ( 'Expenses', 'BankModel', array (
				'ignore_request' => true
		) ), true );
		$view->display ();
		
		dump ( $this, "BankControllerExpenses - delete out" );
	
	}
	
		
}