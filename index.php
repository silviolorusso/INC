<?php get_header(); ?>
			<div id="content">
				<div id="pre-inner-content" class="wrap clearfix">
					<div id="inc-blurb">
						<p><?php echo get_option('inc_blurb');?></p>
					</div>
					<table class="box clearfix">
						<a href="#">
							<td class="left" id="inc-news">
								<div id="inc-news-pic">
								</div>
								<p>Latest Updates from the INC</p>
							</td>
						</a>
						<td class="latest">
							<small>Latest Post</small>
							<?php
							$the_query = new WP_Query('posts_per_page=1');
							if ( $the_query->have_posts() ) { 
								while ( $the_query->have_posts() ) {
									$the_query->the_post(); ?>
									<a href="<?php echo the_permalink(); ?>">
											<h1><?php echo get_the_title(); ?></h1>
									</a>
									<span class="by">By <?php echo get_the_author(); ?>, <?php echo get_the_date(); ?></span>
									<p><?php echo get_the_excerpt(); ?></p>
								<?php } 
							} else {
								echo 'No posts found!';
							}
							wp_reset_postdata();
							?>
						</td>
					</table>
					<a href="#">
						<div id="geert-blog">
							<p>Net Critique by Geert Lovink</p>
						</div>
					</a>
				</div>
				<?php 
				$banner = get_option('inc_banner');
				$banner_url = get_option('inc_banner_url');
				if ($banner != '') { ?>
				<a href="<?php echo $banner_url ?>">
					<div id="banner">
						<img src="<?php echo get_option('inc_banner');?>" />
					</div>
				</a>
				<?php } ?>
				<div id="current-projects" class="wrap clearfix">
					<h1>Current Projects</h1>
				</div>
				<!-- projects here -->
				<div id="inner-content" class="wrap clearfix">
					<div id="main" class="twelvecol first last clearfix" role="main">
						<?php
						include_once('library/parse-feed.php');
						
						function projectBox($banner, $description, $feedURL) {
							if (($banner != '') && ($description != '') && ($feedURL != '')) {						
								$feed = getFeed($feedURL);
								$feedLink = getFeedLink($feed);
								$last = getLastItem($feed);
								$lastLink = $last->get_permalink();
								$lastTitle = $last->get_title();	
								$lastAuthor = $last->get_author();
								$lastAuthorName = $lastAuthor->get_name();
								$lastDate = $last->get_date('j/n/y');	
								$lastDesc = $last->get_description();	
								?>
								<table class="box wrap clearfix">
									<td class="left">
										<a href="<?php echo $feedLink ?>">
											<img src="<?php echo $banner ?>" />
										</a>
										<p><?php echo $description ?></p>
									</td>
									<td class="latest">
										<small>Latest Post</small>
										<a href="<?php echo $lastLink ?>">
											<h1><?php echo $lastTitle ?></h1>
										</a>
										<span class="by">By <?php echo $lastAuthorName ?>, <?php echo $lastDate ?></span>
										<p><?php echo $lastDesc ?></p>
									</td>
								</table>
						<?php } 
						}
					    for ($i = 1; $i <= 5; $i++) {
						    $banner = get_option('project_'.$i.'_banner_url');
						    $desc = get_option('project_'.$i.'_desc');
						    $feedURL = get_option('project_'.$i.'_feed_url');
					    	projectBox($banner, $desc, $feedURL);
					    }
						?>
					</div>
				</div>
				<a href="#">
					<div id="inc-pubs">
						<div id="inc-pubs-button">
							See All Publications
						</div>
					</div>
				</a>
				<div id="newsletter" class="wrap clearfix">
					<form action="http://listcultures.org/mailman/listinfo/networkcultures-l_listcultures.org" action="GET"> 
						<!--<input type="text" value="Add your email...">-->
						<input type="submit" value="SUBSCRIBE TO INC NEWSLETTER">
					</form>
				</div>
			</div>
<?php get_footer(); ?>