<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_bank
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<form action="index.php?option=com_bank&view=accentries" method="post" id="adminForm" name="adminForm">
	Hello !
	<input type="hidden" name="view" value="accentries" />
	<?php echo JHtml::_('form.token'); ?>
</form>