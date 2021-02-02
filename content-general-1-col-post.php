<?php 
/* Template Name: Post Stories, Research-Ops, Toolkit
* Template Post Type: post
*/ 

// not in use as front-facing template, please see Single.php
get_header();
$get_post_bg = get_field('detail_post_bg_image');
if ($get_post_bg){

  pilau_add_image_for_preloading($get_post_bg);
} else {
  pilau_add_image_for_preloading(get_bloginfo('template_directory').'/images/insights-masthead.jpg');
}


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
$get_displayshowtags = get_field('displayshowtags');
 ?>

<div class="detail-post">

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


	<div class="masthead-bg" style="background: url('<?php if($get_post_bg) : echo $get_post_bg; else : echo get_bloginfo('template_directory'); ?>/images/insights-masthead.jpg<?php endif; ?>') no-repeat top left;">
      

      <div class="detail-post-container pb-5">
      	<div class="container">
      		<div class="center-box">
      			<div class="center-box-inner bg-white">

				    <div class="d-block title-content">
						<h1><?php the_title(); ?></h1>
						<!-- 239characters -->
						<?php

						$get_post_bg_text = get_field('detail_post_bg_text');
						if($get_post_bg_text):
							echo '<p>'.$get_post_bg_text.'</p>';
						endif;

						?>
						<?php

						$get_post_tags = get_the_tags($postid);
						if($get_displayshowtags && $get_displayshowtags == 'yes') {
							// if($get_displayshowtags == 'yes') {
								$get_showtags = get_field('showtags');
								if($get_showtags) {
									$get_post_tags = $get_showtags;

         //              					foreach ( $get_post_tags as $tag ) {
         //              						echo $tag->name;
         //              					}
									// echo 'show';
								}

							// }
						}

							
						
						?>
						<div class="tag-list">
                      		<span class="pr-2">
                      			<?php
                      			foreach ( $get_post_tags as $tag ) {

                      			?>
                      			<a href="<?php echo get_category_link($catID).'?tag='.$tag->slug;?>"><?php echo $tag->name; ?></a>
                      			<?php
								}

                      			?>
                      			
                      		</span>
                      	</div>
						<?php

						$get_author = get_field('author_group');

						if($get_author) :
							$get_author_name = $get_author['author_name'];
							$get_author_image = $get_author['author_image'];
							$get_author_image_url = $get_author['author_image_url'];
						?>
						<div class="author-wrapper">
							<?php
							if($get_author_image_url):
								$customLink_url = $get_author_image_url['url'];
								$customLink_title = $get_author_image_url['title'];
								$customLink_target = $get_author_image_url['target'] ? $get_author_image_url['target'] : '_self';
							?>
							<!-- if author has URL -->
							<div class="media position-relative">
								<div class="bd-placeholder-img author-image">
									<a href="<?php echo esc_url($customLink_url); ?>" target="<?php echo esc_attr($customLink_target); ?>" title="<?php echo esc_html($customLink_title); ?>">

										<img src="<?php echo $get_author_image['url']; ?>" alt="<?php echo $get_author_image['alt']; ?>" />
									</a>
								</div>

							  <div class="media-body">
							    
							    <p>Submitted by <?php echo $get_author_name; ?></p>
								

								<?php
								
								//check if time difference is 24hrs to show last updated on
									$u_time = get_the_time('U'); 
									$u_modified_time = get_the_modified_time('U'); 
									if ($u_modified_time >= $u_time + 86400) { 
										echo '<p>Last updated on '; 
										the_modified_time('j F Y');
										echo '</p> ';
									} else {
								?>
								<!-- <p class="last-updated">Last updated on <?php echo get_the_date('j F Y'); ?></p> -->
								<?php
									}
								?>
							  </div>
							</div>
							

							<?php
							elseif($get_author_image) :
							?>
							<div class="media position-relative">
								<div class="bd-placeholder-img author-image">
									<img src="<?php echo $get_author_image['url']; ?>" alt="<?php echo $get_author_image['alt']; ?>" class="author-image" />
								</div>

							  <div class="media-body">
							    
							    <p>Submitted by <?php echo $get_author_name; ?></p>
								

								<?php
								
								//check if time difference is 24hrs to show last updated on
									$u_time = get_the_time('U'); 
									$u_modified_time = get_the_modified_time('U'); 
									if ($u_modified_time >= $u_time + 86400) { 
										echo '<p>Last updated on '; 
										the_modified_time('j F Y');
										echo '</p> ';
									} else {
								?>
								<!-- <p class="last-updated">Last updated on <?php echo get_the_date('j F Y'); ?></p> -->
								<?php
									}
								?>
							  </div>
							</div>
							
							
							<?php else : ?>
								<p>Submitted by <?php echo $get_author_name; ?></p>
							<?php
							endif;
							?>
							
						</div>

						<?php

						else:

							//check if time difference is 24hrs to show last updated on
							$u_time = get_the_time('U'); 
							$u_modified_time = get_the_modified_time('U'); 
							if ($u_modified_time >= $u_time + 86400) { 
								echo '<p class="last-updated">Last updated on '; 
								the_modified_time('j F Y');
								echo '</p> ';
							} else {
						?>
						<p>Last updated on <?php echo get_the_date('j F Y'); ?></p>
						<?php
							}
						endif; // end author
						?>
					</div>
				</div>
      		</div>
      	</div>
        

	</div>

