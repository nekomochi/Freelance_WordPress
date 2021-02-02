<?php

function add_theme_scripts() {
	wp_enqueue_style('bootstrap', get_template_directory_uri().'/css/bootstrap.min.css', array(), '4.3.1');
	wp_enqueue_style('slick', get_template_directory_uri().'/css/slick.css', array(), '1.9.0');
	wp_enqueue_style('chosen', get_template_directory_uri().'/css/chosen.min.css', array(), '4.1.1');

	wp_enqueue_style('style', get_template_directory_uri().'/style.css');

	wp_register_script('jQuery','https://code.jquery.com/jquery-3.3.1.slim.min.js');
	wp_enqueue_script('jquery');
	wp_register_script('popperjs','https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js');
	wp_enqueue_script('jquery');
	
	wp_enqueue_script('bootstrapjs',get_template_directory_uri().'/js/bootstrap.min.js',array('jquery'),'4.3.1',true);
	wp_enqueue_script('slickjs',get_template_directory_uri().'/js/slick.min.js',array('jquery'),'1.9.0',true);
	wp_enqueue_script('chosenjs',get_template_directory_uri().'/js/chosen.jquery.min.js',array('jquery'),'4.1.1',true);
	wp_enqueue_script('custom',get_template_directory_uri().'/js/custom.js',array('jquery'),true);

	
}
add_action('wp_enqueue_scripts', 'add_theme_scripts');


$args = array(
    'flex-width'    => true,
    'flex-height'   => true,
    'default-image' => get_template_directory_uri() . '/images/logo_hive.png',
    // Display the header text along with the image
    'header-text'           => false,
    // Header text color default
    'default-text-color'        => '3B4454',

    // Header image width (in pixels)
    'width'             => 97,
    // Header image height (in pixels)
    'height'            => 41,
    // Header image random rotation default
    'random-default'        => false,
    // Enable upload of image file in admin 
    'uploads'       => true,
);
add_theme_support( 'custom-header', $args );


// // without parameter -> Post Thumbnail (as set by theme using set_post_thumbnail_size())
// the_post_thumbnail();

// the_post_thumbnail('thumbnail');       // Thumbnail (default 309px x 193px max)
// the_post_thumbnail('medium');          // Medium resolution (default 310px x 310px max)
// the_post_thumbnail('medium_large');    // Medium Large resolution (default 768px x 0px max)
// the_post_thumbnail('large');           // Large resolution (default 645px x 494px max)
// the_post_thumbnail('full');            // Original image resolution (unmodified)

// the_post_thumbnail( array(100,100) );  // Other resolutions


if ( function_exists( 'add_theme_support' ) ) {
    // add_theme_support( 'post-thumbnails' );
    // set_post_thumbnail_size( 310, 310,array( 'top', 'left') );
     // default Featured Image dimensions (cropped)


    // additional image sizes
    // delete the next line if you do not need additional image sizes
    add_image_size( 'feature-thumb', 310, 310,array( 'top', 'left')); //300 pixels wide
    add_image_size( 'feature-wide', 585, 310, array( 'top', 'left'));

 }

// Remove default image sizes here. 
function prefix_remove_default_images( $sizes ) {
 unset( $sizes['small']); // 150px
 unset( $sizes['thumbnail']); // 150px
 unset( $sizes['medium']); // 300px
 unset( $sizes['medium_large']); // 768px
 unset( $sizes['large']); // 1024px
 return $sizes;
}

add_filter('acf/validate_value/name=rightCol_thumb', 'my_acf_validate_value', 10, 4);

// add_filter('acf/validate_value/name=rightCol_thumb_home', 'my_acf_validate_value', 10, 4);

function my_acf_validate_value( $valid, $value, $field, $input ){
  
  // bail early if value is already invalid
  if( !$valid ) {
    
    return $valid;
    
  }
  
  
  // load image data
  $data = wp_get_attachment_image_src( $value, 'full' );
  $width = $data[1];
  $height = $data[2];
  
  if( $height < 310 ) {
    
    $valid = 'Image must be at least 310px height';
    
  }

  if( $width < 310 ) {
    
    $valid = 'Image must be at least 310px width';
    
  }
  
  
  // return
  return $valid;
  
  
}


function add_cat_tag_to_page() {  
    // Add tag metabox to page
    register_taxonomy_for_object_type('post_tag', 'page'); 
    // Add category metabox to page
    register_taxonomy_for_object_type('category', 'page');  
}
 // Add to the admin_init hook of your theme functions.php file 
add_action( 'init', 'add_cat_tag_to_page' );


function filter_search( $query ) {
  if( $query->is_search ) {

    $tag = get_term_by('name', 'feature', 'post_tag')->term_id;
    $query->set('tag__not_in', array($tag));

    if ( isset($_GET['cat']) ){
      $query->set( 'cat', $_GET['cat']);

    }
      
              // alter your search query here.
  }
return $query;
}
add_filter( 'pre_get_posts' , 'filter_search' );

