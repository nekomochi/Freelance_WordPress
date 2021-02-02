<?php 
/*
  * Template Name: Hive Pages
  */
get_header();

if(have_posts()):
	while(have_posts()):the_post();
			get_template_part('content-general', get_post_format());
		endwhile; endif;
		?>


      


<?php get_footer(); ?>