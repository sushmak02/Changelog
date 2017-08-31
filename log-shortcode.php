<?php 

class Change_log_shortcode {

	function __construct() {
		add_shortcode('log-shortcode', array($this,'change_log_fun'));
	}

	function change_log_fun() {

		add_action( 'wp_enqueue_scripts', 'prefix_add_log_stylesheet' );

		/**
		 * Enqueue plugin style-file
		 */
		function prefix_add_log_stylesheet() {
		    // Respects SSL, Style.css is relative to the current file
		    wp_register_style( 'prefix-style', plugins_url('style.css', __FILE__) );
		    wp_enqueue_style( 'prefix-style' );
		}

		get_header();
		$terms = get_terms(array(
		'taxonomy' => 'product',
		'hide_empty' => false,
		));
		 ?>

		<div>

		    <lable for="categories">Select Product :
		    </lable> 
		    <select name="categories" onchange="if (this.value) window.location.href=this.value">
		    <?php
				echo '<option value="' . home_url() . "/log/" . '">Select..</option>';
				echo '<option value="' . home_url() . "/log/" . '">All products</option>';
				foreach($terms as $term)
				{
				echo '<option value="' . get_term_link($term) . '">' . $term->name . '</option>';
				}
			?>
		    </select>
		  </div> 
				

			<?php ;/* Start the Loop */ ?>
			

			<div>
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
						echo ' ';
						 the_time( get_option( 'date_format' ) );  ?>
						</h3>
						<?php the_content(); ?>
						</div>
					

				<?php endwhile; ?>
			</div>

		

		

		<!-- #main -->

		
	</div><!-- #primary -->

<?php
	}
}


?>