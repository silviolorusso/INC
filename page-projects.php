<?php
/*
Template Name: Projects
*/
?>

<?php get_header(); ?>
			<div id="content">
				<div id="inner-content" class="wrap clearfix">
					<div id="next" class="clearfix">
						<h1 class="title-out">All Projects</h1>
						<?php
						$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
						$args = array(
							'posts_per_page' => 10,
							'post_type' => 'project',
							'paged' => $paged
						);
						$the_query = new WP_Query($args);
						$even = 0;
						if ( $the_query->have_posts() ) { 
							while ( $the_query->have_posts() ) {
								$the_query->the_post(); 
								if ($even % 2 == 0) {
									$pos = 'first';
								} else {
									$pos = 'last';
								}
								?>
								<div class="box clearfix project sixcol <?php echo $pos; ?>">
									<a href="<?php echo the_permalink(); ?>">
										<?php 
										$banner = types_render_field("project-banner", array('output'=>'raw')); 
										$desc = types_render_field("project-description", array('output'=>'raw'));
										?>
										<div class="box-left index">
											<div class="project-pic" style="background-image:url('<?php echo $banner;?>')">
											</div>
											<p><?php echo $desc ?></p>
										</div>
									</a>
								</div>
							<?php 
								$even ++;
								} 
						} else {
							echo 'No posts found!';
						} ?>
						<nav class="clearfix" id="nav-below">
							<?php
							$big = 999999999; // need an unlikely integer
							
							echo paginate_links( array(
								'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								'format' => '?paged=%#%',
								'current' => max( 1, get_query_var('paged') ),
								'total' => $the_query->max_num_pages
							) );
							?>
						</nav>
						<?php wp_reset_postdata();
						?>
					</div>
				</div>
			</div>
<?php get_footer(); ?>