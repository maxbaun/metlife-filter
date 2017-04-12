<?php

namespace D3\MLF;

class Taxonomy
{
	private $terms = array();

	public function __construct($tax)
	{
		$this->setTerms($tax);
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
