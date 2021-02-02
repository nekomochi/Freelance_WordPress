<?php
$get_body = get_field('page_top_section');
if ($get_body):

// $get_header_image = $get_body['intro_image'];
$get_page_image = $get_body['intro_bg_image'];
  if($get_page_image) {
    
    pilau_add_image_for_preloading($get_page_image);
  } else {

    pilau_add_image_for_preloading(get_bloginfo('template_directory').'/images/img-masthead-05.jpg');
  }


?>
<div class="detail-page" >
      
<div class="masthead-bg" style="background: url('<?php if($get_page_image) : echo $get_page_image; else : echo get_bloginfo('template_directory'); ?>/images/img-masthead-05.jpg<?php endif; ?>') no-repeat top left;">
      

      <div class="detail-page-container pb-5">
        <div class="container">
          <div class="center-box">
            <div class="center-box-inner bg-white">
              <div class="d-block title-content">
                <h1><?php the_title(); ?></h1>
                <!-- 239characters -->
                <?php

                $get_page_bg_text = $get_body['intro_text'];
                if($get_page_bg_text):
                  echo '<p>'.$get_page_bg_text.'</p>';
                endif;

                ?>
                <!-- start of filter by tags, sort by, search -->

                <?php
                $get_select_group = get_field('select_group');

                if ($get_select_group):
                ?>

                  <div class="row filter-group pb-3">

                    <?php

                    $get_drop_check = $get_select_group['drop_check'];

                    if($get_drop_check == 'yes') {

                      $terms = $get_select_group['page_filter'];

                      if( $terms ): 
                      $urltag = !empty( $_GET['tag'] ) ? $_GET['tag'] : '';
                      ?>

                    <div class="col-3">

                      <select class="custom-select tag-sort shadow-sm">
                      <?php 
                      $saveterms = array();
                      foreach( $terms as $term ): 
                     $getname = $term->name;
                      $getslug = $term->slug;
                      $saveterms[] = $term->term_id;
                        ?>

                     <option value="<?php echo $getslug; ?>" <?php echo $urltag == $getslug ? 'selected' : ''; ?>><?php echo $getname; ?></option>


                      <?php endforeach; ?>

                      </select>

                    </div>
                    <div class="col-6">
                      <?php get_search_form(); ?>
                    </div>


                    <?php
                    endif;
                  } else {
                    ?>

                    <div class="col-9">
                      <?php get_search_form(); ?>
                    </div>

                    <?php 
                   }
                    ?>

                    <div class="col-3">
                      <div class="row">

                        <?php
                        $get_sort_check = $get_select_group['sort_check'];

                        if($get_sort_check == 'yes') {
                        ?>
                          <div class="col-4 pt-2 pr-0"><?php echo $get_select_group['sort_by_label']; ?></div> 
                          <div class="col-8 pl-0">
                            <?php
                            $urlsort = !empty( $_GET['orderby'] ) ? $_GET['orderby'] : '';

                            $sfield = $get_select_group['sort_by_filter'];
                            if( $sfield ): ?>
                                <select class="custom-select shadow-sm detail-sort">
                                    <?php foreach( $sfield as $option): ?>
                                        <option value="<?php echo $option['value']; ?>" <?php echo $urlsort == $option['value'] ? 'selected' : ''; ?>><?php echo $option['label']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            <?php endif; ?>

                            
                          </div>

                        <?php
                        }
                        ?>
                      </div>
                    </div>
                  </div>


                <?php
                endif; //end get_select_group

                ?>
                <!-- end of filter by tags, sort by, search -->


              </div>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- end of masthead-bg -->
      

<?php
// h2 the_title();

// h5 $get_body['intro_text'];

    // wp_reset_postdata();
