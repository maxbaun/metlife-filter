<?php

namespace D3\MLF;

class Helpers
{
	public static function getTermIds($terms)
	{
		$termIds = array();
		foreach ($terms as $term) {
			$termIds[] = $term->term_id;
		}
		return $termIds;
	}
}
