<?php

namespace D3\MLF;

class ShortcodeFilter
{
	public static function init()
	{
		add_shortcode('mlf_filter', array('D3\MLF\ShortcodeFilter', 'render'));
	}

	public static function render($args, $content = "")
	{
		ob_start();
		include_once(plugin_dir_path(dirname(__FILE__)) . 'templates/shortcode-filter.php');
		$output = ob_get_clean();
		ob_end_flush();
		return force_balance_tags($output);
	}
}