/**
If you are using a custom homepage with custom loops and stuff or a custom front-page, you will have an empty wp_title. Here goes a neat hack to add the description/tagline at the wp_title place on homepage:
 */
add_filter( 'wp_title', 'baw_hack_wp_title_for_home' );
function baw_hack_wp_title_for_home( $title )
{
  if( empty( $title ) && ( is_home() || is_front_page() ) ) {
    return __( get_bloginfo( 'name' ));
  }
  return $title;
}

function truncate($str, $len) {
  $text = $str;

  if ( strlen($text) > $len ) {
    //We don't want to cut-off words so we need to split the text by words and check its length
    $words = preg_split("/[\n\r\t ]+/", $text, -1, PREG_SPLIT_NO_EMPTY);
    $count = 0;
    foreach ( $words as $k => $word ) {
      $count += strlen($word);
      //if we have the exact amount of chars, then we leave all the words
      if ( $count == $len ) {
        $words = array_slice( $words, 0, $k+1 );
        break;
      }
      //if we have more than the chars required, we don't include the last word
      elseif ( $count >= $len ) {
        $words = array_slice( $words, 0, $k ); //skip this last word
        break;
      }
    $count++; // counter increase for additional space
    }
  $text = implode(' ', $words) . ' ...';
  }
  return $text;
}



/**
 * Add an image for preloading
 *
 * All images must be added using this function before the header is output
 *
 * @param mixed $img  Either a string path, or a WP attachment object (the guid will be used)
 * @return  void
 **/
function pilau_add_image_for_preloading( $img ) {
  global $pilau_preload_images;
  
  if ( ! isset( $pilau_preload_images ) ) {
    $pilau_preload_images = array();
  }
  if ( is_object( $img ) && property_exists( $img , 'guid' ) ) {
    $pilau_preload_images[] = $img->guid;
  } else if ( is_string( $img ) ) {
    $pilau_preload_images[] = $img;
  }
}
/**
 * Set up images for preloading
 **/
add_action( 'wp_head', 'pilau_images_preload', 100 );
function pilau_images_preload() {
  global $pilau_preload_images;
  if ( isset( $pilau_preload_images ) && ! empty( $pilau_preload_images) ) {
    ?>
    <script type="text/javascript">
      pilau_preload_images( "<?php echo implode( '", "', $pilau_preload_images ); ?>" );
    </script>
    <?php
  }
}





function wd_hierarchical_tags_register() {

  // Maintain the built-in rewrite functionality of WordPress tags

  global $wp_rewrite;

  $rewrite =  array(
    'hierarchical'              => false, // Maintains tag permalink structure
    'slug'                      => get_option('tag_base') ? get_option('tag_base') : 'tag',
    'with_front'                => ! get_option('tag_base') || $wp_rewrite->using_index_permalinks(),
    'ep_mask'                   => EP_TAGS,
  );

  // Redefine tag labels (or leave them the same)

  $labels = array(
    'name'                       => _x( 'Tags', 'Taxonomy General Name', 'hierarchical_tags' ),
    'singular_name'              => _x( 'Tag', 'Taxonomy Singular Name', 'hierarchical_tags' ),
    'menu_name'                  => __( 'Taxonomy', 'hierarchical_tags' ),
    'all_items'                  => __( 'All Tags', 'hierarchical_tags' ),
    'parent_item'                => __( 'Parent Tag', 'hierarchical_tags' ),
    'parent_item_colon'          => __( 'Parent Tag:', 'hierarchical_tags' ),
    'new_item_name'              => __( 'New Tag Name', 'hierarchical_tags' ),
    'add_new_item'               => __( 'Add New Tag', 'hierarchical_tags' ),
    'edit_item'                  => __( 'Edit Tag', 'hierarchical_tags' ),
    'update_item'                => __( 'Update Tag', 'hierarchical_tags' ),
    'view_item'                  => __( 'View Tag', 'hierarchical_tags' ),
    'separate_items_with_commas' => __( 'Separate tags with commas', 'hierarchical_tags' ),
    'add_or_remove_items'        => __( 'Add or remove tags', 'hierarchical_tags' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'hierarchical_tags' ),
    'popular_items'              => __( 'Popular Tags', 'hierarchical_tags' ),
    'search_items'               => __( 'Search Tags', 'hierarchical_tags' ),
    'not_found'                  => __( 'Not Found', 'hierarchical_tags' ),
  );

  // Override structure of built-in WordPress tags

  register_taxonomy( 'post_tag', 'post', array(
    'hierarchical'              => true, // Was false, now set to true
    'query_var'                 => 'tag',
    'labels'                    => $labels,
    'rewrite'                   => $rewrite,
    'public'                    => true,
    'show_ui'                   => true,
    'show_admin_column'         => true,
    '_builtin'                  => true,
  ) );

}
// add_action('init', 'wd_hierarchical_tags_register');

?>