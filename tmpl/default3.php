<?php
/**
* @version		$id$
* @package		Joomla
* @copyright	Copyright (C) 2012 NosAdaptamos.com. All rights reserved.
* @license		GNU GPLv3 - http://www.gnu.org/licenses/gpl.html
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

JHtml::_('bootstrap.tooltip');
?>
<ul class="nav nav-tabs">
	<li class="active"><a href="#arti_details" data-toggle="tab"><?php echo JText::_('COM_MODULES_ARTICLES_FIELDSET_LABEL'); ?></a></li>
	<li class=""><a href="#cate_details" data-toggle="tab"><?php echo JText::_('COM_MODULES_CATEGORIES_FIELDSET_LABEL'); ?></a></li>
	<li class=""><a href="#menus_details" data-toggle="tab"><?php echo JText::_('COM_MODULES_MENUS_FIELDSET_LABEL'); ?></a></li>
</ul>
	
<div class="tab-content">
	<div class="tab-pane active" id="arti_details">
		<div class="row-striped">
			<?php if (count($list['articles'])) : ?>
				<?php foreach ($list['articles'] as $i=>$item) : ?>
					<div class="row-fluid">
						<div class="span7">
							<?php echo JHtml::_('jgrid.published', $item->state, $i, '', false); ?>
							<?php if ($item->checked_out) : ?>
								<?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time); ?>
							<?php endif; ?>
							<?php if ($item->link) :?>
								<a href="<?php echo $item->link; ?>">
									<?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8');?>
								</a>
							<?php else : ?>
								<?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?>
							<?php endif; ?>
							<br/>
							<small class="small" class="hasTooltip" title="<?php echo JText::_('MOD_LATEST_CREATED_BY');?>">
								<?php echo $item->author_name;?>
							</small>
						</div>
						
						<div class="span3">
							<span class="small"><i class="icon-calendar"></i> <?php echo JHtml::_('date', $item->created, 'Y-m-d'); ?></span>
						</div>
						<div class="span2">
							<?php 
							if (empty($item->metadesc)) {
								echo '<a class="btn btn-micro disabled" title="'.JText::_('MOD_MISSINGMETADATA_METADESC').':: '.JText::_("MOD_MISSINGMETADATA_RESULT_YES").'" rel="tooltip"><i class="icon-publish"></i></a>';
							} else {
								echo '<a class="btn btn-micro disabled" title="'.JText::_('MOD_MISSINGMETADATA_METADESC').':: '.JText::_("MOD_MISSINGMETADATA_RESULT_NO") .'" rel="tooltip"><i class="icon-unpublish"></i></a>';
							}
							if (empty($item->metakey)) {
								echo '<a class="btn btn-micro disabled" title="'.JText::_('MOD_MISSINGMETADATA_METAKEYS').':: '.JText::_("MOD_MISSINGMETADATA_RESULT_YES").'" rel="tooltip"><i class="icon-publish"></i></a>';
							} else {
								echo '<a class="btn btn-micro disabled" title="'.JText::_('MOD_MISSINGMETADATA_METAKEYS').':: '.JText::_("MOD_MISSINGMETADATA_RESULT_NO") .'" rel="tooltip"><i class="icon-unpublish"></i></a>';
							}
							?>
							<?php
							$attribs = json_decode($item->attribs);
							if (!empty($attribs->article_page_title)) {
								echo '<a class="btn btn-micro disabled" title="'.JText::_('MOD_MISSINGMETADATA_TITLE').': '.JText::_("JYes").'" rel="tooltip"><i class="icon-publish"></i></a>';
							} else {
								echo '<a class="btn btn-micro disabled" title="'.JText::_('MOD_MISSINGMETADATA_TITLE').': '.JText::_("JNo") .'" rel="tooltip"><i class="icon-unpublish"></i></a>';
							}
							?>
						</div>						
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<div class="row-fluid">
					<div class="span12"><?php echo JText::_('MOD_MISSINGMETADATA_NO_MATCHING_RESULTS');?></div>
				</div>
			<?php endif; ?>
		</div>
	</div>
	
        
    <div class="tab-pane" id="cate_details">
		<div class="row-striped">
			<?php if (count($list['categories'])) : ?>
				<?php foreach ($list['categories'] as $i=>$item) : ?>
					<div class="row-fluid">
						<div class="span7">
							<?php echo JHtml::_('jgrid.published', $item->state, $i, '', false); ?>
							<?php if ($item->checked_out) : ?>
								<?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time); ?>
							<?php endif; ?>
							<?php if ($item->link) :?>
								<a href="<?php echo $item->link; ?>">
									<?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8');?>
								</a>
							<?php else : ?>
								<?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?>
							<?php endif; ?>
							<br/>
							<small class="small" class="hasTooltip" title="<?php echo JText::_('MOD_LATEST_CREATED_BY');?>">
								<?php echo $item->author_name;?>
							</small>
						</div>
						
						<div class="span3">
							<span class="small"><i class="icon-calendar"></i> <?php echo JHtml::_('date', $item->created, 'Y-m-d'); ?></span>
						</div>
						<div class="span2">
							<?php 
							if (empty($item->metadesc)) {
								echo '<a class="btn btn-micro disabled" title="'.JText::_('MOD_MISSINGMETADATA_METADESC').':: '.JText::_("MOD_MISSINGMETADATA_RESULT_YES").'" rel="tooltip"><i class="icon-publish"></i></a>';
							} else {
								echo '<a class="btn btn-micro disabled" title="'.JText::_('MOD_MISSINGMETADATA_METADESC').':: '.JText::_("MOD_MISSINGMETADATA_RESULT_NO") .'" rel="tooltip"><i class="icon-unpublish"></i></a>';
							}
							if (empty($item->metakey)) {
								echo '<a class="btn btn-micro disabled" title="'.JText::_('MOD_MISSINGMETADATA_METAKEYS').':: '.JText::_("MOD_MISSINGMETADATA_RESULT_YES").'" rel="tooltip"><i class="icon-publish"></i></a>';
							} else {
								echo '<a class="btn btn-micro disabled" title="'.JText::_('MOD_MISSINGMETADATA_METAKEYS').':: '.JText::_("MOD_MISSINGMETADATA_RESULT_NO") .'" rel="tooltip"><i class="icon-unpublish"></i></a>';
							}
							?>
						</div>						
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<div class="row-fluid">
					<div class="span12"><?php echo JText::_('MOD_MISSINGMETADATA_NO_MATCHING_RESULTS');?></div>
				</div>
			<?php endif; ?>
		</div>
	</div>
	
	<div class="tab-pane" id="menus_details">
		<div class="row-striped">
			<?php if (count($list['menus'])) : ?>
				<?php foreach ($list['menus'] as $i=>$item) : ?>
					<div class="row-fluid">
						<div class="span7">
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
						</div>
						
						<div class="span3">
							<span class="small"><i class="icon-calendar"></i> <?php echo JHtml::_('date', $item->published, 'Y-m-d'); ?></span>
						</div>
						<div class="span2">
							<?php 
							if (empty($item->metadesc)) {
								echo '<a class="btn btn-micro disabled" title="'.JText::_('MOD_MISSINGMETADATA_METADESC').':: '.JText::_("MOD_MISSINGMETADATA_RESULT_YES").'" rel="tooltip"><i class="icon-publish"></i></a>';
							} else {
								echo '<a class="btn btn-micro disabled" title="'.JText::_('MOD_MISSINGMETADATA_METADESC').':: '.JText::_("MOD_MISSINGMETADATA_RESULT_NO") .'" rel="tooltip"><i class="icon-unpublish"></i></a>';
							}
							if (empty($item->metakey)) {
								echo '<a class="btn btn-micro disabled" title="'.JText::_('MOD_MISSINGMETADATA_METAKEYS').':: '.JText::_("MOD_MISSINGMETADATA_RESULT_YES").'" rel="tooltip"><i class="icon-publish"></i></a>';
							} else {
								echo '<a class="btn btn-micro disabled" title="'.JText::_('MOD_MISSINGMETADATA_METAKEYS').':: '.JText::_("MOD_MISSINGMETADATA_RESULT_NO") .'" rel="tooltip"><i class="icon-unpublish"></i></a>';
							}
							?>
							<?php
							$params = json_decode($item->params);
							if (!empty($params->page_title)) {
								echo '<a class="btn btn-micro disabled" title="'.JText::_('MOD_MISSINGMETADATA_MENUTITLE').': '.Text::_("JYes").'"><i class="icon-publish"></i></a>';
							} else {
								echo '<a class="btn btn-micro disabled title="'.JText::_('MOD_MISSINGMETADATA_MENUTITLE').': '.Text::_("JNo") .'"><i class="icon-unpublish"></i></a>';
							}
							?>
						</div>						
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<div class="row-fluid">
					<div class="span12"><?php echo JText::_('MOD_MISSINGMETADATA_NO_MATCHING_RESULTS');?></div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>