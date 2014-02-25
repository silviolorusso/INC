<?php
/*
Template Name: Contacts
*/
?>

<?php get_header(); ?>
			<iframe id="map" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Rhijnspoorplein,+Weesperbuurt+en+Plantage,+Amsterdam,+The+Netherlands&amp;aq=0&amp;oq=rhijnpoo&amp;sll=52.36026,4.908632&amp;sspn=0.0095,0.021822&amp;ie=UTF8&amp;hq=&amp;hnear=Rhijnspoorplein,+Amsterdam,+The+Netherlands&amp;t=m&amp;z=14&amp;ll=52.36026,4.908632&amp;output=embed"></iframe>
			<div id="content">
				<div id="inner-content" class="wrap clearfix">
					<div id="main" class="clearfix" role="main">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<article id="page-contacts" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
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
