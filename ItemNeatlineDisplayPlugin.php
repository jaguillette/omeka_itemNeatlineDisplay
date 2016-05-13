<?php

class ItemNeatlineDisplayPlugin extends Omeka_Plugin_AbstractPlugin
{
	const ELEMENT_SET_NAME = 'Neatline Display';

	protected $_hooks = array(
		"install",
		"uninstall",
		"public_items_show"
	);

	public function hookInstall()
	{
		// Don't install if an element set by the name "MOL Metadata" already exists.
		if ($this->_db->getTable('ElementSet')->findByName(self::ELEMENT_SET_NAME)) {
			throw new Omeka_Plugin_Installer_Exception(
				__('An element set by the name "%s" already exists. You must delete '
					. 'that element set to install this plugin.', self::ELEMENT_SET_NAME)
			);
		}
		$elementSetMetadata = self::ELEMENT_SET_NAME;
		$elements = array(
			'Neatline Exhibit',
			'Neatline Record'
		);

		insert_element_set($elementSetMetadata, $elements);
	}

	public function hookUninstall()
	{
		// Delete this element set
		if ($this->_db->getTable('ElementSet')->findByName(self::ELEMENT_SET_NAME)) {
			$this->_db->getTable('ElementSet')->findByName(self::ELEMENT_SET_NAME)->delete();
		}
	}

	public function hookPublicItemsShow()
	{
		echo common('item-neatline-display');
	}
}