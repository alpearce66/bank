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
<form action="index.php?option=com_bank&view=banks" method="post" id="adminForm" name="adminForm">
	<table class="table table-striped table-hover">
		<thead>
		<tr>
			<th width="1%"><?php echo JText::_('COM_BANK_NUM'); ?></th>
			<th width="2%">
				<?php echo JHtml::_('grid.checkall'); ?>
			</th>
			<th width="45%">
				<?php echo JText::_('COM_BANK_BANKS_ACC_NAME') ;?>
			</th>
			<th width="35%">
				<?php echo JText::_('COM_BANK_BALANCE'); ?>
			</th>
			<th width="5%">
				<?php echo JText::_('COM_BANK_USER'); ?>
			</th>
			<th width="5%">
				<?php echo JText::_('COM_BANK_ENTRIES'); ?>
			</th>
			<th width="7%">
				<?php echo JText::_('COM_BANK_PUBLISHED'); ?>
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
					$link = JRoute::_('index.php?option=com_bank&task=bank.edit&id=' . $row->id);
					$entries = JRoute::_('index.php?option=com_bank&task=accEntries.expenseList&view=accEntries&acc_id='.$row->id);
				?>
					<tr>
						<td><?php echo $this->pagination->getRowOffset($i); ?></td>
						<td>
							<?php echo JHtml::_('grid.id', $i, $row->id); ?>
						</td>
						<td>
							<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_BANK_EDIT_BANK_ACC'); ?>">
								<?php echo $row->description; ?>
							</a>
						</td>
						<td>
							<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_BANK_EDIT_BANK_ACC'); ?>">
								<?php echo $row->balance; ?>
							</a>
						</td>
						<td>
							<?php $theUser = JFactory::getUser($row->user_id); ?>
							<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_BANK_EDIT_BANK_ACC'); ?>">
								<?php echo $theUser->name; ?>
							</a>
						</td>
						<td>
							<a href="<?php echo $entries; ?>" title="<?php echo JText::_('COM_BANK_EDIT_BANK_ACC'); ?>">
								<?php echo "ENTRIES"; ?>
							</a>
						</td>
						<td align="center">
							<?php echo JHtml::_('jgrid.published', $row->published, $i, 'banks.', true, 'cb'); ?>
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