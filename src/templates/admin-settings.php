<?php

use D3\MLF\AdminSettings;

?>

<div class="wrap">
	<h2>Metlife Filter Settings</h2>
	<p>A plugin to help filter content on the Metlife Site</p>
	<form action="options.php" method="post">
		<?php
			settings_fields('metlife_filter_options');
		?>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="metlife_filter_advanced_search_page">Advanced Search Page</label></th>
					<td>
						<?php
							echo AdminSettings::pageSelect('metlife_filter_advanced_search_page', 'metlife_filter_advanced_search_page', -1, 'id', $options['metlife_filter_advanced_search_page'], false);
						?>
						<p class="description">Select the page where the advanced search link will link to</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="metlife_filter_advanced_search_text">Advanced Search Text</label></th>
					<td>
						<input
							type="text"
							class=""
							name="metlife_filter_advanced_search_text"
							id="metlife_filter_advanced_search_text"
							value="<?php echo $options['metlife_filter_advanced_search_text']; ?>"
							/>
						<p class="description">The text that will appear for the advanced search link</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="metlife_filter_show_on_pages[]">Show Filter On Pages</label></th>
					<td>
						<?php
							echo AdminSettings::pageSelect('metlife_filter_show_on_pages[]', 'metlife_filter_show_on_pages', -1, 'id', $options['metlife_filter_show_on_pages'], true);
						?>
						<p class="description">Select the page(s) where you want the filter to be displayed</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="metlife_filter_active_agent_channel">Visible Agent Channels</label></th>
					<td>
						<?php
							echo AdminSettings::taxSelect('metlife_filter_active_agent_channel[]', 'metlife_filter_active_agent_channel', 'agent_channel', 'id', $options['metlife_filter_active_agent_channel'], true);
						?>
						<p class="description">Select the agent channels which you want visible in the filter.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="metlife_filter_active_appointed_state">Visible Appointed Statess</label></th>
					<td>
						<?php
							echo AdminSettings::taxSelect('metlife_filter_active_appointed_state[]', 'metlife_filter_active_appointed_state', 'appointed_state', 'id', $options['metlife_filter_active_appointed_state'], true);
						?>
						<p class="description">Select the states which you want visible in the filter.</p>
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit">
			<input type="submit" name="submit" class="button button-primary" value="Save Changes">
		</p>
	</form>
</div>
