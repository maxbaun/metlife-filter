<?php

namespace D3\MLF;

use D3\MLF\Taxonomy;
use D3\MLF\Helpers;

class Dropdown
{
	private $terms = array();
	private $savedTerms = array();
	private $title = '';
	private $id = '';
	private $taxonomy = null;
	private $data = array();

	public function __construct($args)
	{
		$this->title = $args['title'];
		$this->id = $args['taxonomy'];

		$this->taxonomy = new Taxonomy($args['taxonomy']);
		$this->terms = $this->taxonomy->getActiveTerms();

		$this->savedTerms = $this->taxonomy->getSavedTerms();

		$this->data = (count($this->savedTerms) != 0) ? $this->savedTerms : Helpers::getTermIds($this->terms);
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
