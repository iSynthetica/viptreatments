<div class="qodef-pie-chart-with-icon-holder">
	<div class="qodef-percentage-with-icon" <?php echo kloe_qodef_get_inline_attrs($pie_chart_data); ?>>
		<?php print $icon; ?>
	</div>
	<div class="qodef-pie-chart-text" <?php kloe_qodef_inline_style($pie_chart_style)?>>
		<<?php echo esc_html($title_tag)?> class="qodef-pie-title">
			<?php echo esc_html($title); ?>
		</<?php echo esc_html($title_tag)?>>
		<p><?php echo esc_html($text); ?></p>
	</div>
</div>