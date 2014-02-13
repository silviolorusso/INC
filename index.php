<?php get_header(); ?>
			<div id="content">
				<div id="pre-inner-content" class="wrap clearfix">
					<div id="inc-blurb">
						<p><?php echo get_option('inc_blurb');?></p>
					</div>
					<a href="#">
						<div id="inc-news">
							<div id="inc-news-pic">
							</div>
							<p>Latest Updates from the INC</p>
						</div>
					</a>
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
				<!-- projects here -->
				<div id="inner-content" class="wrap clearfix">
					<div id="main" class="twelvecol first last clearfix" role="main">
						<?php
						include_once('library/parse-feed.php');
						
						function projectBox($banner, $description, $feedURL) {
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
							<div class="box wrap clearfix">
								<div class="left fivecol first">
									<a href="<?php echo $feedLink ?>">
										<img src="<?php echo $banner ?>" />
									</a>
									<p><?php echo $description ?></p>
								</div>
								<div class="latest-post sevencol last">
									<small>Latest Post</small>
									<a href="<?php echo $lastLink ?>">
										<h1><?php echo $lastTitle ?></h1>
									</a>
									<span>By <?php echo $lastAuthorName ?>, <?php echo $lastDate ?></span>
									<p><?php echo $lastDesc ?></p>
								</div>
							</div>
						<?php }
						$banner1 = get_option('project_1_banner_url');
						$description1 = get_option('project_1_desc');
						
						projectBox($banner1, $description1, 'http://silviolorusso.com/feed/');
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
						<input type="text" value="Add your email...">
						<input type="submit" value="SUBSCRIBE ME TO INC NEWSLETTER">
					</form>
				</div>
			</div>
<?php get_footer(); ?>