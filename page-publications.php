<?php
/*
Template Name: Publications
*/
?>

<?php get_header(); ?>
			<div id="content">
				<div id="inner-content" class="wrap clearfix">
					<h1 class="title-out">Publications</h1>	

					<a href="order-inc-publications/" id="order-button">
						<div id="geert-blog" class="box">
			        		<p>Order INC Publications</p>
			        	</div>
			        </a>

					<div id="pub-menu" class="clearfix">
					  <ul>
			            <li id="all" class="pub-menu-items current">
			                All
			            </li>
			            <li id="inc-reader" class="pub-menu-items">
			                INC Readers
			            </li>
			            <li id="net-notebook" class="pub-menu-items">
			                Network Notebooks
			            </li>
			            <li id="tod" class="pub-menu-items">
			                Theory on Demand
			            </li>
			            <li id="studies" class="pub-menu-items">
			                Studies in Network Cultures
			            </li>
			   			<li id="geert-book" class="pub-menu-items">
			                Geert Lovink's books
			            </li>
			             <li id="conference-report" class="pub-menu-items">
			                Conference Reports
			            </li>
			            <li id="misc" class="pub-menu-items">
			                Miscellanea
			            </li>
					  </ul>
					</div>
					<div id="pub-desc" class="clearfix">
			            <p id="all-desc" style="display:block;">
			                <?php echo types_render_field("all", array('output'=>'raw')); ?>
			            </p>
			            <p id="studies-desc">
			                <?php echo types_render_field("studies", array('output'=>'raw')); ?>
			            </p>
			            <p id="inc-reader-desc">
			                <?php echo types_render_field("readers", array('output'=>'raw')); ?>			            
			            </p>
			            <p id="net-notebook-desc">
			                <?php echo types_render_field("notebooks", array('output'=>'raw')); ?>
			            </p>
			            <p id="tod-desc">
				            <?php echo types_render_field("tod", array('output'=>'raw')); ?>
			            </p>
			            <p id="conference-report-desc">
			                <?php echo types_render_field("conference", array('output'=>'raw')); ?>
			            </p>
			            <p id="misc-desc">
			                <?php echo types_render_field("misc", array('output'=>'raw')); ?>
			            </p>
			            <p id="geert-book-desc">
			                <?php echo types_render_field("geert", array('output'=>'raw')); ?>
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
				                <?php 
				                $info = types_render_field("pub-info", array('output'=>'raw'));
				                if ($info != '') {
							         echo $info;
							    } else {
								    echo get_the_excerpt(); 
							    } ?> |
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
        selectPub('inc-reader');
        selectPub('net-notebook');
        selectPub('tod');
        selectPub('conference-report');
        selectPub('misc');
        selectPub('geert-book');
</script>
			
<?php get_footer(); ?>