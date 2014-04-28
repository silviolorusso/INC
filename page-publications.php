<?php
/*
Template Name: Publications
*/
?>

<?php get_header(); ?>
			<div id="content">
				<div id="inner-content" class="wrap clearfix">
					<h1 class="title-out">Publications</h1>		
					<div id="pub-menu" class="clearfix">
					  <ul>
			            <li id="all" class="pub-menu-items current">
			                All
			            </li>
			            <li id="studies" class="pub-menu-items">
			                Studies in Network Cultures
			            </li>
			            <li id="inc-readers" class="pub-menu-items">
			                INC Readers
			            </li>
			            <li id="network-notebooks" class="pub-menu-items">
			                Network Notebooks
			            </li>
			            <li id="tod" class="pub-menu-items">
			                Theory on Demand
			            </li>
			             <li id="conference-reports" class="pub-menu-items">
			                Conference Reports
			            </li>
			            <li id="misc" class="pub-menu-items">
			                Miscellanea
			            </li>
			            <li id="geert-books" class="pub-menu-items">
			                Geert Lovink's books
			            </li>
					  </ul>
					</div>
					<div id="pub-desc" class="clearfix">
			            <p id="all-desc" style="display:block;">
			                <b>About the INC Publications:</b> The aim of the INC is to create sustainable research networks. In its first years, the INC selected a few emerging topics in which a critical contribution could be made, such as ICT for development, urban screens and the creative industries. Such an INC research thread may start with just one person with ideas on a topic of critical importance. This can lead to the formation of a small group of international researchers, both inside and outside of the academy, which may then result in a larger online discussion. 
			            </p>
			            <p id="studies-desc">
			                <b>About the Studies in Network Cultures:</b> This book series investigates concepts and practices specific to network cultures and also explores how to conduct research within this shifting environment. Published by NAi Publishers.
			            </p>
			            <p id="inc-readers-desc">
			                <b>About the INC Readers:</b> The INC Reader series are devoted to INC conference themes and derived from conference contributions.
			            </p>
			            <p id="network-notebooks-desc">
			                <b>About the Network Notebooks:</b> Network Notebooks presents new media research specifically commissioned by the INC.
			            </p>
			            <p id="tod-desc">
			                <b>About the Theory on Demand:</b> This series takes its name from Print on Demand, a process in which new copies of a book are not printed until an order has been received.
			            </p>
			            <p id="conference-reports-desc">
			                <b>Conference Reports:</b>
			            </p>
			            <p id="misc-desc">
			                <b>Miscellanea:</b>
			            </p>
			            <p id="geert-books-desc">
			                <b>About Geert Lovink's books:</b>
			            </p>
					</div>
			        <?php
			        $query = new WP_Query( array( 'posts_per_page' => -1, 'post_type' => 'publication' ) );
			        $i = 1;
			        while ( $query->have_posts() ) : $query->the_post();
			            $id = $query->post->ID;  
			        ?>
			        <?php $categories = get_the_category(); ?>
			        <div  id="publication-<?php the_ID() ?>" class="publication fourcol all
			                <?php
			                	if (($i - 1) % 3 == 0) {
				                	echo "first";
			                	} elseif (($i % 3) == 0) {
				                	echo "last";
			                	} 
			                	$i++;   
			                ?>
			                <?php
			                    foreach ($categories as $category) {
			                            echo $category->slug ;
			                    }        
			                ?>">
			            <a href="<?php echo get_permalink($id) ?>">
			                <div class="cover">
			                    <img src="<?php echo types_render_field("pub-cover", array('output'=>'raw')); ?>" />
			                </div>
			            </a>
						<div class="entry">
							<p class="categories">
			                <?php 
			                    foreach ($categories as $category) {
			                            echo $category->cat_name ;
			                    }        
			                ?>
			                </p>
							<p class="pub-title">
							     <a href="<?php echo get_permalink($id) ?>"><?php echo get_the_title($id) ?></a>
							</p>
				                <?php echo get_the_excerpt(); ?> | 
				                <?php 
							     $download = types_render_field("pub-download", array('output'=>'raw'));
							     if($download != '') {
							         echo '<a href="' . $download . '">Download PDF</a>';
							     }
							     $buy = types_render_field("pub-buy", array('output'=>'raw'));
							     if($buy != '') {
							         echo '<a href="' . $buy . '">Buy the book</a>';
							     }
							     ?>
							</p>
						</div>
<!--
						<div class="info">
			                <p>
			                    <span>Info: </span><?php echo types_render_field("pub-info", array('output'=>'raw')); ?>
			                </p>
						</div>
						<div class="download">
						     <?php 
						     $download = types_render_field("pub-download", array('output'=>'raw'));
						     if($download != '') {
						         echo '<a href="' . $download . '">Download PDF</a>';
						     }
						     $buy = types_render_field("pub-buy", array('output'=>'raw'));
						     if($buy != '') {
						         echo '<a href="' . $buy . '">Buy the book</a>';
						     }
						     ?>
						</div>
-->
					</div>
					<?php
			        endwhile;
			        ?>

				</div>
			</div>
<script>
        jQuery('document').ready(function(jQuery){
            jQuery('body').css('overflow-y', 'scroll');
        });

        function selectPub(className) { 
		    var pubId = '#' + className;
		    var pubClass = '.' + className;
	        jQuery(pubId).click(function() {
	            jQuery('.pub-menu-items').removeClass("current");
	            jQuery(this).addClass("current");
	            jQuery('div.publication' + pubClass).show('fast');
	            jQuery('div.publication:not(' +  pubClass + ')').hide('fast');
	            jQuery('div#pub-desc p').hide();
	            jQuery('p' + pubId + '-desc').show();
	            
	            jQuery('div.publication').removeClass("first last");
	            i = 1;
	            jQuery(pubClass).each(function() {
					if ((i - 1) % 3 == 0) {
						jQuery(this).addClass("first yo");
					} else if ((i % 3) == 0) {
						jQuery(this).addClass("last");
					} 
					i = i+1;
				}); 
	        });
        }
        selectPub('all');
        selectPub('studies');
        selectPub('inc-readers');
        selectPub('network-notebooks');
        selectPub('tod');
        selectPub('conference-reports');
        selectPub('misc');
        selectPub('geert-books');
</script>
			
<?php get_footer(); ?>