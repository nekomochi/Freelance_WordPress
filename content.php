<?php 
// template belongs below of Home page
$cta_card_text = get_field('get_cta_card_text','option');
$catcol_rows = get_field('get_catcolours','option');
$store_catcol = array();
if($catcol_rows){
  // echo 'hello';

  foreach($catcol_rows as $row){
    // echo $row['select_category']->term_id;
    // echo '<br>';
    // echo $row['category_colour'];
    $store_catcol[$row['select_category']->term_id] = $row['category_colour'];
  }
}
// print_r($store_catcol);
?>
<div class="home-latest-post">
    <div class="container">
      aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
      <div class="row">
        <div class="flex-wrapper">



<?php
$cat = get_the_category(); 
          $catName = $cat[0]->name;
          $catID = $cat[0]->cat_ID;
$get_pin_ids = get_field('page_pin_post');

if($get_pin_ids) {

          $posts_by_cat = new WP_Query( array( 'cat' => $catID ) ); 
          $numposts = $posts_by_cat->found_posts;
// echo $numposts;
          // echo count($get_pin_ids);
          $args = array(
            'post_type' => 'post',
            'post__in' => $get_pin_ids,
            // 'cat' => $catID,
            'ignore_sticky_posts' => 1,
            'orderby'    => 'date',
            'post_status' => 'publish',
            'order'    => 'DESC'
          );

        $result = new WP_Query( $args );


        if ( $result-> have_posts() ) :
           if(count($get_pin_ids) > 2){

?>
<div class="home-slider">
  <!-- <div class="home-slider-inner"> -->
<div class="slider row w-100 mx-auto">

                  <?php
                  // foreach( $posts_how_to as $post ) :  setup_postdata($post);
                  while($result->have_posts()) : $result->the_post();
$get_specific = get_field('category_and_tag_group');
$get_specific_cat = $get_specific['display_category'];
if($get_specific_cat) {
  $catName = $get_specific_cat->name;
  $catID = $get_specific_cat->cat_ID;
} else {

  $cat = get_the_category(); 
  $catName = $cat[0]->name;
  $catID = $cat[0]->cat_ID;
}

$get_author = get_field('author_group');
$get_author_name = $get_author['author_name'];
$article_link = get_field('custom_ba_url');
$get_rightCol = get_field('rightCol_group');
                  ?>
                  <div class="slide">
                    <div class="col-12 flex feature-card">

                      <div class="card">
                        <?php
                        if($article_link) {

                        $link_url = $article_link['url'];
                        ?>
                        <a href="<?php echo $link_url; ?>">
                          <span class="feature-ribbon"></span>
                          <?php
                        }else{
                          ?>



                        <a href="<?php the_permalink(); ?>">

                          <span class="feature-ribbon"></span>
                          <?php
                        }
                          ?>
                          <div class="card-wrapper">
                      <div class="card-wrapper-inner">
                          <?php
                          if($get_rightCol){
                            if(isset($get_rightCol['rightCol_thumb_home'])){
                              $get_rightColHomeImage = $get_rightCol['rightCol_thumb_home'];
                            }
                            if (!empty($get_rightColHomeImage)) {
                          ?>
                            <img src="<?php echo $get_rightColHomeImage['sizes']['feature-wide']; ?>" class="card-img-top" alt="<?php the_title(); ?>" data-lazy="<?php echo $get_rightColHomeImage['sizes']['feature-wide']; ?>">
                          <?php
                            } else {
                          ?>
                            <img src="<?php the_post_thumbnail_url('feature-wide'); ?>" class="card-img-top" alt="<?php the_title(); ?>" data-lazy="<?php the_post_thumbnail_url('feature-wide'); ?>">
                          <?php
                            }
                          } else { ?>
                          <img src="<?php echo get_bloginfo('template_directory'); ?>/images/temp_placeholder_feature.jpg" class="card-img-top" alt="<?php the_title(); ?>" data-lazy="<?php echo get_bloginfo('template_directory'); ?>/images/temp_placeholder_feature.jpg">
                          <?php } ?>
                        </div>
                      </div>
                        </a>

                        <div class="card-border">
                          <div class="card-body">
                            <a href="<?php echo get_category_link($catID); ?>" class="card-link pb-2" <?php if(array_key_exists($catID, $store_catcol)){ echo 'style="color:'.$store_catcol[$catID].'"'; }?>><?php echo $catName; ?></a>
                            <h5 class="card-title"><?php the_title(); ?></h5>
                            <?php if(has_excerpt($post->ID)){ ?>
                              <div class="card-text"><?php echo truncate(get_the_excerpt(), 133); ?></div> 
                            <?php } ?>
                          </div>


                          <div class="card-footer">
                            <!-- <div class="card-text"></div> -->
                            <?php
                          if($article_link) {

                          $link_url = $article_link['url'];
                          ?>
                          <div class="d-block">
                            <a href="<?php echo $link_url;?>" class="card-link">
                              <div class="clearfix">
                              <?php if($get_author_name):?>
                                <div class="d-inline-block card-link-text">By <?php echo $get_author_name; ?></div>

                              <?php endif; ?>
                                <div class="float-right">
                                  <span class="link-arrow d-inline-block m1-3"></span>
                                </div>
                              </div>
                            </a>
                          </div>

                            <?php
                          }else{ //if no article link
                            ?>

                          <div class="d-block">
                            <a href="<?php the_permalink();?>" class="card-link">
                            <div class="clearfix">
                            <?php if($get_author_name):?>
                              <div class="d-inline-block card-link-text">By <?php echo $get_author_name; ?></div>
                            <?php endif; ?>
                              <div class="float-right">
                                <span class="link-arrow d-inline-block m1-3"></span>
                              </div>
                            </div>
                            </a>
                          </div>
                            <?php
                          }
                            ?>
                            
                          </div>
                        </div>
                        <!-- card border -->
                        
                      </div>
                    </div>
                  </div>

                <?php endwhile;  ?>
                </div>

                <div class="slider-arrows">
                  <a class="carousel-control-prev" href="#myCarousel">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#myCarousel">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>

                  </a>
                </div>
              <!-- </div> -->
</div> <!-- end of home-slider -->

              <?php
              // $term = $hero['feature_post_tag']->term_id;
              } else { //if count pin_ids > 2 else


                   
                  while($result->have_posts()) : $result->the_post();
$get_specific = get_field('category_and_tag_group');
$get_specific_cat = $get_specific['display_category'];
if($get_specific_cat) {
  $catName = $get_specific_cat->name;
  $catID = $get_specific_cat->cat_ID;
} else {

  $cat = get_the_category(); 
  $catName = $cat[0]->name;
  $catID = $cat[0]->cat_ID;
}

$get_author = get_field('author_group');
$get_author_name = $get_author['author_name'];
$article_link = get_field('custom_ba_url');
$get_rightCol = get_field('rightCol_group');
                  ?>
                  <div class="col-6 flex feature-card">

                    

                      <div class="card">
                        <?php
                        if($article_link) {

                        $link_url = $article_link['url'];
                        ?>
                        <a href="<?php echo $link_url; ?>">
                          <span class="feature-ribbon"></span>
                          <?php
                        }else{
                          ?>



                        <a href="<?php the_permalink(); ?>">

                          <span class="feature-ribbon"></span>
                          <?php
                        }
                          ?>

                          <div class="card-wrapper">
                      <div class="card-wrapper-inner">
                          <?php
                          if($get_rightCol){
                            if(isset($get_rightCol['rightCol_thumb_home'])){
                              $get_rightColHomeImage = $get_rightCol['rightCol_thumb_home'];
                            }
                            if (!empty($get_rightColHomeImage)) {
                          ?>
                            <img src="<?php echo $get_rightColHomeImage['sizes']['feature-wide']; ?>" class="card-img-top" alt="<?php the_title(); ?>">
                          <?php
                            } else {
                          ?>
                            <img src="<?php the_post_thumbnail_url('feature-wide'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                          <?php
                            }
                          } else { ?>
                          <img src="<?php echo get_bloginfo('template_directory'); ?>/images/temp_placeholder_feature.jpg" class="card-img-top" alt="<?php the_title(); ?>">
                          <?php } ?>
                        </div>
                      </div>

                        </a>

                        <div class="card-border">
                          <div class="card-body">
                            <a href="<?php echo get_category_link($catID); ?>" class="card-link pb-2" <?php if(array_key_exists($catID, $store_catcol)){ echo 'style="color:'.$store_catcol[$catID].'"'; }?>><?php echo $catName; ?></a>
                            <h5 class="card-title"><?php the_title(); ?></h5>
                            <?php if(has_excerpt($post->ID)){ ?>
                              <div class="card-text"><?php echo truncate(get_the_excerpt(), 133); ?></div> 
                            <?php } ?>
                          </div>


                          <div class="card-footer">
                            <!-- <div class="card-text"></div> -->
                            <?php
                          if($article_link) {

                          $link_url = $article_link['url'];
                          ?>
                          <div class="d-block">
                            <a href="<?php echo $link_url;?>" class="card-link">
                              <div class="clearfix">
                              <?php if($get_author_name):?>
                                <div class="d-inline-block card-link-text">By <?php echo $get_author_name; ?></div>

                              <?php endif; ?>
                                <div class="float-right">
                                  <span class="link-arrow d-inline-block m1-3"></span>
                                </div>
                              </div>
                            </a>
                          </div>

                            <?php
                          }else{ //if no article link
                            ?>

                          <div class="d-block">
                            <a href="<?php the_permalink();?>" class="card-link">
                            <div class="clearfix">
                            <?php if($get_author_name):?>
                              <div class="d-inline-block card-link-text">By <?php echo $get_author_name; ?></div>
                            <?php endif; ?>
                              <div class="float-right">
                                <span class="link-arrow d-inline-block m1-3"></span>
                              </div>
                            </div>
                            </a>
                          </div>
                            <?php
                          }
                            ?>
                            
                          </div>
                        </div>
                        <!-- card border -->
                        
                      </div>
                    
                  </div>

                  <?php 
                
              endwhile; 
            }
            wp_reset_postdata();
          endif;
  }
