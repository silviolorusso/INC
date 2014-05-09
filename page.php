<?php get_header(); ?>
			<div id="content">
				<div id="inner-content" class="wrap clearfix">
					<div id="main" class="clearfix" role="main">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
							<header class="article-header">
								<?php
								if ( is_page() && $post->post_parent > 0 ) { 
									$parent_id = $post->post_parent;
									?>
								    <p id="breadcrumb"><a href="<?php echo get_permalink($parent_id); ?>"><?php echo get_the_title($parent_id); ?></a> - <?php the_title(); ?></p>
								<?php } ?>
								<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
							</header>
							<section class="entry-content clearfix" itemprop="articleBody">
								<?php the_content(); ?>
						</section>
							<footer class="article-footer">
								<?php the_tags( '<span class="tags">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '' ); ?>
							</footer>
						</article>
						<?php endwhile; else : ?>
								<article id="post-not-found" class="hentry clearfix">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
									</footer>
								</article>
						<?php endif; ?>
					</div>
				</div>
			</div>
<?php get_footer(); ?>
