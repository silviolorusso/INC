<?php get_header(); ?>
			<div id="content">
				<div id="inner-content" class="wrap clearfix">
					<div id="main" class="clearfix" role="main">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
								<header class="article-header">
									<p id="breadcrumb">Blog:</p>
									<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
									<p class="byline vcard"><?php
										printf( __( 'By <span class="author">%4$s</span>, <time class="updated" datetime="%1$s" pubdate>%2$s at %3$s</time>.', 'bonestheme' ), get_the_time( 'Y-m-j' ), get_the_time( get_option('date_format')), get_the_time('g:i a'),  bones_get_the_author_posts_link(), get_the_category_list(', ') );
									?></p>
								</header>
								<section class="entry-content clearfix" itemprop="articleBody">
									<?php the_content(); ?>
								</section>
								<footer class="article-footer">
									<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>
									<div id="share">
										<span>Share</span>
										<script>function fbs_click() {u=location.href;t=document.title;window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}</script>
        <a href="http://www.facebook.com/share.php?u=<full page url to share>" onClick="return fbs_click()" target="_blank" title="Share This on Facebook"><i class="fa fa-facebook"></i></a>
										<a href="https://twitter.com/share?url=<?php echo urlencode(the_permalink()); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
										<a href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink() ?>." title="Share by Email"><i class="fa fa-envelope"></i></a>
									</div>
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
						<p id="next-read">Most Recent Readings</p>
						<?php
						$currentId = get_the_ID();
						$args = array(
							'posts_per_page' => 3,
							'post__not_in' => array( $currentId ),
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
						<?php wp_reset_postdata();?>
					</div>
				</div>
			</div>
<?php get_footer(); ?>