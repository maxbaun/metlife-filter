<?php

namespace D3\MLF;

use D3\MLF\Cookie;

class Taxonomy
{
	private $terms = array();

	public function __construct($tax)
	{
		$this->tax = $tax;
		$this->setTerms($tax);
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

	private function setTerms($tax)
	{
		$this->terms = get_terms($tax);
	}
}
