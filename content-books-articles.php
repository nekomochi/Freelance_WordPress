<div class="pt-4 pb-5">

        <div class="book-post pt-3 pb-5">
<?php
$get_select_group = get_field('select_group');
$get_feature_group = get_field('feature_group');
if ($get_select_group):
?>
        <div class="container">
          

          <div class="row pb-3">

            <?php

            $get_drop_check = $get_select_group['drop_check'];

            if($get_drop_check == 'yes') {

              $terms = $get_select_group['page_filter'];

              if( $terms ): 
              $urltag = !empty( $_GET['tag'] ) ? $_GET['tag'] : '';
              ?>

            <div class="col-3">

              <select class="custom-select tag-sort shadow-sm">
              <?php foreach( $terms as $term ): 
             $getname = $term->name;
              $getslug = $term->slug;
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


              $get_feature_check = $get_feature_group['feature_check'];

              if($get_feature_check == 'yes') {

              $get_feature = $get_feature_group['feature_tag']->term_id;
              //to display feature block according to tag selected on Page
              }

          $post_tags = get_the_tags();
          $tagName;
          if ( $post_tags ) {
              $tagName = $post_tags[0]->name; //to display posts tagged with "All ..." - for filter dropdown
          }

          $custom_post_stories_query = new WP_Query(array(
            'post_type' => 'post',
            'cat' => $catList,
            'tag__in' => (!empty($tagName)) ? ($tagName) : '',
            'orderby' => (!empty($_GET['orderby'])) ? $_GET['orderby'] : 'date',
            'order' => (!empty($_GET['order'])) ? $_GET['order'] : 'DESC',
            'tag' => (!empty($_GET['tag'])) ? $_GET['tag'] : ''
          ));
         if($custom_post_stories_query->have_posts()){
         while ($custom_post_stories_query->have_posts()) : $custom_post_stories_query->the_post();
              
          $get_custom_desc = get_field('custom_ba_desc');
          $get_custom_url = get_field('custom_ba_url');
// echo $get_custom_desc;


$get_author = get_field('author_group');
$get_author_name = $get_author['author_name'];


          if($get_custom_url) :


                  $customLink_url = $get_custom_url['url'];
                  $customLink_title = $get_custom_url['title'];
                  $customLink_target = $get_custom_url['target'] ? $get_custom_url['target'] : '_self';

              ?>


              <?php
              if($get_custom_desc):


              ?>
              <div class="col-3 flex">
                <div class="card">
                   <a href="<?php echo esc_url($customLink_url); ?>" target="<?php echo esc_attr($customLink_target); ?>" title="<?php the_title(); ?>">
                    <?php if ( has_post_thumbnail() ) {?>
                    <img src="<?php the_post_thumbnail_url(array(309,193)); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                    <?php } else { ?>
                    <img src="<?php echo get_bloginfo('template_directory'); ?>/images/temp_placeholder.jpg" class="card-img-top" alt="<?php the_title(); ?>">
                    <?php } ?>
                  </a>
                  <div class="card-body">
                    <h5 class="card-title"><?php the_title(); ?></h5>

                    <div class="card-text"><?php echo $get_custom_desc; ?></div>

                  </div>
                  <div class="card-footer">
                    <a href="<?php echo esc_url($customLink_url); ?>" target="<?php echo esc_attr($customLink_target); ?>" title="<?php the_title(); ?>" class="card-link">

                      <div class="clearfix">
                      <?php if($get_author_name):?>
                        <div class="d-inline-block card-link-text">by <?php echo $get_author_name; ?></div>
                      <?php endif; ?>
                        <div class="float-right">
                          <span class="link-arrow d-inline-block m1-3"></span>
                        </div>
                      </div>
                  </a>
                  </div>
                </div>
            </div>

              
              <?php else : ?>


              <div class="col-3 flex">
                <div class="card">
                  <a href="<?php echo esc_url($customLink_url); ?>" target="<?php echo esc_attr($customLink_target); ?>" title="<?php the_title(); ?>">
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
                    <a href="<?php echo esc_url($customLink_url); ?>" target="<?php echo esc_attr($customLink_target); ?>" title="<?php the_title(); ?>" class="card-link">

                      <div class="clearfix">
                      <?php if($get_author_name):?>
                        <div class="d-inline-block card-link-text">by <?php echo $get_author_name; ?></div>
                      <?php endif; ?>
                        <div class="float-right">
                          <span class="link-arrow d-inline-block m1-3"></span>
                        </div>
                      </div>
                  </a>
                  </div>
                  
                </div>
              </div>
              

              
              <?php endif; endif; ?>

              <?php 
           
          endwhile; 
        } 
    }
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