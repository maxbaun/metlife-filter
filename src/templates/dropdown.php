<div class="mlf-filter-dropdown-group">
	<label class="mlf-filter-label" for="agent_channels"><?php echo $args['title']; ?></label>
	<div class="mlf-filter-dropdown">
		<span class="mlf-filter-dropdown-selected">
			<label class="mlf-filter-dropdown-selected-label">
				<span>All</span>
			</label>
		</span>
		<ul class="mlf-filter-dropdown-list">
			<li>
				<input
					type="checkbox"
					id="<?php echo $args['id']; ?>_all"
					value="all"
					<?php
						checked($args['all'], true, true);
					?>
					/>
				<label for="<?php echo $args['id']; ?>_all">
					All
				</label>
			</li>
			<?php foreach ($args['terms'] as $channel) : ?>
				<li>
					<input
						type="checkbox"
						id="<?php echo $args['id']; ?>_<?php echo $channel->term_id; ?>"
						name="<?php echo $args['id']; ?>[]"
						data-value="<?php echo $channel->name; ?>"
						value="<?php echo $channel->term_id; ?>"
						<?php
							checked(in_array($channel->term_id, $args['data']), true, true);
						?>
						/>
					<label for="<?php echo $args['id'] . '_' . $channel->term_id; ?>">
						<?php echo $channel->name; ?>
					</label>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
