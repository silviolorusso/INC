<?php get_header(); ?>
			<div id="content">
				<div id="pre-inner-content" class="wrap clearfix">
					<div id="inc-blurb">
						<p><?php echo get_option('inc_blurb');?></p>
					</div>

					<div class="box clearfix" id="inc-news">
						<div class="box-left index">
							<a href="<?php echo home_url().'/blog'; ?>">
								<div id="inc-news-pic">
								</div>
							</a>
							<p>Latest Updates from the INC</p>
						</div>
						<div class="box-right latest">
							<small>Latest Post</small>
							<?php
							$the_query = new WP_Query('posts_per_page=1');
							if ( $the_query->have_posts() ) { 
								while ( $the_query->have_posts() ) {
									$the_query->the_post(); ?>
									<a href="<?php echo the_permalink(); ?>">
											<h1><?php echo get_the_title(); ?></h1>
									</a>
									<span class="byline">By <?php echo get_the_author(); ?>, <?php echo get_the_date(); ?></span>
									<p><?php echo get_the_excerpt(); ?></p>
								<?php } 
							} else {
								echo 'No posts found!';
							}
							wp_reset_postdata(); ?>
						</div>
					</div>
					
					<a href="http://networkcultures.org/wpmu/geert/">
						<div id="geert-blog">
							<p>Net Critique. Blog by Geert Lovink</p>
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
					<h1 class="title-out">Current Projects</h1>
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
								<div class="box clearfix">
									<div class="box-left index">
										<a href="<?php echo $feedLink ?>">
											<img class="index-pic" src="<?php echo $banner ?>" />
										</a>
										<p><?php echo $description ?></p>
									</div>
									<div class="box-right latest">
										<small>Latest Post</small>
										<a href="<?php echo $lastLink ?>">
											<h1><?php echo $lastTitle ?></h1>
										</a>
										<span class="byline">By <?php echo $lastAuthorName ?>, <?php echo $lastDate ?></span>
										<p><?php echo $lastDesc ?></p>
									</div>
								</div>
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
					<form action="http://networkcultures.us3.list-manage2.com/subscribe/post?u=23551d685d17186a250c5a373&amp;id=a9358e73df" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
						<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Add your email..." required>
					    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
					    <div style="position: absolute; left: -5000px;"><input type="text" name="b_23551d685d17186a250c5a373_a9358e73df" value=""></div>
						<div class="clear"><input type="submit" value="Subscribe to INC Newsletter" name="subscribe" id="mc-embedded-subscribe"></div>
					</form>
				</div>
			</div>
<?php get_footer(); ?>