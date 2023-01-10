<?php
/**
* @version		$id$
* @package		Joomla
* @copyright	Copyright (C) 2012 NosAdaptamos.com. All rights reserved.
* @license		GNU GPLv3 - http://www.gnu.org/licenses/gpl.html
*/

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\Registry\Registry;

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class modMissingMetaDataHelper
{
	public static function getList($params, $compatibility_j4)
	{
		// Initialise variables
		$items	= array();
		$items['articles'] = modMissingMetaDataHelper::getList_Articles($params);
		$items['categories'] = modMissingMetaDataHelper::getList_Categories($params);
		$items['menus'] = ($compatibility_j4) ? modMissingMetaDataHelper::getList_Menus_J4($params) : modMissingMetaDataHelper::getList_Menus($params);
		return $items;
	}
	
	/**
	 * Get a list of articles.
	 *
	 * @param	JObject		The module parameters.
	 *
	 * @return	mixed		An array of articles, or false on error.
	 */
	public static function getList_Articles($params)
	{
		// Initialise variables
		$user 	= Factory::getuser();
		$db		= Factory::getDbo();
		$query	= $db->getQuery(true);
		$items 	= array();
		$mCount = $params->get('arti_count', 5);
		
		$query->select( 'a.id, a.title, a.checked_out, a.checked_out_time, a.access,'
					. ' a.created, a.created_by, a.created_by_alias, a.featured, a.state,'
					. ' a.metakey, a.metadesc' 
					);
		$query->from('#__content AS a');
		
		// Join over the users for the checked out user.
		$query->select('uc.name AS editor');
		$query->join('LEFT', '#__users AS uc ON uc.id=a.checked_out');
		
		// Join over the users for the author.
		$query->select('ua.name AS author_name');
		$query->join('LEFT', '#__users AS ua ON ua.id = a.created_by');
		
		$query->where('((a.metakey = "") OR (a.metakey IS NULL)) OR ((a.metadesc = "") OR (a.metadesc IS NULL))');
		
		// Set Ordering filter
		switch ($params->get('arti_ordering')) {
			case 'm_dsc':
				$query->order('modified DESC, created DESC');
				break;

			case 'c_dsc':
			default:
				$query->order('created DESC');
				break;
		}
		
		if ($mCount>0) {
			$db->setQuery($query, 0, $mCount);
		} else {
			$db->setQuery($query);
		}
		
		try
		{
			$items = $db->loadObjectList();
		}
		catch (Exception $e){
			echo $e->getMessage();
			throw new \Exception($e->getMessage(), 500);
		}

		// Set the links
		foreach ($items as &$item) {
			if ($user->authorise('core.edit', 'com_content.article.'.$item->id)){
				$item->link = Route::_('index.php?option=com_content&task=article.edit&id='.$item->id);
			} else {
				$item->link = '';
			}
		}		
		return $items;
	}
	
	/**
	 * Get a list of categories.
	 *
	 * @param	JObject		The module parameters.
	 *
	 * @return	mixed		An array of articles, or false on error.
	 */
	public static function getList_Categories($params)
	{
		// Initialise variables
		$user 	= Factory::getuser();
		$db		= Factory::getDbo();
		$query	= $db->getQuery(true);
		$items 	= array();
		$mCount = $params->get('cate_count', 5);
		
		$query->select( 'c.id, c.title, c.checked_out, c.checked_out_time, c.access,'
					. ' c.created_time as created, c.created_user_id as created_by, c.published,'
					. ' c.metakey, c.metadesc, c.extension' 
					);
		$query->from('#__categories AS c');
		
		// Join over the users for the checked out user.
		$query->select('uc.name AS editor');
		$query->join('LEFT', '#__users AS uc ON uc.id=c.checked_out');
		
		// Join over the users for the author.
		$query->select('ua.name AS author_name');
		$query->join('LEFT', '#__users AS ua ON ua.id = c.created_user_id');
		// $query->where('c.published = 1');
		$query->where('c.extension = ' . $db->quote("com_content"));
		$query->where('(((c.metakey = "") OR (c.metakey IS NULL)) OR ((c.metadesc = "") OR (c.metadesc IS NULL)))');

		// Set Ordering filter
		switch ($params->get('cate_ordering')) {
			case 'm_dsc':
				$query->order('modified_time DESC, created_time DESC');
				break;

			case 'c_dsc':
			default:
				$query->order('created_time DESC');
				break;
		}
		
		if ($mCount>0) {
			$db->setQuery($query, 0, $mCount);
		} else {
			$db->setQuery($query);
		}
		
		try
		{
			$items = $db->loadObjectList();
		}
		catch (Exception $e){
			echo $e->getMessage();
			throw new \Exception($e->getMessage(), 500);
		}

		// Set the links
		foreach ($items as &$item) {
			if ($user->authorise('core.edit', $item->extension.'.category.'.$item->id)){
				$item->link = Route::_('index.php?option=com_categories&task=category.edit&id='.$item->id.'&extension='.$item->extension);
			} else {
				$item->link = '';
			}
		}		
		return $items;
	}
	
	/**
	 * Get a list of categories.
	 *
	 * @param	JObject		The module parameters.
	 *
	 * @return	mixed		An array of articles, or false on error.
	 */
	public static function getList_Menus($params)
	{
		// Initialise variables
		$user 	= Factory::getuser();
		$db		= Factory::getDbo();
		$query	= $db->getQuery(true);
		$items 	= array();
		$items_return = array();
		$mCount = $params->get('menu_count', 5);
		
		$query->select( 'm.id, m.title, m.menutype, m.type, m.checked_out, m.checked_out_time, m.access,'
					. ' m.published, m.params' 
					);
		$query->from('#__menu AS m');
		
		// Join over the users for the checked out user.
		$query->select('uc.name AS editor');
		$query->join('LEFT', '#__users AS uc ON uc.id=m.checked_out');
		
		$query->where('m.client_id = 0');
		$query->where('m.type = ' . $db->quote("component") );
		
		$db->setQuery($query);
		
		try
		{
			$items = $db->loadObjectList();
		}
		catch (Exception $e){
			echo $e->getMessage();
			throw new \Exception($e->getMessage(), 500);
		}

		// Set the links
		foreach ($items as &$item) {
			if ($item->type == 'component') {
				// 	Convert the params field to an array.
				$registry = new Registry();
				$registry->loadString($item->params);
				$params = $registry->toArray();
				// echo var_dump($params)."<hr/>";
				if (isset($params['menu-meta_description']) && isset($params['menu-meta_keywords'])) {
					// Candidato a comprobar
					if (empty($params['menu-meta_description']) || empty($params['menu-meta_keywords'])) {
						if ($user->authorise('core.edit', 'com_menus')){
							$item->link = Route::_('index.php?option=com_menus&task=item.edit&id='.(int) $item->id);
						} else {
							$item->link = '';
						}
						$item->metadesc = $params['menu-meta_description'];
						$item->metakey = $params['menu-meta_keywords'];
						$items_return[] = $item;
					}
				}
			}
			
			if ($mCount>0) {
				if (count($items_return)>=$mCount) {
					break;
				}
			}
		}
		
		return $items_return;
	}

	public static function getList_Menus_J4($params)
	{
		// Initialise variables
		$user 	= Factory::getuser();
		$db		= Factory::getDbo();
		$query	= $db->getQuery(true);
		$items 	= array();
		$items_return = array();
		$mCount = $params->get('menu_count', 5);
		
		$query->select( 'm.id, m.title, m.menutype, m.type, m.checked_out, m.checked_out_time, m.access,'
					. ' m.published, m.params' 
					);
		$query->from('#__menu AS m');
		
		// Join over the users for the checked out user.
		$query->select('uc.name AS editor');
		$query->join('LEFT', '#__users AS uc ON uc.id=m.checked_out');
		
		$query->where('m.client_id = 0');
		$query->where('m.type = ' . $db->quote("component") );
		
		$db->setQuery($query);
		
		try
		{
			$items = $db->loadObjectList();
		}
		catch (Exception $e){
			echo $e->getMessage();
			throw new \Exception($e->getMessage(), 500);
		}

		// Set the links
		foreach ($items as &$item) {
			if ($item->type == 'component') {
				// 	Convert the params field to an array.
				$registry = new Registry();
				$registry->loadString($item->params);
				$params = $registry->toArray();
				// echo var_dump($params)."<hr/>";
				if (isset($params['menu-meta_description'])) {
					// Candidato a comprobar
					if (empty($params['menu-meta_description'])) {
						if ($user->authorise('core.edit', 'com_menus')){
							$item->link = Route::_('index.php?option=com_menus&task=item.edit&id='.(int) $item->id);
						} else {
							$item->link = '';
						}
						$item->metadesc = $params['menu-meta_description'];
						$item->metakey = $params['menu-meta_keywords'];
						$items_return[] = $item;
					}
				}
			}
			
			if ($mCount>0) {
				if (count($items_return)>=$mCount) {
					break;
				}
			}
		}
		
		return $items_return;
	}	
}