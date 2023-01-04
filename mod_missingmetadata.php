<?php
/**
* @version		$id$
* @package		Joomla
* @copyright	Copyright (C) 2012 NosAdaptamos.com. All rights reserved.
* @license		GNU GPLv3 - http://www.gnu.org/licenses/gpl.html
*/

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Version;

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Include dependancies.
require_once dirname(__FILE__).'/helper.php';
$version = new Joomla\CMS\Version();

$list = modMissingMetaDataHelper::getList($params);
if($version->isCompatible("4.0")){
	$params->set('layout','default4');
}
elseif ($version->isCompatible("3.0")){
	$params->set('layout','default3');
} else {
	$params->set('layout','default');
}
require ModuleHelper::getLayoutPath('mod_missingmetadata', $params->get('layout'));
