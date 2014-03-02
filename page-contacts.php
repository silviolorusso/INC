<?php
/*
Template Name: Contacts
*/
?>

<?php get_header(); ?>
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAswWfZD8B23KWA0pE3qpV6_P3YcbBVTgo&sensor=false&extension=.js"></script> 
			<script> google.maps.event.addDomListener(window, 'load', init);
			
			var map;
			
			function init() {
			    var mapOptions = {
			        center: new google.maps.LatLng(52.359883,4.909629),
			        zoom: 17,
			        zoomControl: true,
			        zoomControlOptions: {
			            style: google.maps.ZoomControlStyle.SMALL,
			        },
			        disableDoubleClickZoom: true,
			        mapTypeControl: true,
			        mapTypeControlOptions: {
			            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
			        },
			        scaleControl: false,
			        scrollwheel: false,
			        streetViewControl: true,
			        draggable : true,
			        overviewMapControl: true,
			        overviewMapControlOptions: {
			            opened: false,
			        },
			        mapTypeId: google.maps.MapTypeId.ROADMAP,
			    styles: [
									{
										// Style the map with the custom hue
										stylers: [
											{ "hue":"#dd0d0d" }
										]
									},
									{
										// Remove road labels
										featureType:"road",
										elementType:"labels",
										stylers: [
											{ "visibility":"off" }
										]
									},
									{
										// Style the road
										featureType:"road",
										elementType:"geometry",
										stylers: [
											{ "lightness":100 },
											{ "visibility":"simplified" }
										]
									}
								],
			    
			    }
			
			    var mapElement = document.getElementById('map');
			    var map = new google.maps.Map(mapElement, mapOptions);
			
			    marker = new google.maps.Marker({
		            icon: '',
		            position: new google.maps.LatLng(52.359883,4.909629),
		            map: map
		        });
			}
			</script> 
			<div id="map">
			</div>
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
