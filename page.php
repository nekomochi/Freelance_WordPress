<?php

$get_page_image = get_field('home_bg_image');
if ($get_page_image){

  pilau_add_image_for_preloading($get_page_image);
} else {
  pilau_add_image_for_preloading(get_bloginfo('template_directory').'/images/home/lp-masthead.jpg');
}
?>
<?php 
/*
* Template Name: Hive Home
*/
get_header(); ?>

<div class="home"><div class="home-wrapper">
  <div class="home-search">
    <div class="masthead-bg" style="background: url('<?php if($get_page_image) : echo $get_page_image; else : echo get_bloginfo('template_directory'); ?>/images/home/lp-masthead.jpg<?php endif; ?>') no-repeat top left;">
      <div class="container">
        <div class="center-box">
              <div class="row">
        
              <?php
              
              $get_top = get_field('top_section');
              if ($get_top):
              
              ?>
                <div class="col-12">
                  <div class="intro-box">
                    <h2><?php echo $get_top['intro_title']; ?></h2>
                    <h3><?php echo $get_top['intro_text']; ?></h3>
                  </div>
                </div>
              <?php 
              wp_reset_postdata();
              endif;
              ?>
                
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="bg-white shadow-sm search-container">
        
                    <?php
          $get_search = get_field('search_section');
          if ($get_search):
      
          $get_search_pop = $get_search['intro_popular'];
      
                    ?>
                    
          
                    <?php get_search_form(); ?>
          
                    
                    <div class="tag-list">
                      <span class="pr-2"><?php echo $get_search_pop; ?></span>
                      <?php
                        $limitpop = 12;
                      
                        $popularposts = $wpdb->get_results($wpdb->prepare(
                            "
                            SELECT term
                            FROM {$wpdb->prefix}mwt_search_terms
                            ORDER BY total_count DESC
                            LIMIT %d
                            "
                            ,
                            $limitpop
                        )
                        );
                      
                        foreach ( $popularposts as $pop ) 
                        {
                                ?>
                                  <a href="<?php echo home_url(); ?>/?s=<?php echo $pop->term; ?>"><?php echo $pop->term; ?>
                          </a>
                                  
                                  <?php
                      
                        }
                        
                      ?>
          
                    </div>
          
                    <?php
          endif;
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <!-- center box -->
          </div>
    </div>
    <!-- masthead -->
  </div>
<?php 
if(have_posts()):while(have_posts()):the_post();
  get_template_part('content', get_post_format());
endwhile; endif; wp_reset_postdata();
?>

<?php

$get_bottom = get_field('bottom_section');
if ($get_bottom):

?>



<div class="home-footer">
  <div class="col-12 d-flex justify-content-center p-0">
    <!-- <div class="row"> -->
        <div class="col-5">
          <div class="home-content-box">
            <h1><?php echo $get_bottom['intro_title']; ?></h1>
            <p><?php echo $get_bottom['intro_text']; ?></p>
            <?php 
        $link = $get_bottom['intro_button'];

        if( $link ): 

          $link_url = $link['url'];
          $link_title = $link['title'];
          $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
            <a href="<?php echo esc_url($link_url); ?>" class="btn mt-2" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
        <?php endif; ?>
          </div>
        </div>
        <div class="col-7">
          <div class="row home-contact-image">
            <?php 

        $image = $get_bottom['intro_image'];

        if( !empty($image) ): ?>
            <div class="image-wrapper" style="background: url('<?php echo $image['url']; ?>'); background-repeat: no-repeat; background-position: center left; background-size: 100%;"></div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <!-- </div> -->
</div>

<?php 
wp_reset_postdata();
endif;
?>



</div></div>
<?php get_footer(); ?>