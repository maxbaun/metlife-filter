<?php

namespace D3\MLF;

use D3\MLF\Cookie;
use D3\MLF\Helpers;
use D3\MLF\AdminSettings;

class Taxonomy
{
	private $terms = array();
	private $tax = '';
	private $activeTerms = array();
	private $inactiveTerms = array();

	public function __construct($tax)
	{
		$this->tax = $tax;
		$this->terms = get_terms($tax);

		$this->setActiveTerms($tax);
		$this->setInActiveTerms($tax);
	}

	public function getSavedTerms()
	{
		$cookie = Cookie::getCookie();
		return $cookie[$this->tax];
	}

	public function getTerms()
	{
		return $this->terms;
	}

	public function getTermById($id)
	{
		$term = null;

		foreach ($this->terms as &$t) {
			if ($t->term_id == $id) {
				$term = $t;
			}
		}

		return $term;
	}

	private function setActiveTerms($taxSlug)
	{
		$tax = 'metlife_filter_active_' . $taxSlug;
		$active = AdminSettings::getOption($tax);

		$termIds = Helpers::getTermIds($this->terms);

		foreach ($termIds as $term) {
			if (in_array($term, $active)) {
				$this->activeTerms[] = $this->getTermById($term);
			}
		}

		if (count($this->activeTerms) == 0) {
			$this->activeTerms = $this->terms;
		}
	}

	public function getActiveTerms()
	{
		return $this->activeTerms;
	}

	public function setInActiveTerms($selected)
	{
		$tax = 'metlife_filter_active_' . $this->tax;
		$active = AdminSettings::getOption($tax);

		$termIds = Helpers::getTermIds($this->terms);

		foreach ($termIds as $term) {
			if (!in_array($term, $active)) {
				$this->inactiveTerms[] = $this->getTermById($term);
			}
		}
	}

	public function getInActiveTerms()
	{
		return $this->inactiveTerms;
	}
}
