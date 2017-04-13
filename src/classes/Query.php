<?php

namespace D3\MLF;

use D3\MLF\Taxonomy;
use D3\MLF\Cookie;
use D3\MLF\Constants;

class Query
{
	public static function init()
	{
		add_action('pre_get_posts', array('D3\MLF\Query', 'runQueryLogic'), 999);
		add_filter('mlf_set_taxonomy_value', array('D3\MLF\Query', 'setTaxonomyValue'), 999, 2);
	}

	public static function runQueryLogic($query)
	{
		if (is_admin()) {
			return $query;
		}

		if (!in_array($query->get('post_type'), Constants::$MLF_FILTERABLE_POST_TYPES)) {
			return $query;
		}

		return self::setTaxQuery($query);
	}

	public static function setTaxQuery($query)
	{
		$taxQuery = self::getMetaTaxQuery();

		if (is_array($query->get('tax_query'))) {
			$taxQuery = array_merge($query->get('tax_query'), $taxQuery);
		}

		$query->set('tax_query', $taxQuery);

		return $query;
	}

	public static function getMetaTaxQuery()
	{
		return array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'agent_channel',
				'field' => 'term_id',
				'terms' => self::getSetMeta('agent_channel'),
				'operator' => 'IN'
			),
			array(
				'taxonomy' => 'appointed_state',
				'field' => 'term_id',
				'terms' => self::getSetMeta('appointed_state'),
				'operator' => 'IN'
			)
		);
	}

	public static function setTaxonomyValue($taxonomy, $args)
	{
		if (empty($taxonomy)) {
			return $args;
		}

		$value = self::getSetMeta($taxonomy);


		if (!isset($value) || empty($value) || !count($value)) {
			return $args;
		}

		$args[$taxonomy] = $value;

		return $args;
	}

	public static function getSetMeta($taxonomy)
	{
		$taxonomyData = new Taxonomy($taxonomy);
		$taxonomyTerms = $taxonomyData->getTerms();

		$cookie = Cookie::getCookie();
		$setData = (count($cookie[$taxonomy]) > 0 ) ? $cookie[$taxonomy] : array(); //self::getTermIds($taxonomyTerms);

		return $setData;
	}

	public static function getTermIds($terms)
	{
		$termIds = array();
		foreach ($terms as $term) {
			$termIds[] = $term->term_id;
		}
		return $termIds;
	}
}

function aaaaaaaaaaaaaadsfasdfas($query)
{
	if ($query->is_category() && $query->is_main_query() && !is_admin()) {
		// Specify what do we want from the terms function -AM
		$args               = array(
			'fields' => 'id=>slug'
		);
		// Call the get_terms function to get all the agent channel and appointed state ids -AM
		$allchannels        = get_terms('agent_channel', $args);
		$allstates          = get_terms('appointed_state', $args);
		// Ids are the keys of te associative array that us returned -AM
		$allchannels        = array_keys($allchannels);
		$allstates          = array_keys($allstates);
		$channel_cookie_arr = unserialize(stripcslashes($_COOKIE["mlah_agent_channel"]));
		$state_cookie_arr   = unserialize(stripcslashes($_COOKIE["mlah_appointed_state"]));
		// Read cookies in order to update checkboxes or set to all
		if ($agent_channel == null) {
			if (isset($_COOKIE["mlah_agent_channel"]) && $channel_cookie_arr != null) {
				$agent_channel = $channel_cookie_arr;
			} else {
				$agent_channel = $allchannels;
			}
		}

		if ($appointed_state == null) {
			if (isset($_COOKIE["mlah_appointed_state"]) && $state_cookie_arr != null) {
				$appointed_state = $state_cookie_arr;
			} else {
				$appointed_state = $allstates;
			}
		}

		$taxquery = array(
			array(
				'taxonomy' => 'agent_channel',
				'field' => 'term_id',
				'terms' => $agent_channel
			),
			array(
				'taxonomy' => 'appointed_state',
				'field' => 'term_id',
				'terms' => $appointed_state
			)
		);

		$query->set('tax_query', $taxquery);
		$query->set('post_type', array(
			'post'
		));
	}

	return $query;
}
