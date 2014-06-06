<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="clearfix" role="main">

							<?php if (is_category()) { ?>
								<h1 class="archive-title h1">
									<span><?php _e( 'Posts Categorized:', 'bonestheme' ); ?></span> <?php single_cat_title(); ?>
								</h1>

							<?php } elseif (is_tag()) { ?>
								<h1 class="archive-title h1">
									<span><?php _e( 'Posts Tagged:', 'bonestheme' ); ?></span> <?php single_tag_title(); ?>
								</h1>

							<?php } elseif (is_author()) {
								global $post;
								$author_id = $post->post_author;
							?>
								<h1 class="archive-title h1">

									<span><?php _e( 'Posts By:', 'bonestheme' ); ?></span> <?php the_author_meta('display_name', $author_id); ?>

								</h1>
							<?php } elseif (is_day()) { ?>
								<h1 class="archive-title h1">
									<span><?php _e( 'Daily Archives:', 'bonestheme' ); ?></span> <?php the_time('l, F j, Y'); ?>
								</h1>

							<?php } elseif (is_month()) { ?>
									<h1 class="archive-title h1">
										<span><?php _e( 'Monthly Archives:', 'bonestheme' ); ?></span> <?php the_time('F Y'); ?>
									</h1>

							<?php } elseif (is_year()) { ?>
									<h1 class="archive-title h1">
										<span><?php _e( 'Yearly Archives:', 'bonestheme' ); ?></span> <?php the_time('Y'); ?>
									</h1>
							<?php } ?>

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							
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
							<?php endwhile; ?>
								<nav class="wp-prev-next" id="nav-below">
									<ul class="clearfix">
										<li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'bonestheme' )) ?></li>
										<li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'bonestheme' )) ?></li>
									</ul>
								</nav>
							<?php else : ?>
									<article id="post-not-found" class="hentry clearfix">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the archive.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>
						</div>
								</div>
			</div>
<?php get_footer(); ?>