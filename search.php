<?php get_header(); ?>
<?php
$get_page_image = get_field('search_banner_image','option');

$get_page_title = get_field('search_banner_title','option');
if($get_page_image) {
  
  pilau_add_image_for_preloading($get_page_image);
} else {

  pilau_add_image_for_preloading(get_bloginfo('template_directory').'/images/home/lp-masthead.jpg');
}
global $wp_query;
$total_results = $wp_query->found_posts;
?>
<div class="search">

  <div class="masthead-bg" style="background: url('<?php if($get_page_image) : echo $get_page_image; else : echo get_bloginfo('template_directory'); ?>/images/home/lp-masthead.jpg<?php endif; ?>') no-repeat top left;">
      

      <div class="detail-page-container">
        <div class="container">
          <div class="center-box">
            <div class="center-box-inner bg-white">
              <div class="d-block title-content">
                <h1><?php echo $get_page_title; ?></h1>
                <p><?php echo $total_results; ?> Results for "<?php the_search_query(); ?>" 
                  <?php 
                  if(!empty($_GET['cat'])) :
                  $cat = explode(',',$_GET['cat']);
                  $getcat = array();
                  foreach($cat as $ID){
                    $getcat[] = get_the_category_by_ID($ID);
                  }
                  ?> in <?php echo implode(' & ',$getcat); endif; ?>
                </p>
                <div class="row filter-group pb-3">
                  <!-- <div class="col-3 pt-3">
                    
                  </div> -->
                  <div class="col-9">
                    <?php get_search_form(); ?>

                  </div>
                  <div class="col-3">
                    <div class="row">
                      <div class="col-4 pt-2 pr-0">Sort by:</div> 
                      <div class="col-8 p-0">
                        
                        <select class="custom-select shadow-sm search-sort">
                          <?php
                          $urlsort = !empty( $_GET['orderby'] ) ? $_GET['orderby'] : '';
                          ?>

                          <option value="date" <?php echo $urlsort == 'date' ? 'selected' : ''; ?>>Most recent</option>
                          <option value="title" <?php echo $urlsort == 'title' ? 'selected' : ''; ?>>Alphabetical</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div> <!-- end of row for search box and filter -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- end of masthead-bg -->
      

  <div class="page-content">
    <!-- <div class="pt-4 pb-5"> -->
<?php

    if($total_results >= 1){
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
    ?>
      <div class="container">
        <div class="row">
          <div class="flex-wrapper">

<?php
if ( have_posts() ) :
       while ( have_posts() ) : the_post();


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
            

    endwhile;
  endif;
  ?>
              
          </div>
          
        </div>
      </div>

      <?php
  } else {

      ?>
    <div class="pt-4 pb-5">

          <div class="container">
            <div class="no-results">
                <h2>Sorry, no results found.</h2>
              </div>
        </div>
    </div>
    <?php

  }
    ?>


    <!-- </div> -->
  </div> <!-- end of page-content -->
</div>
    
<?php get_footer(); ?>