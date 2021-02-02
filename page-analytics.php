<?php
$get_body = get_field('page_top_section');
if ($get_body):

$get_header_image = $get_body['intro_image'];
$get_page_image = $get_body['intro_bg_image'];
  if($get_page_image) {
    
    pilau_add_image_for_preloading($get_page_image);
  } else {

    pilau_add_image_for_preloading(get_bloginfo('template_directory').'/images/stories/stories_bg.png');
  }
  if($get_header_image) {

    pilau_add_image_for_preloading($get_header_image);
  } else {
    
    pilau_add_image_for_preloading(get_bloginfo('template_directory').'/images/stories/stories_masthead_bg.jpg');
  }
endif;


?>
<?php 

// Template Name not in use
//Hive Analytics
  
get_header(); ?>
 <?php

$get_body = get_field('page_top_section');
if ($get_body):
$get_header_image = $get_body['intro_image'];
$get_page_image = $get_body['intro_bg_image'];
?>
<div class="stories stories-bg detail-page" style="background: url('<?php if($get_page_image) : echo $get_page_image; else : echo get_bloginfo('template_directory'); ?>/images/stories/stories_bg.png<?php endif; ?>') no-repeat top right; background-size:cover;">
      

      <div class="masthead-bg" style="background: url('<?php if($get_header_image) : echo $get_header_image; else : echo get_bloginfo('template_directory'); ?>/images/stories/stories_masthead_bg.jpg<?php endif; ?>') no-repeat top right; background-size:cover;">
        <div class="container">
          <div class="col-9">
            <div class="row">
              <div class="pt-3 pb-3">
                <h2><?php the_title(); ?></h2>

                <h5><?php echo $get_body['intro_text']; ?></h5>

    <?php 
    wp_reset_postdata();
    endif;
    ?>
              </div>
          </div>
        </div>
      </div>
    </div>

<?php
if(have_posts()):
	while(have_posts()):the_post();
			get_template_part('content-analytics', get_post_format());
		endwhile; endif;
		?>


      

</div>
<?php get_footer(); ?>