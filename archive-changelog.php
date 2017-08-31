<?php
	/*
	 *
	 * Register with hook 'wp_enqueue_scripts', which can be used for front end CSS and JavaScript
	 */
	add_action( 'wp_enqueue_scripts', 'prefix_add_changelog_stylesheet' );
	/**
	 * Enqueue plugin style-file
	 */
	function prefix_add_changelog_stylesheet() {
	    // Respects SSL, Style.css is relative to the current file
	    wp_register_style( 'prefix-style', plugins_url('style.css', __FILE__) );
	    wp_enqueue_style( 'prefix-style' );
	}
	get_header(); 
	 ;/* Start the Loop */ ?>
				
	<div class="changelog-content">
		<?php
			$q = new WP_Query(array(
			'post_type' => 'changelog',
				));
			while ($q->have_posts() ) :
				$q->the_post();
		?>
				<div class="content-all">
					<h3>
						<?php the_title(); 
						echo ' - ';
						 the_time( get_option( 'date_format' ) );  ?>
					</h3>
					<?php the_content(); ?>
				</div>
			<?php endwhile; ?>
	</div>
		
