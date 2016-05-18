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
 
// Get an instance of the controller prefixed by Bank
$controller = JControllerLegacy::getInstance('Bank');
 
// Perform the Request task
$controller->execute(JFactory::getApplication()->input->get('task'));

dump(JFactory::getApplication()->input->get('task'), 'Top level redirection');
 
// Redirect if set by the controller
$controller->redirect();