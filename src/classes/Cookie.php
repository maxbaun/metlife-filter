<?php

namespace D3\MLF;

class Cookie
{
	public static function init()
	{
		add_action('wp_ajax_mlf_set_cookie', array('D3\\MLF\\Cookie', 'setCookieCallback'));
		add_action('wp_ajax_nopriv_mlf_set_cookie', array('D3\\MLF\\Cookie', 'setCookieCallback'));
		add_action('wp_ajax_mlf_get_cookie', array('D3\\MLF\\Cookie', 'getCookieCallback'));
		add_action('wp_ajax_nopriv_mlf_get_cookie', array('D3\\MLF\\Cookie', 'getCookieCallback'));
	}

	public static function setCookieCallback()
	{
		$agentChannel = (isset($_POST['agent_channel'])) ? $_POST['agent_channel'] : array();
		$appointedState = (isset($_POST['appointed_state'])) ? $_POST['appointed_state'] : array();

		Ajax::success('', self::setCookie(array(
			'agent_channel' => $agentChannel,
			'appointed_state' => $appointedState
		)));
	}

	public static function setCookie($args)
	{
		$agentChannel = (isset($args['agent_channel'])) ? $args['agent_channel'] : array();
		$appointedState = (isset($args['appointed_state'])) ? $args['appointed_state'] : array();

		$agentChannelJson   = serialize($agentChannel);
		$appointedStateJson = serialize($appointedState);

		setcookie('mlf_agent_channel', $agentChannelJson, time() + 3600 * 24 * 100, COOKIEPATH, COOKIE_DOMAIN, false);
		setcookie('mlf_appointed_state', $appointedStateJson, time() + 3600 * 24 * 100, COOKIEPATH, COOKIE_DOMAIN, false);

		return $args;
	}

	public static function getCookieCallback()
	{
		Ajax::success('', self::getCookie());
	}

	public static function getCookie()
	{
		$agentChannel = (isset($_COOKIE['mlf_agent_channel'])) ? unserialize(stripcslashes($_COOKIE['mlf_agent_channel'])) : false;
		$appointedState = (isset($_COOKIE['mlf_appointed_state'])) ? unserialize(stripcslashes($_COOKIE['mlf_appointed_state'])) : false;

		$agentChannel = ($agentChannel) ? $agentChannel : array();
		$appointedState = ($appointedState) ? $appointedState : array();

		return array(
			'agent_channel' => $agentChannel,
			'appointed_state' => $appointedState
		);
	}
}
