<?php

/*
Plugin Name: Metlife Filter
Plugin URI: http://d3applications.com
Description: Filter Plugin For Metlife
Version: 1.0.0
Author: Max Baun
Author URI: http://github.com/maxbaun
License: GPL2
*/

require_once plugin_dir_path(__FILE__) . 'src/classes/Config.php';
require_once plugin_dir_path(__FILE__) . 'src/classes/Helpers.php';
require_once plugin_dir_path(__FILE__) . 'src/classes/Activation.php';
require_once plugin_dir_path(__FILE__) . 'src/classes/JsonManifest.php';
require_once plugin_dir_path(__FILE__) . 'src/classes/Assets.php';
require_once plugin_dir_path(__FILE__) . 'src/classes/ShortcodeFilter.php';
require_once plugin_dir_path(__FILE__) . 'src/classes/Updater.php';
require_once plugin_dir_path(__FILE__) . 'src/classes/Taxonomy.php';
require_once plugin_dir_path(__FILE__) . 'src/classes/Dropdown.php';
require_once plugin_dir_path(__FILE__) . 'src/classes/Ajax.php';
require_once plugin_dir_path(__FILE__) . 'src/classes/Cookie.php';

use D3\MLF;
use D3\MLF\JsonManifest;
use D3\MLF\Config;
use D3\MLF\Assets;
use D3\MLF\Activation;
use D3\MLF\ShortcodeFilter;
use D3\MLF\Cookie;

add_action('init', function () {
	$paths = [
		'dir.plugin' => plugin_dir_path(__FILE__),
		'uri.plugin' => plugins_url(null, __FILE__)
	];

	$manifest = new JsonManifest("{$paths['dir.plugin']}dist/assets.json", "{$paths['uri.plugin']}/dist");
	Config::setManifest($manifest);

	Assets::init($manifest);
	ShortcodeFilter::init();
	Cookie::init();

	define('WP_GITHUB_FORCE_UPDATE', true);

	if (is_admin()) { // note the use of is_admin() to double check that this is happening in the admin
		$config = array(
			'slug' => plugin_basename(__FILE__),
			'proper_folder_name' => 'metlife-filter',
			'api_url' => 'https://api.github.com/repos/maxbaun/metlife-filter',
			'raw_url' => 'https://raw.github.com/maxbaun/metlife-filter/master',
			'github_url' => 'https://github.com/maxbaun/metlife-filter',
			'zip_url' => 'https://github.com/maxbaun/metlife-filter/archive/master.zip',
			'sslverify' => true,
			'requires' => '3.0', //version of wordpress that is required
			'tested' => '3.3', //version of wordpress udated to
			'readme' => 'README.md', //readme file
			'access_token' => '',
		);
		new GithubUpdater($config);
	}
});

register_activation_hook(__FILE__, function () {
	Activation::init();
});
