<?php

use D3\MLF\Dropdown;

?>

<div class="mlf-filter">
	<form id="mlf_filter_form_1" class="mlf-filter-form" action="index.html" method="post">
		<span class="mlf-filter-title">Filter By</span>
		<?php
			$agentDropdown = new Dropdown(array(
				'title' => 'Agent Channel(s)',
				'taxonomy' => 'agent_channel'
			));

			$agentDropdown->render();
		?>
		<?php
			$stateDropdown = new Dropdown(array(
				'title' => 'Appointed State(s)',
				'taxonomy' => 'appointed_state'
			));

			$stateDropdown->render();
		?>
		<div class="mlf-filter-form-submit">
			<input
				type="submit"
				class="mlf-filter-button"
				name="mlf_filter_form_submit"
				id="mlf_filter_form_submit"
				value="Apply"
				>
		</div>
		<a class="mlf-filter-link" href="#">Advanced Search</a>
	</form>
</div>