?>
<?php 

 // wp_reset_postdata();
$hero = get_field('trending_posts');



if ($hero):

// $get_feature_group = get_field('feature_group');
// $get_feature = $hero['feature_tag']->term_id;


  ?>
    <div class="col-12 pt-5">
      <h5 class="pt-3 pb-3"><?php echo $hero['title']; ?></h5>
    </div>

        <?php 

        // echo $termID;
        $args = array(
          'post_type'=> 'post',
          'post__not_in' => $get_pin_ids,
          // 'tag__not_in' => array($get_feature),
          'orderby'    => 'date',
          'post_status' => 'publish',
          'order'    => 'DESC',
          // 'post__not_in' => get_option( 'sticky_posts' ),
          // 'offset' => 2,
          'ignore_sticky_posts' => 1,
          'posts_per_page' => 12 // this will retrive all the post that is published
        );
        $result = new WP_Query( $args );



        


        if ( $result-> have_posts() ) :
         while ( $result->have_posts() ) : $result->the_post();


          $get_specific = get_field('category_and_tag_group');
          $get_specific_cat = $get_specific['display_category'];
          if($get_specific_cat) {
            $catName = $get_specific_cat->name;
            $catID = $get_specific_cat->cat_ID;
          } else {

            $cat = get_the_category(); 
            $catName = $cat[0]->name;
            $catID = $cat[0]->cat_ID;
          }

