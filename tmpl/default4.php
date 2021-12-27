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

\Joomla\CMS\HTML\HTMLHelper::_('bootstrap.tooltip', '.tooltip', []);
?>
<?php echo HTMLHelper::_('bootstrap.startTabSet', 'myTab', array('active' => 'arti_details')); ?>
	<?php echo HTMLHelper::_('bootstrap.addTab', 'myTab', 'arti_details', Text::_('COM_MODULES_ARTICLES_FIELDSET_LABEL')); ?>
		<?php if (count($list['articles'])) : ?>
			<table class="table">
				<thead>
					<tr>
						<th>Estado</th>
						<th>Título</th>
						<th>Autor</th>
						<th>Fecha</th>
						<th colspan="2">Metas</th>
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
						<td>
							<?php 
							if (empty($item->metadesc)) {
								echo '<a class="disabled tooltip" title="'.Text::_('MOD_MISSINGMETADATA_METADESC').':: '.Text::_("MOD_MISSINGMETADATA_RESULT_YES").'" rel="tooltip"><i class="icon-publish"></i></a>';
							} else {
								echo '<a class="disabled tooltip" title="'.Text::_('MOD_MISSINGMETADATA_METADESC').':: '.Text::_("MOD_MISSINGMETADATA_RESULT_NO") .'" rel="tooltip"><i class="icon-unpublish"></i></a>';
							}
							?>
						</td>
						<td>
							<?php
							if (empty($item->metakey)) {
								echo '<a class="disabled tooltip" title="'.Text::_('MOD_MISSINGMETADATA_METAKEYS').':: '.Text::_("MOD_MISSINGMETADATA_RESULT_YES").'" rel="tooltip"><i class="icon-publish"></i></a>';
							} else {
								echo '<a class="disabled tooltip" title="'.Text::_('MOD_MISSINGMETADATA_METAKEYS').':: '.Text::_("MOD_MISSINGMETADATA_RESULT_NO") .'" rel="tooltip"><i class="icon-unpublish"></i></a>';
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
						<th>Estado</th>
						<th>Título</th>
						<th>Autor</th>
						<th>Fecha</th>
						<th colspan="2">Metas</th>
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
					<td>
						<?php 
						if (empty($item->metadesc)) {
							echo '<a class="disabled tooltip" title="'.Text::_('MOD_MISSINGMETADATA_METADESC').':: '.Text::_("MOD_MISSINGMETADATA_RESULT_YES").'" rel="tooltip"><i class="icon-publish"></i></a>';
						} else {
							echo '<a class="disabled tooltip" title="'.Text::_('MOD_MISSINGMETADATA_METADESC').':: '.Text::_("MOD_MISSINGMETADATA_RESULT_NO") .'" rel="tooltip"><i class="icon-unpublish"></i></a>';
						}
						?>
					</td>
					<td>
						<?php
						if (empty($item->metakey)) {
							echo '<a class="disabled tooltip" title="'.Text::_('MOD_MISSINGMETADATA_METAKEYS').':: '.Text::_("MOD_MISSINGMETADATA_RESULT_YES").'" rel="tooltip"><i class="icon-publish"></i></a>';
						} else {
							echo '<a class="disabled tooltip" title="'.Text::_('MOD_MISSINGMETADATA_METAKEYS').':: '.Text::_("MOD_MISSINGMETADATA_RESULT_NO") .'" rel="tooltip"><i class="icon-unpublish"></i></a>';
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
						<th>Título</th>
						<th>Fecha</th>
						<th colspan="2">Metas</th>
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
						
						if ($item->menutype ) {
							echo htmlspecialchars($item->menutype, ENT_QUOTES, 'UTF-8')." > ";
						} 
						
						if ($item->link) {
							echo '<a href="'.$item->link.'">' . htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8') . '</a>';
						} else {
							echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8');
						}?>
					</td>
					<td>
						<span class="small"><?php echo HTMLHelper::_('date', $item->published, 'Y-m-d'); ?></span>
					</td>
					<td>
						<?php 
						if (empty($item->metadesc)) {
							echo '<a class="disabled tooltip" title="'.Text::_('MOD_MISSINGMETADATA_METADESC').':: '.Text::_("MOD_MISSINGMETADATA_RESULT_YES").'" rel="tooltip"><i class="icon-publish"></i></a>';
						} else {
							echo '<a class="disabled tooltip" title="'.Text::_('MOD_MISSINGMETADATA_METADESC').':: '.Text::_("MOD_MISSINGMETADATA_RESULT_NO") .'" rel="tooltip"><i class="icon-unpublish"></i></a>';
						}
						?>
					</td>
					<td>
						<?php
						if (empty($item->metakey)) {
							echo '<a class="disabled tooltip" title="'.Text::_('MOD_MISSINGMETADATA_METAKEYS').':: '.Text::_("MOD_MISSINGMETADATA_RESULT_YES").'" rel="tooltip"><i class="icon-publish"></i></a>';
						} else {
							echo '<a class="disabled tooltip" title="'.Text::_('MOD_MISSINGMETADATA_METAKEYS').':: '.Text::_("MOD_MISSINGMETADATA_RESULT_NO") .'" rel="tooltip"><i class="icon-unpublish"></i></a>';
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