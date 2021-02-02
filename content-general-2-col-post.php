<?php 
//Old 2-col template

get_header(); 
 ?>

<div class="stories detail-post">
      <div class="breadcrumb">

      	<?php

      	$cat = get_the_category(); 
          $catName = $cat[0]->name;
          $catID = $cat[0]->cat_ID;
          // echo $catName;

      	?>
        <ul class="menu"> 
          <li><a class="d-inline-block" href="<?php echo get_category_link($catID); ?>"><span class="back-arrow"></span>Back</a></li>
       </ul>
        

      </div>

      <div class="detail-post-container pb-5">
        <div class="container">
			<div class="row pt-3 pb-3">

			    <div class="d-block text-center title-content">
					<h1><?php the_title(); ?></h1>

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
						<a href="<?php echo esc_url($customLink_url); ?>" target="<?php echo esc_attr($customLink_target); ?>" title="<?php echo esc_html($customLink_title); ?>">

							<img src="<?php echo $get_author_image['url']; ?>" alt="<?php echo $get_author_image['alt']; ?>" class="author-image" />
						</a>
						<h5>Submitted by <?php echo $get_author_name; ?></h5>

						<?php
						elseif($get_author_image) :
						?>
						<img src="<?php echo $get_author_image['url']; ?>" alt="<?php echo $get_author_image['alt']; ?>" class="author-image" />
						<h5>Submitted by <?php echo $get_author_name; ?></h5>

						<?php else : ?>
							<h5>Submitted by <?php echo $get_author_name; ?></h5>
						<?php
						endif;
						?>
						
					</div>

					<?php
					endif;

					//check if time difference is 24hrs to show last updated on
						$u_time = get_the_time('U'); 
						$u_modified_time = get_the_modified_time('U'); 
						if ($u_modified_time >= $u_time + 86400) { 
							echo '<p class="last-updated">Last updated on '; 
							the_modified_time('j F Y');
							echo '</p> ';
						} else {
					?>
					<p class="last-updated">Last updated on <?php echo get_the_date('j F Y'); ?></p>
					<?php
						}
					?>
				</div>
			</div>
			<div class="row">
				<?php
			$get_leftCol = get_field('leftCol_group');
			if ($get_leftCol):
			?>
				<div class="col-4">
				  <div class="overview">
				    <h4><?php echo $get_leftCol['leftCol_title']; ?></h4>
				    <?php echo $get_leftCol['leftCol_content']; ?>

				  </div>
				</div>
				<?php
			endif;
			$get_rightCol = get_field('rightCol_group');
			if($get_rightCol):

				$get_repeater = $get_rightCol['rightCol_repeater'];

				if($get_repeater) :

			?>
				<div class="col-8">


						<?php
						foreach($get_repeater as $row)
						
						{
							$image = $row['rightCol_image'];
							$customLink = $row['rightCol_link'];
							$text = $row['rightCol_caption'];
							$text_desc = $row['rightCol_desc'];
							$customFile = $row['rightCol_file'];
						?>

						<div class="image-wrapper">

							<?php
							if($text){
							?>
							<div class="caption"><?php echo $text; ?></div>
							<?php
							}
							?>

							<?php
							if($image) {
							?>
							<div class="image-overlay-wrapper">
								<?php
								if($customLink) :


									$customLink_url = $customLink['url'];
									$customLink_title = $customLink['title'];
									$customLink_target = $customLink['target'] ? $customLink['target'] : '_self';
								?>
									<a href="<?php echo esc_url($customLink_url); ?>" target="<?php echo esc_attr($customLink_target); ?>" title="<?php echo $image['alt']; ?>">

								<?php
								
								elseif($customFile) :


									// $customFile_url = $customFile['url'];
									// $customFile_title = $customFile['filename'];
									// $customFile_target = $customFile['target'] ? $customFile['target'] : '_self';
								?>
									<a href="<?php echo esc_url($customFile); ?>" target="_blank" title="<?php echo $image['alt']; ?>">

									<?php
								else :
									?>
									<a href="<?php echo $image['url']; ?>" target="_blank" title="<?php echo $image['alt']; ?>">
									<?php
								endif;
									?>
									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
									<div class="overlay"></div>
								</a>
							</div>

							<?php
							}
							?>

							<?php
							if($text_desc){
							?>
							<div class="caption-text"><?php echo $text_desc; ?></div>
							<?php
							}
							?>

						</div>

						<?php
						}
						?>
						

					

				</div>
			<?php
			endif;
			endif;
			?>
			</div>
		</div>
	</div>

<?php
$get_more = get_field('view_all');

if ($get_more):

$get_tag = $get_more['view_tag'];
if($get_tag):
?>
<div class="">

	<div class="pt-3 pb-5">

		<div class="container">
			<div class="more-post">
				<div class="row">
				  <div class="col-6">
				    <h4><?php echo $get_more['title']; ?></h4>
				  </div>
				  <div class="col-6">
				    <div class="float-right"><a href="<?php echo $get_more['link']; ?>">See all <span class="see-all-arrow"></span></a></div>
				  </div>
				</div>
			</div>
			<div class="row">
				<div class="flex-wrapper">
					<?php

					$get_term = $get_tag->name;
					$get_termID = get_cat_ID($get_term);
					$args = array(
						'post_type'=> 'post',
						'tag' => $get_term,
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
			endif;
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
endif;
endif;
?>

</div>

<?php get_footer(); ?>