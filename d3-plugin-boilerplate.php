<?php

/*
Plugin Name: D3 Applications Plugin Boilerplate
Plugin URI: http://d3applications.com
Description: Plugin Description
Version: 1.1.1
Author: Max Baun
Author URI: http://github.com/maxbaun
License: GPL2
*/

require_once plugin_dir_path(__FILE__) . 'src/classes/Config.php';
require_once plugin_dir_path(__FILE__) . 'src/classes/Helpers.php';
require_once plugin_dir_path(__FILE__) . 'src/classes/Activation.php';
require_once plugin_dir_path(__FILE__) . 'src/classes/JsonManifest.php';
require_once plugin_dir_path(__FILE__) . 'src/classes/Assets.php';
require_once plugin_dir_path(__FILE__) . 'src/classes/ShortcodeExample.php';
require_once plugin_dir_path(__FILE__) . 'src/classes/Updater.php';

use D3\Plugin;
use D3\Plugin\JsonManifest;
use D3\Plugin\Config;
use D3\Plugin\Assets;
use D3\Plugin\Activation;
use D3\Plugin\ShortcodeExample;

add_action('init', function () {
	$paths = [
		'dir.plugin' => plugin_dir_path(__FILE__),
		'uri.plugin' => plugins_url(null, __FILE__)
	];

	$manifest = new JsonManifest("{$paths['dir.plugin']}dist/assets.json", "{$paths['uri.plugin']}/dist");
	Config::setManifest($manifest);

	Assets::init($manifest);
	ShortcodeExample::init();

	define('WP_GITHUB_FORCE_UPDATE', true);

	if (is_admin()) { // note the use of is_admin() to double check that this is happening in the admin
		$config = array(
			'slug' => plugin_basename(__FILE__),
			'proper_folder_name' => 'd3-plugin-boilerplate',
			'api_url' => 'https://api.github.com/repos/maxbaun/wordpress-plugin-boilerplate',
			'raw_url' => 'https://raw.github.com/maxbaun/wordpress-plugin-boilerplate/master',
			'github_url' => 'https://github.com/maxbaun/wordpress-plugin-boilerplate',
			'zip_url' => 'https://github.com/maxbaun/wordpress-plugin-boilerplate/archive/master.zip',
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
