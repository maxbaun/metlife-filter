<?php

namespace D3\MLF;

use D3\MLF\Taxonomy;
use D3\MLF\Helpers;
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
				'terms' => self::getActiveTerms('agent_channel'),
				'operator' => 'IN'
			),
			array(
				'taxonomy' => 'appointed_state',
				'field' => 'term_id',
				'terms' => self::getActiveTerms('appointed_state'),
				'operator' => 'IN'
			)
		);
	}

	public static function setTaxonomyValue($taxonomy, $args)
	{
		if (empty($taxonomy)) {
			return $args;
		}

		$value = self::getActiveTerms($taxonomy);

		if (!isset($value) || empty($value) || !count($value)) {
			return $args;
		}

		$args[$taxonomy] = array($value);

		return $args;
	}

	public static function getActiveTerms($taxonomy)
	{
		$taxonomyData = new Taxonomy($taxonomy);
		$taxonomyTerms = $taxonomyData->getActiveTerms();
		$savedTerms = $taxonomyData->getSavedTerms();

		$activeTerms = (count($savedTerms) > 0 ) ? $savedTerms : Helpers::getTermIds($taxonomyTerms);

		return $activeTerms;
	}

	public static function getInactiveTerms($taxonomy)
	{
		$taxonomyData = new Taxonomy($taxonomy);
		$taxonomyTerms = $taxonomyData->getInActiveTerms();
		$savedTerms = $taxonomyData->getSavedTerms();

		$inactiveTerms = (count($savedTerms) > 0 ) ? $savedTerms : Helpers::getTermIds($taxonomyTerms);

		return $inactiveTerms;
	}
}