</div>
<!-- masthead -->
<div class="detail-post-container post-content">
	<div class="container">
		<div class="container-inner">
			<div class="row">

				<div class="col-12 text-content">
				<?php
			$get_leftCol = get_field('leftCol_group');
			$get_leftCol_content = $get_leftCol['leftCol_content'];
			$get_leftCol_team = $get_leftCol['leftCol_team'];
			if ($get_leftCol):
			?>
				  <div class="">
				  	<?php if($get_leftCol_content): ?>
					    <?php echo $get_leftCol_content; ?>
					<?php endif; ?>
					<?php if($get_leftCol_team): ?>
					    <?php echo $get_leftCol_team; ?>
					<?php endif; ?>
				  </div>
				
				<?php
			endif;
			$get_rightCol = get_field('rightCol_group');
			if($get_rightCol):

				$get_repeater = $get_rightCol['rightCol_repeater'];

				if($get_repeater) :

			?>
				
						<?php
						foreach($get_repeater as $row)
						
						{
							$image = $row['rightCol_image'];
							$customLink = $row['rightCol_link'];
							$text = $row['rightCol_caption'];
							$text_desc = $row['rightCol_desc'];
							$customFile = $row['rightCol_file'];

							$text_content = $row['text_content'];

							$radiobtn = $row['link_file'];
						?>

						<div class="image-wrapper">

							<?php
							if($image) {
							?>
							<div class="image-overlay-wrapper">
								<?php
								if($radiobtn) {
								if($radiobtn == 'link') {
									if($customLink) {

										$customLink_url = $customLink['url'];
										$customLink_title = $customLink['title'];
										$customLink_target = $customLink['target'] ? $customLink['target'] : '_self';
									?>
										<a href="<?php echo esc_url($customLink_url); ?>" target="<?php echo esc_attr($customLink_target); ?>" title="<?php echo $image['alt']; ?>"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
										<div class="overlay"></div>
									</a>

									<?php
									}
								}
								if($radiobtn == 'file') {
									if($customFile) {

									?>
										<a href="<?php echo esc_url($customFile); ?>" target="_blank" title="<?php echo $image['alt']; ?>"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
											<div class="overlay"></div>
										</a>

									<?php
									}
								}
							}else{

									?>
									<a href="<?php echo $image['url']; ?>" target="_blank" title="<?php echo $image['alt']; ?>"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
									<div class="overlay"></div>
								</a>
									<?php
								}
									?>
									
							</div>

							<?php
							}
							?>

							<?php
							if($text){
							?>
							<div class="caption text-center"><?php echo $text; ?></div>
							<?php
							}
							?>
							<?php
							if($text_desc){
							?>
							<div class="caption-text text-center"><?php echo $text_desc; ?></div>
							<?php
							}
							?>
							<?php
							if($text_content){
							?>
							<div class="pt-3"><?php echo $text_content; ?></div>
							<?php
							}
							?>
							
							

						</div>

						<?php
						}
						?>
							
				<?php
				endif;
				endif;
				?>
				</div>


			</div>
		</div>
	</div>
</div> <!-- end of post-content -->
<?php
$get_more = get_field('view_all');

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