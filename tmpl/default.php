<?php
/**
* @version		$id$
* @package		Joomla
* @copyright	Copyright (C) 2012 NosAdaptamos.com. All rights reserved.
* @license		GNU GPLv3 - http://www.gnu.org/licenses/gpl.html
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

echo JHtml::_('tabs.start', 'module-missingmetadata-assignment-tabs', array('useCookie'=>1));
echo JHtml::_('tabs.panel', JText::_('COM_MODULES_ARTICLES_FIELDSET_LABEL'), 'arti-details');
?>
<table class="adminlist">
	<thead>
		<tr>
			<th><?php echo JText::_('MOD_MISSINGMETADATA_LATEST_ITEMS'); ?></th>
			<th><strong><?php echo JText::_('JSTATUS'); ?></strong></th>
			<th><strong><?php echo JText::_('MOD_MISSINGMETADATA_CREATED'); ?></strong></th>
			<th><strong><?php echo JText::_('MOD_MISSINGMETADATA_METADESC'); ?></strong></th>
			<th><strong><?php echo JText::_('MOD_MISSINGMETADATA_METAKEYS'); ?></strong></th>			
		</tr>
	</thead>
<?php if (count($list['articles'])) : ?>
	<tbody>
	<?php foreach ($list['articles'] as $i=>$item) : ?>
		<tr>
			<td scope="row">
				<?php 
				if ($item->checked_out) {
					echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time); 
				}
				
				if ($item->link) {
					echo '<a href="'.$item->link.'">' . htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8') . '</a>';
				} else {
					echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8');
				}
				?>
			</td>
			<td class="center"><?php echo JHtml::_('jgrid.published', $item->state, $i, '', false); ?></td>
			<td class="center"><?php echo JHtml::_('date', $item->created, 'Y-m-d H:i:s'); ?></td>
			<td class="center">
				<?php 
				if (empty($item->metadesc)) {
					echo JText::_("MOD_MISSINGMETADATA_RESULT_YES");
				} else {
					echo JText::_("MOD_MISSINGMETADATA_RESULT_NO");
				}
				?>
			</td>
			<td class="center">
				<?php 
				if (empty($item->metakey)) {
					echo JText::_("MOD_MISSINGMETADATA_RESULT_YES");
				} else {
					echo JText::_("MOD_MISSINGMETADATA_RESULT_NO");
				}
				?>
			</td>			
		</tr>	
	<?php endforeach; ?>
	</tbody>	
<?php else : ?>
	<tbody>
		<tr>
			<td colspan="4">
				<p class="noresults"><?php echo JText::_('MOD_MISSINGMETADATA_NO_MATCHING_RESULTS');?></p>
			</td>
		</tr>
	</tbody>
<?php endif; ?>
</table>


<?php echo JHtml::_('tabs.panel', JText::_('COM_MODULES_CATEGORIES_FIELDSET_LABEL'), 'cate_details');?>
<table class="adminlist">
	<thead>
		<tr>
			<th><?php echo JText::_('MOD_MISSINGMETADATA_LATEST_ITEMS'); ?></th>
			<th><strong><?php echo JText::_('JSTATUS'); ?></strong></th>
			<th><strong><?php echo JText::_('MOD_MISSINGMETADATA_CREATED'); ?></strong></th>
			<th><strong><?php echo JText::_('MOD_MISSINGMETADATA_METADESC'); ?></strong></th>
			<th><strong><?php echo JText::_('MOD_MISSINGMETADATA_METAKEYS'); ?></strong></th>			
		</tr>
	</thead>
<?php if (count($list['categories'])) : ?>
	<tbody>
	<?php foreach ($list['categories'] as $i=>$item) : ?>
		<tr>
			<td scope="row">
				<?php 
				if ($item->checked_out) {
					echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time); 
				}
				
				if ($item->link) {
					echo '<a href="'.$item->link.'">' . htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8') . '</a>';
				} else {
					echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8');
				} ?>
			</td>
			<td class="center"><?php echo JHtml::_('jgrid.published', $item->published, $i, '', false); ?></td>
			<td class="center"><?php echo JHtml::_('date', $item->created, 'Y-m-d H:i:s'); ?></td>
			<td class="center">
				<?php 
				if (empty($item->metadesc)) {
					echo JText::_("MOD_MISSINGMETADATA_RESULT_YES");
				} else {
					echo JText::_("MOD_MISSINGMETADATA_RESULT_NO");
				}
				?>
			</td>
			<td class="center">
				<?php 
				if (empty($item->metakey)) {
					echo JText::_("MOD_MISSINGMETADATA_RESULT_YES");
				} else {
					echo JText::_("MOD_MISSINGMETADATA_RESULT_NO");
				}
				?>
			</td>			
		</tr>	
	<?php endforeach; ?>
	</tbody>	
<?php else : ?>
	<tbody>
		<tr>
			<td colspan="4">
				<p class="noresults"><?php echo JText::_('MOD_MISSINGMETADATA_NO_MATCHING_RESULTS');?></p>
			</td>
		</tr>
	</tbody>
<?php endif; ?>	
</table>

<?php echo JHtml::_('tabs.panel', JText::_('COM_MODULES_MENUS_FIELDSET_LABEL'), 'menus_details');?>
<table class="adminlist">
	<thead>
		<tr>
			<th><?php echo JText::_('MOD_MISSINGMETADATA_LATEST_ITEMS'); ?></th>
			<th><strong><?php echo JText::_('JSTATUS'); ?></strong></th>
			<th><strong><?php echo JText::_('MOD_MISSINGMETADATA_METADESC'); ?></strong></th>
			<th><strong><?php echo JText::_('MOD_MISSINGMETADATA_METAKEYS'); ?></strong></th>			
		</tr>
	</thead>
<?php if (count($list['menus'])) : ?>
	<tbody>
	<?php foreach ($list['menus'] as $i=>$item) : ?>
		<tr>
			<td scope="row">
				<?php 
				if ($item->checked_out) {
					echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time); 
				}
				
				if ($item->menutype ) {
					echo htmlspecialchars($item->menutype, ENT_QUOTES, 'UTF-8')." > ";
				} 
				if ($item->link) {
					echo '<a href="'.$item->link.'">' . htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8') . '</a>';
				} else {
					echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8');
				}?>
			</td>
			<td class="center"><?php echo JHtml::_('jgrid.published', $item->published, $i, '', false); ?></td>
			<td class="center">
				<?php 
				if (empty($item->metadesc)) {
					echo JText::_("MOD_MISSINGMETADATA_RESULT_YES");
				} else {
					echo JText::_("MOD_MISSINGMETADATA_RESULT_NO");
				}
				?>
			</td>
			<td class="center">
				<?php 
				if (empty($item->metakey)) {
					echo JText::_("MOD_MISSINGMETADATA_RESULT_YES");
				} else {
					echo JText::_("MOD_MISSINGMETADATA_RESULT_NO");
				}
				?>
			</td>			
		</tr>	
	<?php endforeach; ?>
	</tbody>	
<?php else : ?>
	<tbody>
		<tr>
			<td colspan="4">
				<p class="noresults"><?php echo JText::_('MOD_MISSINGMETADATA_NO_MATCHING_RESULTS');?></p>
			</td>
		</tr>
	</tbody>
<?php endif; ?>	
</table>
<?php echo JHtml::_('tabs.end');?>