endif;?>

  <div class="page-content">
    <div class="container">
              

              <div class="row">
                <div class="flex-wrapper">
                  <?php
        $get_page_category = get_field('page_category');

                  $cta_card_text = get_field('get_cta_card_text','option');
                  $catcol_rows = get_field('get_catcolours','option');
                  $store_catcol = array();
                  if($catcol_rows){
                    // echo 'hello';

                    foreach($catcol_rows as $row){

                      $store_catcol[$row['select_category']->term_id] = $row['category_colour'];
                    }
                  }
                  // $get_pin_ids = get_field('page_pin_post');
                  // $offset_pin_posts = 
                  // print_r($get_pin_ids);
                  // echo 'this'.count($get_pin_ids);
                  // $article_cat = get_field('page_req_cat');

                  // $reqcatList = array();

                  // $get_leftCol_group = get_field('leftCol_group');

           
        if ($get_page_category){

                  $catList = array();
                  foreach($get_page_category as $category):
                    $catList[] = $category->term_id;
                    // echo $category->name;
                  endforeach;              

                  // if($article_cat){
                  //   foreach($article_cat as $newcategory):
                  //     $reqcatList[] = $newcategory->term_id;
                      
                  //   endforeach;
                  // }

                  // $result_cat = array_merge($catList, $reqcatList);

                  // print_r($result_cat);
              $post_tags = get_the_tags();
              // print_r($post_tags);
              
              
            // if ( $post_tags ) {
                // $tagName = $post_tags[0]->name; //to display posts tagged with "All ..." - for filter dropdown

              // $tagID = implode(',', $saveterms);

              // print_r($saveterms);


            // $get_feature_group = get_field('feature_group');
            // $get_feature = $get_feature_group['feature_tag']->term_id;
            // echo $get_feature;

            $sticky = count(get_option('sticky_posts'));



    //double query, to show sticky posts first then normal posts after

            if($sticky>0){
                      

                      $custom_post_stories_query = new WP_Query(array(
                        'post_type' => 'post',
                        'post__in' => get_option('sticky_posts'),
                            // 'ignore_sticky_posts' => 1,
                        // 'post__not_in' => $get_pin_ids,
                        'cat' => $catList,
                        // 'tag__in' => (!empty($tagID)) ? array($tagID) : '',
                        // 'tag__not_in' => array(($tag_in_feature->term_id)),
                        'orderby' => (!empty($_GET['orderby'])) ? $_GET['orderby'] : 'date',
                        'order' => (!empty($_GET['order'])) ? $_GET['order'] : 'DESC',
                        'tag' => (!empty($_GET['tag'])) ? $_GET['tag'] : '',
                        'posts_per_page' => -1
                      ));


                      //start of content
                      


                     if($custom_post_stories_query->have_posts()){
                     while ($custom_post_stories_query->have_posts()) : $custom_post_stories_query->the_post();

                      $article_link = get_field('custom_ba_url');
                      $article_desc = get_field('custom_ba_desc');

                      $get_author = get_field('author_group');
                      $get_author_name = $get_author['author_name'];

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

              if($article_link) : 

            $link_url = $article_link['url'];

          ?>
            <div class="col-3 flex">
                <div class="card">
                  <a href="<?php echo $link_url; ?>">
                                <span class="feature-ribbon"></span>
                    <div class="card-wrapper">
                      <div class="card-wrapper-inner">
                    <?php if ( has_post_thumbnail() ) {?>
                    <img src="<?php the_post_thumbnail_url(array(310,310)); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                    <?php } else { ?>
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
                      <div class="card-text">aaaaaaa<?php echo $article_desc; ?></div>

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
                                <span class="feature-ribbon"></span>
                    <div class="card-wrapper">
                      <div class="card-wrapper-inner">
                    <?php if ( has_post_thumbnail() ) {?>
                    <img src="<?php the_post_thumbnail_url(array(310,310)); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                    <?php } else { ?>
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
                      <div class="card-text">bbbbbbbbb<?php echo truncate(get_the_excerpt(), 70); ?></div>
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
                      endwhile; 
                    } //end stories_query if


                    //end of content

              
            }// end of if sticky

            //double query last part

            $custom_post_stories_query = new WP_Query(array(
              'post_type' => 'post',
              'post__not_in' => get_option('sticky_posts'),
                  // 'ignore_sticky_posts' => 1,
              // 'post__not_in' => $get_pin_ids,
              'cat' => $catList,
              // 'tag__in' => (!empty($tagID)) ? array($tagID) : '',
              // 'tag__not_in' => array(($tag_in_feature->term_id)),
              'orderby' => (!empty($_GET['orderby'])) ? $_GET['orderby'] : 'date',
              'order' => (!empty($_GET['order'])) ? $_GET['order'] : 'DESC',
              'tag' => (!empty($_GET['tag'])) ? $_GET['tag'] : '',
              'posts_per_page' => -1
      // 'offset' => -$sticky

            ));


              //start of content



             if($custom_post_stories_query->have_posts()){
                 while ($custom_post_stories_query->have_posts()) : $custom_post_stories_query->the_post();

                  $article_link = get_field('custom_ba_url');
                  $article_desc = get_field('custom_ba_desc');

                  $get_author = get_field('author_group');
                  $get_author_name = $get_author['author_name'];

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

                  if($article_link) {
                    $link_url = $article_link['url'];
                  
                  } else {
                    $link_url = get_the_permalink();
                  }
                  ?>


                  
                    <div class="col-3 flex">
                      <div class="card">
                        <a href="<?php echo $link_url; ?>">
                          <div class="card-wrapper">
                      <div class="card-wrapper-inner">
                          <?php if ( has_post_thumbnail() ) {?>
                          <img src="<?php the_post_thumbnail_url('feature-thumb'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                          <?php } else { ?>
                          <img src="<?php echo get_bloginfo('template_directory'); ?>/images/temp_placeholder.jpg" class="card-img-top" alt="<?php the_title(); ?>">
                          <?php } ?>
                        </div>
                      </div>
                        </a>

                        <div class="card-border">
                          <div class="card-body">
                            <a href="<?php echo get_category_link($catID); ?>" class="card-link pb-1" <?php if(array_key_exists($catID, $store_catcol)){ echo 'style="color:'.$store_catcol[$catID].'"'; }?>><?php echo $catName; ?></a>
                            <h5 class="card-title"><?php the_title(); ?></h5>


                            <?php
                              if($article_desc) {
                            ?>
                            <div class="card-text"><?php echo $article_desc; ?></div>

                            <?php } else if(has_excerpt($post->ID)){ ?>

                            <div class="card-text"><?php echo truncate(get_the_excerpt(), 70); ?></div>
                            <?php } ?>
                          </div>


                          <div class="card-footer">
                            <!-- <div class="card-text"></div> -->
                            <?php
                          if($article_link) {

                          $link_url = $article_link['url'];
                          ?>
                          <div class="d-block">
                            <a href="<?php echo $link_url;?>" class="card-link"><?php if($cta_card_text): echo $cta_card_text; else: ?>Read More<?php endif; ?><span class="link-arrow d-inline-block ml-2"></span>
                            </a>
                          </div>

                            <?php
                          }else{ //if no article link
                            ?>

                          <div class="d-block">
                            <a href="<?php the_permalink();?>" class="card-link"><?php if($cta_card_text): echo $cta_card_text; else: ?>Read More<?php endif; ?><span class="link-arrow d-inline-block ml-2"></span></a>
                          </div>
                            <?php
                          }
                            ?>
                            
                          </div>
                        </div>
                      </div>
                    </div>

                  
                  <?php 
              
            endwhile; // end while custom_post_stories_query
          } //end if custom_post_stories_query


            //end of content
            

        } // end if get_page_category
    ?>

           
            </div>
          </div>
          <div class="row">

            <div class="col-12">
              <div class="float-right">
                <div class="scroll-top pb-2">
                  <span class="scroll-top-arrow"></span>
                  <a id="scroll-top">Back to top</a>
                </div>
              </div>
            </div>
          </div>
    </div> <!-- end of container  -->
  </div> <!-- end of page-content -->
</div>