<?php

namespace D3\MLF;

class AdminMenu
{
	public static function init()
	{
		add_action('admin_menu', array('D3\MLF\AdminMenu', 'adminMenus'));
	}

	public static function adminMenus()
	{
		$topMenuItem = 'metlife_filter_admin_menu';

		add_menu_page(
			'',
			'Metlife Filter',
			'manage_options',
			$topMenuItem,
			array('D3\MLF\AdminSettings', 'renderPage'),
			'dashicons-admin-generic'
		);
	}
}
