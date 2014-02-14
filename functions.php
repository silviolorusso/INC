<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

/************* INCLUDE NEEDED FILES ***************/

/*
1. library/bones.php
	- head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
	- custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once( 'library/bones.php' ); // if you remove this, bones will break
/*
2. library/custom-post-type.php
	- an example custom post type
	- example custom taxonomy (like categories)
	- example custom taxonomy (like tags)
*/
require_once( 'library/custom-post-type.php' ); // you can disable this if you like
/*
3. library/admin.php
	- removing some default WordPress dashboard widgets
	- an example custom dashboard widget
	- adding custom login css
	- changing text in footer of admin
*/
// require_once( 'library/admin.php' ); // this comes turned off by default
/*
4. library/translation/translation.php
	- adding support for other languages
*/
// require_once( 'library/translation/translation.php' ); // this comes turned off by default

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'bones-thumb-600' => __('600px by 150px'),
        'bones-thumb-300' => __('300px by 100px'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select 
the new images sizes you have just created from within the media manager 
when you add media to your content blocks. If you add more image sizes, 
duplicate one of the lines in the array and name it according to your 
new image size.
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
				<?php
				/*
					this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
					echo get_avatar($comment,$size='32',$default='<path_to_url>' );
				*/
				?>
				<?php // custom gravatar call ?>
				<?php
					// create variable
					$bgauthemail = get_comment_author_email();
				?>
				<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
				<?php // end custom gravatar call ?>
				<?php printf(__( '<cite class="fn">%s</cite>', 'bonestheme' ), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>
				<?php edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert alert-info">
					<p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
				</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
	<?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
	$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	<label class="screen-reader-text" for="s">' . __( 'Search for:', 'bonestheme' ) . '</label>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr__( 'Search the Site...', 'bonestheme' ) . '" />
	<input type="submit" id="searchsubmit" value="' . esc_attr__( 'Search' ) .'" />
	</form>';
	return $form;
} // don't remove this bracket!

/************* INC *****************/

/** Step 2 (from text above). */
add_action( 'admin_menu', 'my_plugin_menu' );

/** Step 1. */
function my_plugin_menu() {
	add_options_page( 'INC Options', 'INC Options', 'manage_options', 'inc-settings', 'my_plugin_options' );
}

/** Step 3. */
function my_plugin_options() {
    //must check that the user has the required capability 
    if (!current_user_can('manage_options')) {
    	wp_die( __('You do not have sufficient permissions to access this page.') );
    }
    // variables for the field and option names 
    $hidden_field_name = 'inc_submit_hidden';
    
    $pre_opt_name = 'inc_blurb';
    $pre_opt_name2 = 'inc_banner';
    $pre_opt_name3 = 'inc_banner_url';
    // Read in existing option value from database
    $pre_opt_val = get_option( $pre_opt_name );
    $pre_opt_val2 = get_option( $pre_opt_name2 );
    $pre_opt_val3 = get_option( $pre_opt_name3 );
    
    // single projects
    $opts = array();
    for ($i = 1; $i <= 5; $i++) {
    	array_push($opts, 'project_'.$i.'_banner_url');
    	array_push($opts, 'project_'.$i.'_desc');
    	array_push($opts, 'project_'.$i.'_feed_url');
    } 
    $opts_val = array();
    // Read in existing option value from database
    foreach ($opts as $opt) {
    	$opt_val = get_option($opt);
    	array_push($opts_val, $opt_val);
    }
    

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $pre_opt_val = $_POST[ $pre_opt_name ];
        $pre_opt_val2 = $_POST[ $pre_opt_name2 ];
        $pre_opt_val3 = $_POST[ $pre_opt_name3 ];
        // Save the posted value in the database
        update_option( $pre_opt_name, $pre_opt_val );
        update_option( $pre_opt_name2, $pre_opt_val2 );
        update_option( $pre_opt_name3, $pre_opt_val3 );
        
        foreach ($opts as $opt) {
	    	$opt_val = $_POST[ $opt ];
	    	update_option( $opt, $opt_val );
	    }
        // Put a settings updated message on the screen
	?>
	<div class="updated"><p><strong><?php _e('settings saved.', 'menu-test' ); ?></strong></p></div>
		<?php
		    }
		    // Now display the settings editing screen
		echo '<div class="wrap">';
		    // header
		    echo "<h2>" . __( 'INC Settings', 'menu-test' ) . "</h2>";
		    // settings form
		    ?>
		<form name="form1" method="post" action="">
			<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
			
			<p class="submit">
				<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
			</p>
			
			<p><?php _e("INC Blurb", 'menu-test' ); ?></p>
			<textarea name="<?php echo $pre_opt_name; ?>" style="width: 400px; height: 150px;"><?php echo $pre_opt_val; ?></textarea>
			<hr />
			
			<p><?php _e("INC Banner", 'menu-test' ); ?></p>
			<input type="button" class="button-secondary upload_image_button" value="Upload Image" no="NaN" />
			<input type="text" name="<?php echo $pre_opt_name2; ?>" id="upload_imageNaN" value="<?php echo $pre_opt_val2; ?>" size='100' /><br/>
			Banner URL: <input type="text" name="<?php echo $pre_opt_name3; ?>" value="<?php echo $pre_opt_val3; ?>" size='40' />
			<hr />
			
			<?php 
			$k = 0;
			for ($i = 1; $i <= 5; $i++) { ?>
				<p><?php _e("Project #".($i), 'menu-test' ); ?></p>
				<input type="button" class='button-secondary upload_image_button' value="Upload Banner" no="<?php echo $k; ?>" />
				<input type="text" name="<?php echo $opts[$k]; ?>" id="upload_image<?php echo $k; ?>" value="<?php echo $opts_val[$k]; ?>" size='100' /><br/>
				Project description: <input type="text" name="<?php echo $opts[($k+1)]; ?>" value="<?php echo $opts_val[($k+1)]; ?>" size='80' /><br/>
				Project feed: <input type="text" name="<?php echo $opts[($k+2)]; ?>" value="<?php echo $opts_val[($k+2)]; ?>" size='80' />
				<hr />
				<?php 
				$k += 3;
			} ?>
			
			<p class="submit">
				<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
			</p>
		</form>
	</div>
<?php
}
// Upload images script for optional banner
function my_admin_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('my-upload', get_template_directory_uri().'/library/js/upload.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('my-upload');
}
function my_admin_styles() {
	wp_enqueue_style('thickbox');
}
if (isset($_GET['page']) && $_GET['page'] == 'inc-settings') {
	add_action('admin_print_scripts', 'my_admin_scripts');
	add_action('admin_print_styles', 'my_admin_styles');
}
?>
