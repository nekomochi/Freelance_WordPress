<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta name="viewport" content="width=1400" />
    <meta charset="<?php bloginfo( 'charset' ); ?>" />

    <meta name="description" content="<?php if ( is_single() ) {
        single_post_title('', true); 
    } else {
        bloginfo('name'); echo " - "; bloginfo('description');
    }
    ?>" />
    <title><?php wp_title(); ?></title>

    <?php wp_head(); 
    ?>
  </head>
  <body>
    <div class="body-wrapper">
      <div class="container-fluid bg-white border-bottom shadow-sm text-uppercase hive-nav sticky-top">
        <div class="row">
          <div class="col">
            <a class="navbar-brand pt-0 pb-0" href="<?php echo site_url(); ?>">

              <img src="<?php header_image(); ?>" width="<?php echo absint( get_custom_header()->width ); ?>" height="<?php echo absint( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">

            </a>
          </div>
          <div class="col-8">

              <?php
              wp_nav_menu( array(
                  
                  'container'         => "div", // (string) Whether to wrap the ul, and what to wrap it with. Default 'div'.
                  'container_class'   => "float-right", // (string) Class that is applied to the container. Default 'menu-{menu slug}-container'.
              ) );
              ?>
          </div>
        </div>
      </div>