<?php
/**
* @version		$id$
* @package		Joomla
* @copyright	Copyright (C) 2012 NosAdaptamos.com. All rights reserved.
* @license		GNU GPLv3 - http://www.gnu.org/licenses/gpl.html
*/

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<?php echo HTMLHelper::_('bootstrap.startTabSet', 'myTab', array('active' => 'arti_details')); ?>
	<?php echo HTMLHelper::_('bootstrap.addTab', 'myTab', 'arti_details', Text::_('COM_MODULES_ARTICLES_FIELDSET_LABEL')); ?>
		<?php if (count($list['articles'])) : ?>
			<table class="table">
				<thead>
					<tr>
						<th><?php echo Text::_('MOD_MISSINGMETADATA_STATE'); ?></th>
						<th><?php echo Text::_('MOD_MISSINGMETADATA_LATEST_ITEMS'); ?></th>
						<th><?php echo Text::_('MOD_MISSINGMETADATA_CREATED_BY'); ?></th>
						<th><?php echo Text::_('MOD_MISSINGMETADATA_CREATED'); ?></th>
						<th><?php echo Text::_('MOD_MISSINGMETADATA_METAS'); ?></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($list['articles'] as $i=>$item) : ?>
					<tr>
						<td>
							<?php echo HTMLHelper::_('jgrid.published', $item->state, $i, '', false); ?>
							<?php if ($item->checked_out) : ?>
								<?php echo HTMLHelper::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time); ?>
							<?php endif; ?>
						</td>
						<td>
							<?php if ($item->link) :?>
								<a href="<?php echo $item->link; ?>">
									<?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8');?>
								</a>
							<?php else : ?>
								<?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?>
							<?php endif; ?>
						</td>
						<td>
							<small class="small" class="hasTooltip" title="<?php echo Text::_('MOD_LATEST_CREATED_BY');?>">
								<?php echo $item->author_name;?>
							</small>
						</td>
						<td>
							<span class="small"><?php echo HTMLHelper::_('date', $item->created, 'Y-m-d'); ?></span>
						</td>
						<td nowrap>
							<?php 
							if (!empty($item->metadesc)) {
								echo '<a class="btn btn-success btn-sm" title="'.Text::_('MOD_MISSINGMETADATA_METADESC').': '.Text::_("JYes").'"><i class="fas fa-check-circle"></i></a>';
							} else {
								echo '<a class="btn btn-danger btn-sm" title="'.Text::_('MOD_MISSINGMETADATA_METADESC').': '.Text::_("JNo") .'"><i class="fas fa-times-circle"></i></a>';
							}
							?>
							<?php
							if (!empty($item->metakey)) {
								echo '<a class="btn btn-success btn-sm" title="'.Text::_('MOD_MISSINGMETADATA_METAKEYS').': '.Text::_("JYes").'"><i class="fas fa-check-circle"></i></a>';
							} else {
								echo '<a class="btn btn-danger btn-sm" title="'.Text::_('MOD_MISSINGMETADATA_METAKEYS').': '.Text::_("JNo") .'"><i class="fas fa-times-circle"></i></a>';
							}
							?>
							<?php
							$attribs = json_decode($item->attribs);
							if (!empty($attribs->article_page_title)) {
								echo '<a class="btn btn-success btn-sm" title="'.Text::_('MOD_MISSINGMETADATA_TITLE').': '.Text::_("JYes").'"><i class="fas fa-check-circle"></i></a>';
							} else {
								echo '<a class="btn btn-danger btn-sm" title="'.Text::_('MOD_MISSINGMETADATA_TITLE').': '.Text::_("JNo") .'"><i class="fas fa-times-circle"></i></a>';
							}
							?>
						</td>						
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		<?php else : ?>
			<p><?php echo Text::_('MOD_MISSINGMETADATA_NO_MATCHING_RESULTS');?></p>
		<?php endif; ?>
	<?php echo HTMLHelper::_('bootstrap.endTab'); ?>

	<?php echo HTMLHelper::_('bootstrap.addTab', 'myTab', 'cate_details', Text::_('COM_MODULES_CATEGORIES_FIELDSET_LABEL')); ?>
		<?php if (count($list['categories'])) : ?>
			<table class="table">
				<thead>
					<tr>
						<th><?php echo Text::_('MOD_MISSINGMETADATA_STATE'); ?></th>
						<th><?php echo Text::_('MOD_MISSINGMETADATA_LATEST_ITEMS'); ?></th>
						<th><?php echo Text::_('MOD_MISSINGMETADATA_CREATED_BY'); ?></th>
						<th><?php echo Text::_('MOD_MISSINGMETADATA_CREATED'); ?></th>
						<th><?php echo Text::_('MOD_MISSINGMETADATA_METAS'); ?></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($list['categories'] as $i=>$item) : ?>
				<tr>
					<td>
						<?php echo HTMLHelper::_('jgrid.published', $item->state, $i, '', false); ?>
						<?php if ($item->checked_out) : ?>
							<?php echo HTMLHelper::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time); ?>
						<?php endif; ?>
					</td>
					<td>
						<?php if ($item->link) :?>
							<a href="<?php echo $item->link; ?>">
								<?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8');?>
							</a>
						<?php else : ?>
							<?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?>
						<?php endif; ?>
					</td>
					<td>
						<small class="small" class="hasTooltip" title="<?php echo Text::_('MOD_LATEST_CREATED_BY');?>">
							<?php echo $item->author_name;?>
						</small>
					</td>
					<td>
						<span class="small"><?php echo HTMLHelper::_('date', $item->created, 'Y-m-d'); ?></span>
					</td>
					<td nowrap>
						<?php 
						if (!empty($item->metadesc)) {
							echo '<a class="btn btn-success btn-sm" title="'.Text::_('MOD_MISSINGMETADATA_METADESC').': '.Text::_("JYes").'"><i class="fas fa-check-circle"></i></a>';
						} else {
							echo '<a class="btn btn-danger btn-sm" title="'.Text::_('MOD_MISSINGMETADATA_METADESC').': '.Text::_("JNo") .'"><i class="fas fa-times-circle"></i></a>';
						}
						?>
						<?php
						if (!empty($item->metakey)) {
							echo '<a class="btn btn-success btn-sm" title="'.Text::_('MOD_MISSINGMETADATA_METAKEYS').': '.Text::_("JYes").'"><i class="fas fa-check-circle"></i></a>';
						} else {
							echo '<a class="btn btn-danger btn-sm" title="'.Text::_('MOD_MISSINGMETADATA_METAKEYS').': '.Text::_("JNo") .'"><i class="fas fa-times-circle"></i></a>';
						}
						?>
					</td>						
				</tr>
				<?php endforeach; ?>
			</tbody>
			</table>
		<?php else : ?>
			<p><?php echo Text::_('MOD_MISSINGMETADATA_NO_MATCHING_RESULTS');?></p>
		<?php endif; ?>
	<?php echo HTMLHelper::_('bootstrap.endTab'); ?>

	<?php echo HTMLHelper::_('bootstrap.addTab', 'myTab', 'menus_details', Text::_('COM_MODULES_MENUS_FIELDSET_LABEL')); ?>
		<?php if (count($list['menus'])) : ?>
			<table class="table">
				<thead>
					<tr>
						<th><?php echo Text::_('MOD_MISSINGMETADATA_LATEST_ITEMS'); ?></th>
						<th><?php echo Text::_('MOD_MISSINGMETADATA_METADESC'); ?></th>
						<th><?php echo Text::_('MOD_MISSINGMETADATA_MENUTITLE'); ?></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($list['menus'] as $i=>$item) : ?>
				<tr>
					<td>
						<?php 
						if ($item->checked_out) {
							echo HTMLHelper::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time);
						}
						
						if ($item->link) {
							echo '<a href="'.$item->link.'">' . htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8') . '</a>';
						} else {
							echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8');
						}

						if ($item->menutype ) {
							echo '<br><small class="badge text-bg-secondary">'.htmlspecialchars($item->menutype, ENT_QUOTES, 'UTF-8').'</small>';
						}
						?>
					</td>
					<td class="text-center">
						<?php
						if (!empty($item->metadesc)) {
							echo '<a class="btn btn-success btn-sm" title="'.Text::_('MOD_MISSINGMETADATA_METADESC').': '.Text::_("JYes").'"><i class="fas fa-check-circle"></i></a>';
						} else {
							echo '<a class="btn btn-danger btn-sm" title="'.Text::_('MOD_MISSINGMETADATA_METADESC').': '.Text::_("JNo") .'"><i class="fas fa-times-circle"></i></a>';
						}
						?>
					</td>
					<td class="text-center">
						<?php
						$params = json_decode($item->params);
						if (!empty($params->page_title)) {
							echo '<a class="btn btn-success btn-sm" title="'.Text::_('MOD_MISSINGMETADATA_MENUTITLE').': '.Text::_("JYes").'"><i class="fas fa-check-circle"></i></a>';
						} else {
							echo '<a class="btn btn-danger btn-sm" title="'.Text::_('MOD_MISSINGMETADATA_MENUTITLE').': '.Text::_("JNo") .'"><i class="fas fa-times-circle"></i></a>';
						}
						?>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
			</table>
		<?php else : ?>
			<p><?php echo Text::_('MOD_MISSINGMETADATA_NO_MATCHING_RESULTS');?></p>
		<?php endif; ?>
	<?php echo HTMLHelper::_('bootstrap.endTab'); ?>

<?php echo HTMLHelper::_('bootstrap.endTabSet'); ?>