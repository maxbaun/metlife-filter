<?php

use D3\MLF\Dropdown;

?>

<div class="mlf-filter">
	<form id="mlf_filter_form_1" class="mlf-filter-form" action="index.html" method="post">
		<div class="mlf-filter-row">
			<div class="mlf-filter-col-1 mlf-filter-border-right mlf-filter-border-dark mlf-hidden-tablet">
				<span class="mlf-filter-title mlf-hidden-mobile">Filter By</span>
			</div>
			<div class="mlf-filter-col-2 mlf-filter-border-left mlf-filter-border-light mlf-float-right-mobile mlf-no-borders-tablet">
				<?php
					$agentDropdown = new Dropdown(array(
						'title' => 'Agent Channel(s)',
						'taxonomy' => 'agent_channel'
					));

					$agentDropdown->render();
				?>
			</div>
			<div class="mlf-filter-col-2 mlf-filter-border-left mlf-filter-border-light mlf-float-right-mobile mlf-no-borders-mobile">
				<?php
					$stateDropdown = new Dropdown(array(
						'title' => 'Appointed State(s)',
						'taxonomy' => 'appointed_state'
					));

					$stateDropdown->render();
				?>
			</div>
			<div class="mlf-filter-col-1 mlf-float-right-mobile">
				<div class="mlf-filter-form-submit">
					<input
						type="submit"
						class="mlf-filter-button"
						name="mlf_filter_form_submit"
						id="mlf_filter_form_submit"
						value="Apply"
						>
					<div class="mlf-filter-submit-loader" data-loader="loader">
						<?php
							include('loader.php');
						?>
					</div>
				</div>
			</div>
			<div class="mlf-filter-col-1 mlf-hidden-mobile">
				<a
					class="mlf-filter-link"
					href="<?php echo $advancedSearchPage; ?>"
					>
					<?php echo $advancedSearchText; ?>
				</a>
			</div>
		</div>
	</form>
</div>
