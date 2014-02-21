<?php get_header(); ?>
			<div id="content">
				<div id="inner-content" class="wrap clearfix">
					<div id="main" class="clearfix" role="main">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
								<header class="article-header">
									<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
									<p class="byline vcard"><?php
										printf( __( 'By <span class="author">%3$s</span>, <time class="updated" datetime="%1$s" pubdate>%2$s</time>.', 'bonestheme' ), get_the_time( 'Y-m-j' ), get_the_time( get_option('date_format')), bones_get_the_author_posts_link(), get_the_category_list(', ') );
									?></p>
								</header>
								<section class="entry-content clearfix" itemprop="articleBody">
									<?php the_content(); ?>
								</section>
								<footer class="article-footer">
									<div id="share">
										<span>Share</span>
										<a href="https://www.facebook.com/networkcultures"><i class="fa fa-facebook"></i></a>
										<a href="https://twitter.com/INCAmsterdam"><i class="fa fa-twitter"></i></a>
										<a href="https://twitter.com/INCAmsterdam"><i class="fa fa-envelope"></i></a>
									</div>
									<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>
								</footer>
							</article>
						<?php endwhile; ?>
						<?php else : ?>
							<article id="post-not-found" class="hentry clearfix">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
									</footer>
							</article>
						<?php endif; ?>
					</div>
					<div id="next" class="clearfix">
						<span id="next-read">Next Readings</span>
						<?php
						$the_query = new WP_Query('posts_per_page=3');
						if ( $the_query->have_posts() ) { 
							while ( $the_query->have_posts() ) {
								$the_query->the_post(); ?>
								<div class="next-post hentry">
									<?php
									$first_image = catch_that_image();
									if ($first_image != '') { ?>
									<div class="next-post-pic" style="background-image:url('<?php echo $first_image;?>')">
									</div>
									<?php } ?>
									<div class="next-post-text">
										<header>
											<a href="<?php echo the_permalink(); ?>">
												<h1><?php echo get_the_title(); ?></h1>
											</a>
											<p class="byline">By <?php echo get_the_author(); ?>, <?php echo get_the_date(); ?></p>
										</header>
										<p><?php echo get_the_excerpt(); ?></p>
									</div>
								</div>
							<?php } 
						} else {
							echo 'No posts found!';
						}
						wp_reset_postdata();
						?>
					</div>
				</div>
			</div>
<?php get_footer(); ?>