<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_bank
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
/**
 * Bank Component Controller
 *
 * @since  0.0.1
 */
class BankController extends JControllerLegacy
{

	protected $default_view = 'balls';

	public function display($cachable = true, $urlparams = false)
	{	
		dump($this,"In Controller");
		dump($cachable,"In Controller");
		dump($urlparams,"In Controller");
		return parent::display($cachable, $urlparams);
	}
	
}