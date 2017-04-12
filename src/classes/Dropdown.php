<?php

namespace D3\MLF;

use D3\MLF\Taxonomy;
use D3\MLF\Cookie;

class Dropdown
{
	private $terms = array();
	private $title = '';
	private $id = '';
	private $taxonomy = null;
	private $data = array();

	public function __construct($args)
	{
		$this->title = $args['title'];
		$this->id = $args['taxonomy'];

		$this->taxonomy = new Taxonomy($args['taxonomy']);
		$this->terms = $this->taxonomy->getTerms();

		$cookieData = Cookie::getCookie();
		$this->data = $cookieData[$this->id];
	}

	public function render()
	{
		$args = array(
			'title' => $this->title,
			'terms' => $this->terms,
			'id' => $this->id,
			'data' => $this->data,
			'all' => boolval(count($this->data) == count($this->terms))
		);

		ob_start();
		include(plugin_dir_path(dirname(__FILE__)) . 'templates/dropdown.php');
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
	}
}
