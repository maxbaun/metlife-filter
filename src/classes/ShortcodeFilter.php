<?php

namespace D3\MLF;

use D3\MLF\AdminSettings;

class ShortcodeFilter
{
	public static function init()
	{
		add_shortcode('mlf_filter', array('D3\MLF\ShortcodeFilter', 'render'));
	}

	public static function render($args, $content = "")
	{
		$advancedSearchText = AdminSettings::getOption('metlife_filter_advanced_search_text');
		$advancedSearchPageId = AdminSettings::getOption('metlife_filter_advanced_search_page');
		$advancedSearchPage = get_permalink($advancedSearchPageId);

		ob_start();
		include_once(plugin_dir_path(dirname(__FILE__)) . 'templates/shortcode-filter.php');
		$output = ob_get_clean();
		ob_end_flush();
		return force_balance_tags($output);
	}
}
