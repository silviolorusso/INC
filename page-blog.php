<?php
/*
Template Name: Blog
*/
?>

<?php get_header(); ?>
			<div id="content">
				<div id="inner-content" class="wrap clearfix">
					<div id="next" class="clearfix">
						<h1 class="title-out">Updates from the INC</h1>
						<?php
						$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
						$args = array(
							'posts_per_page' => 10,
							'paged' => $paged
						);
						$the_query = new WP_Query($args);
						if ( $the_query->have_posts() ) { 
							while ( $the_query->have_posts() ) {
								$the_query->the_post(); ?>
								<div class="box clearfix">
									<a href="<?php echo the_permalink(); ?>">
										<?php
											$first_image = catch_that_image();
											if ( has_post_thumbnail() ) { 
												$url_thumb = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
											?>
											<div class="box-left single" style="background-image:url('<?php echo $url_thumb; ?>')">
											</div>
										<?php } elseif ($first_image != '') { ?>	
											<div class="box-left single" style="background-image:url('<?php echo $first_image;?>')">
											</div>
										<?php } else { ?>
											<div class="box-left single excerpt">
												<?php $excerpt = get_the_excerpt();
												echo implode(' ', array_slice(explode(' ', $excerpt), 0, 10)). '...'; 
												?>
											</div>
										<?php } ?>
										<div class="box-right">
											<h1><?php echo get_the_title(); ?></h1>
											<p class="byline">By <?php echo get_the_author(); ?>, <?php echo get_the_date(); ?></p>
											<p class="content"><?php echo get_the_excerpt(); ?></p>
										</div>
									</a>
								</div>
							<?php } 
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