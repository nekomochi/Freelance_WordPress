<div class="pt-4 pb-5">

        <div class="stories-post pt-3 pb-5">
<?php
$get_select_group = get_field('select_group');

if ($get_select_group):
?>
        <div class="container">
          

          <div class="row pb-3">

            <?php

            // echo $_GET['tag'];
            global $getTag;
            $tagsArray = explode(' ', $_GET['tag']);
            // print_r($tagsArray);
            // $tagsID = get_term_by('name', $tagsArray, 'post_tag');
            // echo "term".$tagsID;
            // echo ();
            $tagsIDArray = array();
            $remainingTags = array();
            // echo $firstTagID;
            foreach($tagsArray as $key => $value){
              // echo $key;
              if($key == 0) {
                // echo $value;

                $tagsIDArray[] = get_term_by('slug', $value, 'post_tag')->term_id;
              } else {
                $remainingTags[] = get_term_by('slug', $value, 'post_tag')->term_id;
              }
              
              // $tagsID[] = $tagsIDArray
            }
            // print_r($tagsIDArray);

            // print_r($remainingTags);


            if(count($tagsArray) > 1){
              // print_r ($tagsArray);
              // foreach($tagsArray as $key => $value) {
              //   // echo $value;
              //   // echo ($key);
              //   $getTag = implode('+', $value);
              // }
              $getTag = implode('+', $tagsArray);
            } else {
              $getTag = $_GET['tag'];
            }


            $get_drop_check = $get_select_group['drop_check'];

            if($get_drop_check == 'yes') {

              $get_drop_option = $get_select_group['filter_option'];
              $saveterms = array();

              if($get_drop_option == 'single') :
                //for single dropdown
                $terms = $get_select_group['page_filter'];

                if( $terms ): 
                $urltag = !empty( $_GET['tag'] ) ? $_GET['tag'] : '';

                ?>

                <div class="col-3">
                  <select class="custom-select tag-sort shadow-sm">
                  <?php 
                  
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
                endif; //if terms
            else:// else get_drop_option == double
              
              $firstLevel = $get_select_group['page_filter_copy'];
              $parentLevel = $get_select_group['page_filter_second'];
              $secondLevel = $get_select_group['page_filter_copy2'];

              // $terms = $get_select_group['page_filter'];

              $urltag = !empty( $tagsArray ) ? $tagsArray : '';


                if( $firstLevel ): 


                ?>

                <div class="col-3">
                  <select class="custom-select tag-sort shadow-sm">
                  <?php 
                  
                  foreach( $firstLevel as $term ): 
                 $getname = $term->name;
                  $getslug = $term->slug;
                  $saveterms[] = $term->term_id;
                    ?>

                 <option value="<?php echo $getslug; ?>" <?php echo in_array($getslug, $urltag) ? 'selected' : ''; ?>><?php echo $getname; ?></option>


                  <?php endforeach; ?>

                  </select>

                </div>
                


              <?php
                endif; //if firstLevel

                if($parentLevel):


                if( $secondLevel ):

                  // echo $_GET['tag'];
                  // print_r($parentLevel);
                if(($parentLevel->slug) != (in_array($getslug, $urltag))){
                    ?>

                    <div class="col-3">
                      <select class="custom-select first-sort shadow-sm" disabled="disabled">
                      <?php 
                      
                      foreach( $secondLevel as $term ): 
                     $getname = $term->name;
                      $getslug = $term->slug;
                      $saveterms[] = $term->term_id;
                        ?>

                     <option value="<?php echo $getslug; ?>" <?php echo in_array($getslug, $urltag) ? 'selected' : ''; ?>><?php echo $getname; ?></option>


                      <?php endforeach; ?>

                      </select>

                    </div>


                    <?php
                  } else {

                    // echo "equal";
                // $urltag = !empty( $_GET['tag'] ) ? $_GET['tag'] : '';


                ?>
                <div class="col-3">
                  <select class="custom-select second-sort shadow-sm">
                  <?php 
                  
                  foreach( $secondLevel as $term ): 
                 $getname = $term->name;
                  $getslug = $term->slug;
                  $saveterms[] = $term->term_id;
                    ?>

                 <option value="<?php echo $getslug; ?>" <?php echo in_array($getslug, $urltag) ? 'selected' : ''; ?>><?php echo $getname; ?></option>


                  <?php endforeach; ?>

                  </select>

                </div>
                
                


              <?php
            }
                endif; //if secondLevel
              endif; //if parentLevel


              ?>
              <div class="col-3">
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
                  <div class="col-4 pt-2"><?php echo $get_select_group['sort_by_label']; ?></div> 
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


          <div class="row pt-3">
            <div class="flex-wrapper pt-2">
              <?php


              $get_page_category = get_field('page_category');

    if ($get_page_category){

              $catList = array();
              foreach($get_page_category as $category):
                $catList[] = $category->term_id;
              endforeach;              

          $post_tags = get_the_tags();
          // print_r($post_tags[0]);
          
          
        if ( $post_tags ) {
            // $tagName = $post_tags[0]->name; //to display posts tagged with "All ..." - for filter dropdown

        if(isset($_GET['tag'])) {
          // print_r($tagsIDArray);
          $tagName = implode(',', $tagsIDArray);
          $extraTags = implode(',', $remainingTags);
        } else {
          $tagName = implode(',', $saveterms);
        }



        $get_feature_group = get_field('feature_group');
        // $get_feature = $get_feature_group['feature_tag']->term_id;
        // echo $get_feature;
          if($get_feature_group) {
            $get_feature_check = $get_feature_group['feature_check'];
            get_query_var( 'post_tag');
            $featuretag = get_term_by('name', 'feature', 'post_tag');


              if($get_feature_check == 'yes') {


                // print_r($saveterms);
                //  echo implode(',', $saveterms);
                //   echo $tagName;
                    //get tagged posts with 'All ... '
                    $custom_post_stories_query = new WP_Query(array(
                      'post_type' => 'post',
                      'cat' => $catList,
                      'tag__in' => array($tagName,($featuretag->term_id)),
                      'orderby' => $_GET['orderby'],
                      'order' => $_GET['order']
                    ));
              } else {
                
                  // exclude specific tag id from 'feature'
                // echo 'tag '.$tagName;
                // print_r($tagsArray);
                // echo $extraTags;
                $custom_post_stories_query = new WP_Query(array(
                  'post_type' => 'post',
                  'cat' => $catList,
                  'tag__in' => array($tagName),
                  'tag__and' => array($extraTags),
                  'tag__not_in' => array(($featuretag->term_id)),
                  'orderby' => $_GET['orderby'],
                  'order' => $_GET['order']
                ));

              }
              

          } //end of get_feature_group

        } else {

          $custom_post_stories_query = new WP_Query(array(
            'post_type' => 'post',
            'cat' => $catList,
            'tag__in' => array($tagName),
            'orderby' => $_GET['orderby'],
            'order' => $_GET['order']
          ));

                      
        } //end of post_tags


         if($custom_post_stories_query->have_posts()){
         while ($custom_post_stories_query->have_posts()) : $custom_post_stories_query->the_post();
              ?>


              <?php
              if(has_tag('product')):
              ?>
              <div class="col-3 flex">
                <div class="card">
                  <a href="<?php the_permalink(); ?>">
                    <?php if ( has_post_thumbnail() ) {?>
                    <img src="<?php the_post_thumbnail_url('feature-thumb'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                    <?php } else { ?>
                    <img src="<?php echo get_bloginfo('template_directory'); ?>/images/temp_placeholder_sq.jpg" class="card-img-top" alt="<?php the_title(); ?>">
                    <?php } ?>
                  </a>
                  <div class="card-body">
                      <h5 class="card-title"><?php the_title(); ?></h5>
                  </div>
                  <div class="card-footer">

                    <a href="<?php the_permalink();?>" class="card-link"><span class="link-arrow d-inline-block mr-3"></span>Learn More</a>
                  </div>
                  
                </div>
              </div>
            <?php elseif(has_tag('feature')) :
              ?>



              <div class="col-6 flex feature-card">

              <?php
                $customLink = get_field('custom_url');

                if( $customLink ): 

                  $customLink_url = $customLink['url'];
                  $customLink_title = $customLink['title'];
                  $customLink_target = $customLink['target'] ? $customLink['target'] : '_self';
              ?>
                <div class="card">
                  <a href="<?php echo esc_url($customLink_url); ?>">
                    <?php if ( has_post_thumbnail() ) {?>
                    <img src="<?php the_post_thumbnail_url('feature-wide'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                    <?php } else { ?>
                    <img src="<?php echo get_bloginfo('template_directory'); ?>/images/temp_placeholder_feature.jpg" class="card-img-top" alt="<?php the_title(); ?>">
                    <?php } ?>
                  </a>
                  <div class="card-footer">
                    
                    <a href="<?php echo esc_url($customLink_url); ?>" class="card-link" target="<?php echo esc_attr($customLink_target); ?>"><span class="link-arrow d-inline-block mr-3"></span><span class="link-wrapper"><?php the_title(); ?></span></a>
                    
                  </div>
                  
                </div>
                <?php
                  endif;
                ?>
              </div>



          <?php else : ?>
              <div class="col-3 flex">
                <div class="card">
                  <a href="<?php the_permalink(); ?>">
                    <?php if ( has_post_thumbnail() ) {?>
                    <img src="<?php the_post_thumbnail_url(array(309,193)); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                    <?php } else { ?>
                    <img src="<?php echo get_bloginfo('template_directory'); ?>/images/temp_placeholder.jpg" class="card-img-top" alt="<?php the_title(); ?>">
                    <?php } ?>
                  </a>
                  <div class="card-body">
                    <h5 class="card-title"><?php the_title(); ?></h5>
                  </div>
                  <div class="card-footer">
                   <?php

                   $get_excerpt_from_post = get_field('leftCol_group');
                   if($get_excerpt_from_post) :

                    $excerpt = truncate($get_excerpt_from_post['leftCol_content'], 100 ); 
                    ?>
                    <div class="card-text"><?php echo $excerpt; ?></div>
                  <?php
                  endif;
                  ?>
                    <a href="<?php the_permalink();?>" class="card-link"><span class="link-arrow d-inline-block mr-3"></span>Learn More</a>
                  </div>
                </div>
            </div>

              
              <?php 
            endif; 
          endwhile; 
        } //end stories_query if
    } //end page_category
  ?>
            </div>
          </div>
          <div class="row">

            <div class="col-12">
              <div class="float-right">
                <div class="scroll-top">
                  <span class="scroll-top-arrow"></span>
                  <a id="scroll-top">Back to top</a>
                </div>
              </div>
            </div>
          </div>
        </div>


          <?php
endif;

          ?>
      </div>
      </div>