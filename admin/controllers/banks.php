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
class BankControllerBanks extends JControllerAdmin
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
	public function getModel($name = 'Bank', $prefix = 'BankModel', $config = array('ignore_request' => true))
	{
		dump($this,"BankControllerBanks getModel in");
		$model = parent::getModel($name, $prefix, $config);
		dump($model,"BankControllerBanks getModel out");
		
		return $model;
	}
	
	public function accountList()
	{
		dump($this,"BankControllerBanks accountList in");
		$view = $this->getView('Banks','html','BankView');
		$view->setModel( $this->getModel('Banks','BankModel'), true );
		$view->display();
		dump($this,"BankControllerBanks accountList out");
	}
}