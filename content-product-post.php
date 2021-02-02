<?php
$get_product = get_field('product_content');
if($get_product) :

	$get_image = $get_product['image_field'];
  if($get_image) {
  	
    pilau_add_image_for_preloading($get_image);
  }
endif;
?>
<?php 
/* Template Name: Post Product
* Template Post Type: post
*/ 
get_header();


$cta_card_text = get_field('get_cta_card_text','option');
$cta_rel_text = get_field('get_cta_rel_text','option');
$cta_rel_title = get_field('get_cta_rel_title','option');

$catcol_rows = get_field('get_catcolours','option');
$store_catcol = array();
if($catcol_rows){
  foreach($catcol_rows as $row){
  	$store_catcol[$row['select_category']->term_id] = $row['category_colour'];
  }
}

$postid = $post->ID;
 ?>

<div class="detail-post">

<?php
$get_product = get_field('product_content');
if($get_product) :

	$get_tag = $get_product['tag_field'];
	$get_desc = $get_product['desc_field'];
	$get_related_title = $get_product['related_title'];
	$get_related_list = $get_product['related_list'];
	$get_image = $get_product['image_field'];
?>
<div class="detail-post-background pb-5" style="background: url('<?php if($get_image) : echo $get_image; else : echo get_bloginfo('template_directory'); ?>/images/Product-Masthead-banner.jpg<?php endif; ?>') no-repeat; background-size:cover;">
      

      <div class="breadcrumb">
		<div class="container">

			<?php

			$cat = get_the_category();
		    $catName = $cat[0]->name;
		    $catID = $cat[0]->cat_ID;
		    // echo $catName;

			?>
		  <ul class="menu"> 
		    <li><a class="d-inline-block" href="<?php echo get_category_link($catID); ?>"><?php echo $catName; ?></a><span class="back-arrow"></span><?php the_title(); ?></li>
		 </ul>
		  

		</div>
	</div>

	<div class="detail-post-container pt-2">
	  <div class="container">
	    <div class="product-container">
	      <div class="product-content">
	            

	        <div class="d-inline-block">
	        	<div class="col-12">
    	          <h6 <?php if(array_key_exists($catID, $store_catcol)){ echo 'style="color:'.$store_catcol[$catID].'"'; }?>><?php echo $catName; ?></h6>
    	          <h1><?php the_title(); ?></h1>
    	          <div class="row">
    	            <div class="col-11">
    	              <p><?php echo $get_desc; ?></p>
    	            </div>
    	            
    	          </div>
    	          <div class="">
    	          	<?php
    	          	$customLink = $get_product['link_field'];
    
    	            if( $customLink ): 
    
    	              $customLink_url = $customLink['url'];
    	              $customLink_title = $customLink['title'];
    	              $customLink_target = $customLink['target'] ? $customLink['target'] : '_self';
    	          	?>
    	          	<a href="<?php echo esc_url($customLink_url); ?>" target="<?php echo esc_attr($customLink_target); ?>" class="link"><?php echo esc_html($customLink_title); ?></a>
    	              <?php
    	          endif;
    	              ?>
    	          </div>
    	        </div>
    	    </div>
	      </div>
	    </div>

	  </div>
	</div>
</div>
<?php
endif;
?>

<?php
$get_more = get_field('view_all_product');

$get_displaymoreposts = $get_more['displaymoreposts'];
if ($get_more):

	$get_term = get_the_tags($postid);
	$get_term_array = array();
	$get_more_title = $cta_rel_title;
	$get_more_link_text = $cta_rel_text;
	$get_more_link = get_category_link($catID);


	if($get_displaymoreposts && $get_displaymoreposts == 'yes'){

		$get_tag = $get_more['view_tag'];
		if($get_tag):
			$get_term = $get_tag;

		endif;

		$link = $get_more['link'];
		if( $link ): 
		    $get_more_link = $link['url'];
		    $get_more_link_text = $link['title'];
		    $link_target = $link['target'] ? $link['target'] : '_self';
		endif;
		$get_more_title = $get_more['title'];
		// $get_more_link = $get_more['link'];
		

	} //end if get_displaymoreposts

	foreach ( $get_term as $tag ) {
		$get_term_array[] = $tag->term_id;
		// echo $tag->name;
		// echo '<br>';
		// echo $tag->term_id;
		// echo '<br>';
	}

	// print_r($get_term_array);
?>
<div class="pb-4 bg-grey">
	<div class="container">
			<div class="more-post">
				<div class="row">
				  <div class="col-6">
				    <h4><?php echo $get_more_title; ?></h4>
				  </div>
				  <div class="col-6">
				    <div class="float-right see-all"><a href="<?php echo $get_more_link; ?>"><?php echo $get_more_link_text; ?> <span class="link-arrow d-inline-block ml-2"></span></a></div>
				  </div>
				</div>
			</div>
			<div class="row">
				<div class="flex-wrapper">
					<?php

					// $get_termID = get_cat_ID($get_term);
					$args = array(
						'post_type'=> 'post',
						'tag__in' => $get_term_array,
						'cat' => $catID,
						'orderby'    => 'date',
						'post_status' => 'publish',
						'order'    => 'DESC',
						'post__not_in' => array( $post->ID ),
						'posts_per_page' => 4 // this will retrive all the post that is published 
					);
					$result = new WP_Query( $args );


					if ( $result-> have_posts() ) :
					?>
					<?php while ( $result->have_posts() ) : $result->the_post();


			$article_link = get_field('custom_ba_url');
			$article_desc = get_field('custom_ba_desc');

			$get_author = get_field('author_group');
			$get_author_name = $get_author['author_name'];

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
</div>
<?php 

endif; //end get_more
?>



</div>

<?php get_footer(); ?>