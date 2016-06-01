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
<form action="index.php?option=com_bank&view=accounts" method="post" id="adminForm" name="adminForm">
	<table class="table table-striped table-hover">
		<thead>
		<tr>
			<th width="1%"><?php echo JText::_('COM_BANK_NUM'); ?></th>
			<th width="2%">
				<?php echo JHtml::_('grid.checkall'); ?>
			</th>
			<th width="45%">
				<?php echo JText::_('COM_BANK_ACCOUNT_NAME') ;?>
			</th>
			<th width="10%">
				<?php echo JText::_('COM_BANK_BALANCE'); ?>
			</th>
			<th width="25%">
				<?php echo JText::_('COM_BANK_USER'); ?>
			</th>
			<th width="17%">
				<?php echo JText::_('COM_BANK_ENTRIES'); ?>
			</th>
		</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="5">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?php if (!empty($this->items)) : ?>
				<?php foreach ($this->items as $i => $row) :
					$link = JRoute::_('index.php?option=com_bank&task=account.accountInfo&id=' . $row->id);
					$entries = JRoute::_('index.php?option=com_bank&task=expenses.expenseList&view=expenses&acc_id='.$row->id);
				?>
					<tr>
						<td><?php echo $this->pagination->getRowOffset($i); ?></td>
						<td>
							<?php echo JHtml::_('grid.id', $i, $row->id); ?>
						</td>
						<td>
							<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_BANK_EDIT_ACCOUNT'); ?>">
								<?php echo $row->description; ?>
							</a>
						</td>
						<td>
							<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_BANK_EDIT_ACCOUNT'); ?>">
								<?php echo $row->balance; ?>
							</a>
						</td>
						<td>
							<?php $theUser = JFactory::getUser($row->user_id); ?>
							<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_BANK_EDIT_ACCOUNT'); ?>">
								<?php echo $theUser->name; ?>
							</a>
						</td>
						<td>
							<a href="<?php echo $entries; ?>" title="<?php echo JText::_('COM_BANK_EDIT_ACCOUNT'); ?>">
								<?php echo "Expense list"; ?>
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<?php echo JHtml::_('form.token'); ?>
</form>