$get_author = get_field('author_group');
$get_author_name = $get_author['author_name'];
$article_link = get_field('custom_ba_url');
$get_rightCol = get_field('rightCol_group');

$article_desc = get_field('custom_ba_desc');
        ?>
        

        
 <?php
              if($article_link) : 

            $link_url = $article_link['url'];

          ?>
            <div class="col-3 flex">
                <div class="card">
                  <a href="<?php echo $link_url; ?>">
                    <div class="card-wrapper">
                      <div class="card-wrapper-inner">
              <?php
              if($get_rightCol){
                if(isset($get_rightCol['rightCol_thumb_home'])){
                  $get_rightColHomeImage = $get_rightCol['rightCol_thumb_home'];
                }
                if (!empty($get_rightColHomeImage)) {
              ?>
                <img src="<?php echo $get_rightColHomeImage['sizes']['feature-thumb']; ?>" class="card-img-top" alt="<?php the_title(); ?>">
              <?php
                } else {
              ?>
                <img src="<?php the_post_thumbnail_url('feature-thumb'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
              <?php
                }
              } else { ?>
              <img src="<?php echo get_bloginfo('template_directory'); ?>/images/temp_placeholder_sq.jpg" class="card-img-top" alt="<?php the_title(); ?>">
              <?php } ?>
            </div>
          </div>

                  </a>
                  <div class="card-border">
                    <div class="card-body">
                      <a href="<?php echo get_category_link($catID); ?>" class="card-link pb-1" <?php if(array_key_exists($catID, $store_catcol)){ echo 'style="color:'.$store_catcol[$catID].'"'; }?>><?php echo $catName; ?></a>
                      <h5 class="card-title"><?php the_title(); ?></h5>
                      <?php

                    if($article_desc):
                      ?>
                      <div class="card-text"><?php echo $article_desc; ?></div>

                      <?php
                    endif;
                      ?>
                    </div>
                    <div class="card-footer">

                  <div class="d-block">
                    <a href="<?php echo $link_url;?>" class="card-link"><?php if($cta_card_text): echo $cta_card_text; else: ?>Read More<?php endif; ?><span class="link-arrow d-inline-block ml-2"></span>
                    </a>
                  </div>

                  </div>
                    
                </div>
                </div>
            </div>


          <?php else : ?>
              <div class="col-3 flex">
                <div class="card">
                  <a href="<?php the_permalink(); ?>">
                    <div class="card-wrapper">
                      <div class="card-wrapper-inner">
              <?php
              if($get_rightCol){
                if(isset($get_rightCol['rightCol_thumb_home'])){
                  $get_rightColHomeImage = $get_rightCol['rightCol_thumb_home'];
                }
                if (!empty($get_rightColHomeImage)) {
              ?>
                <img src="<?php echo $get_rightColHomeImage['sizes']['feature-thumb']; ?>" class="card-img-top" alt="<?php the_title(); ?>">
              <?php
                } else {
              ?>
                <img src="<?php the_post_thumbnail_url('feature-thumb'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
              <?php
                }
              } else { ?>
              <img src="<?php echo get_bloginfo('template_directory'); ?>/images/temp_placeholder_sq.jpg" class="card-img-top" alt="<?php the_title(); ?>">
              <?php } ?>
            </div>
          </div>
                  </a>
                  <div class="card-border">
                    <div class="card-body">
                      <a href="<?php echo get_category_link($catID); ?>" class="card-link pb-1" <?php if(array_key_exists($catID, $store_catcol)){ echo 'style="color:'.$store_catcol[$catID].'"'; }?>><?php echo $catName; ?></a>
                      <h5 class="card-title"><?php the_title(); ?></h5>

                      <?php if(has_excerpt($post->ID)){ ?>
                      <div class="card-text"><?php echo truncate(get_the_excerpt(), 70); ?></div>
                    <?php } ?>
                      
                    </div>
                    <div class="card-footer">
                      <div class="d-block">
                      <a href="<?php the_permalink();?>" class="card-link"><?php if($cta_card_text): echo $cta_card_text; else: ?>Read More<?php endif; ?><span class="link-arrow d-inline-block ml-2"></span></a>
                    </div>
                    </div>
                </div>
                </div>
            </div>

              
              <?php 
            endif; 

          endwhile; wp_reset_postdata(); endif; ?>

        
  <?php

  endif;



  ?>


        </div>
      </div>
    </div>
  </div>