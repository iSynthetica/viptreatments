<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="qodef-post-content">
		<?php kloe_qodef_get_module_template_part('templates/lists/parts/image', 'blog'); ?>
		<div class="qodef-post-text">
			<div class="qodef-post-text-inner">
				<div class="qodef-post-info">
					<?php kloe_qodef_post_info(array('date' => 'yes', 'author' => 'no', 'category' => 'no', 'comments' => 'no', 'share' => 'no', 'like' => 'no')) ?>
				</div>
				<?php kloe_qodef_get_module_template_part('templates/lists/parts/title', 'blog', '', array('title_tag' => 'h5')); ?>
				<?php
					kloe_qodef_excerpt($excerpt_length);
					$args_pages = array(
							'before'           => '<div class="qodef-single-links-pages"><div class="qodef-single-links-pages-inner">',
							'after'            => '</div></div>',
							'link_before'      => '<span>',
							'link_after'       => '</span>',
							'pagelink'         => '%'
					);

					wp_link_pages($args_pages);
					kloe_qodef_read_more_button();
				?>
			</div>
		</div>
	</div>
</article>