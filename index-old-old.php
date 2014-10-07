<?php get_header(); ?>
			<div id="content">
				<div id="pre-inner-content" class="wrap clearfix">
					<div id="inc-blurb">
						<p><?php echo get_option('inc_blurb');?></p>
					</div>

					<!-- <div class="box clearfix" id="inc-news">
						<div class="box-left index">
							<a href="<?php echo home_url().'/blog'; ?>">
								<div id="inc-news-pic">
								</div>
							</a>
							<p>Updates from the INC</p>
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
									<p><?php echo the_excerpt(); ?></p>
								<?php } 
							} else {
								echo 'No posts found!';
							}
							wp_reset_postdata(); ?>
						</div>
					</div> -->
				</div>
<!-- 				
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
-->
<!-- 				
				<div id="current-projects" class="wrap clearfix">
					<h1 class="title-out">Current Projects</h1>
				</div> 
-->
				<!-- projects here: new versions -->
				<div id="inner-content" class="wrap clearfix">
					<a href="http://networkcultures.org/geert/">
						<div id="geert-blog" class="box">
							<p>net critique blog by Geert Lovink</p>
						</div>
					</a>
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

								$lastDateIndex = $last->get_date('o m d h i s ');
								$output = <<<EOT
								<div class="box clearfix">
									<div class="box-left index">
										<a href="$feedLink">
											<img class="index-pic" src="$banner" />
										</a>
										<p>$description</p>
									</div>
									<div class="box-right latest">
										<small>Latest Post</small>
										<a href="$lastLink">
											<h1>$lastTitle</h1>
										</a>
										<span class="byline">By $lastAuthorName, $lastDate</span>
										<p>$lastDesc</p>
									</div>
								</div>
EOT;
								return [
								    $lastDateIndex => $output,
								]; ?>
						<?php } 
						}
						$the_query = new WP_Query('post_type=blogfeed');
						$boxes = [];
						if ( $the_query->have_posts() ) { 
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
								$banner = wp_get_attachment_url( get_post_thumbnail_id() );
							    $desc = get_the_content();
							    $feedURL = get_the_title();
						    	$box = projectBox($banner, $desc, $feedURL); 
						    	// append to array
						    	$boxes = array_merge($boxes, $box);
						    } 
						} else {
							echo 'No posts found!';
						}
						wp_reset_postdata();
						?>
						<?php
						// reorder feeds
						ksort($boxes);
						$boxes = array_reverse($boxes);
						
						// print feeds
						$i = 0;
						foreach ($boxes as $key => $value) {
							echo $value;
							if ($i==0) {
								$banner = get_option('inc_banner');
								$banner_url = get_option('inc_banner_url');
								if ($banner != '') { ?>
					</div>
				</div>
								<a href="<?php echo $banner_url ?>">
									<div id="banner">
										<img src="<?php echo get_option('inc_banner');?>" />
									</div>
								</a>
				<div id="inner-content" class="wrap clearfix">
					<div id="main" class="twelvecol first last clearfix wrap" role="main">
							<?php } 
							}
							$i++;
						}
						?>
					</div>
				</div>				
				<a href="<?php echo home_url().'/publications'; ?>">
					<div id="inc-pubs">
						<div id="inc-pubs-button">
							See all INC publications
						</div>
					</div>
				</a>
				<div id="newsletter" class="wrap clearfix">
					<form action="http://networkcultures.us3.list-manage2.com/subscribe/post?u=23551d685d17186a250c5a373&amp;id=a9358e73df" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
						<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Add your email..." required>
					    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
					    <div style="position: absolute; left: -5000px;"><input type="text" name="b_23551d685d17186a250c5a373_a9358e73df" value=""></div>
						<div class="clear"><input type="submit" value="Subscribe to the INC newsletter" name="subscribe" id="mc-embedded-subscribe"></div>
					</form>
				</div>
			</div>
<?php get_footer(); ?>