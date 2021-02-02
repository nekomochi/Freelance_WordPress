<?php 
/*
* Template Name: Hive Contact
*/
get_header(); ?>


<?php

$get_contact = get_field('contact_top_section');
if($get_contact) :

  // $get_title = $get_contact['intro_title'];
  // $get_content = $get_contact['intro_text_content'];
  // $get_imageURL = $get_contact['intro_image'];
  $get_page_image = $get_contact['intro_bg_image'];
?>
<div class="contact-us" style="background: url('<?php if($get_page_image) : echo $get_page_image; else : echo get_bloginfo('template_directory'); ?>/images/bg-lighthex.jpg<?php endif; ?>') no-repeat top center; background-size:cover;">
<?php
else:
?>
<div class="contact-us" style="background: url('<?php echo get_bloginfo('template_directory'); ?>/images/bg-lighthex.jpg') no-repeat top center; background-size:cover;">
<?php
endif;
?>

  <div class="container">
    <?php

    $get_contact_navigation = get_field('contact_navigation_option');
    if($get_contact_navigation) :

      $get_contact_navi_option_1 = $get_contact_navigation['option_1'];
      $get_contact_navi_option_2 = $get_contact_navigation['option_2'];
      $get_contact_navi_option_3 = $get_contact_navigation['option_3'];
      if($get_contact_navi_option_1){
        $get_option_ID_1 = $get_contact_navi_option_1['option_id'];
        $get_option_image_1 = $get_contact_navi_option_1['option_image'];
        $get_option_title_1 = $get_contact_navi_option_1['option_title'];
        $get_option_desc_1 = $get_contact_navi_option_1['option_desc'];
      }
      if($get_contact_navi_option_2){
        $get_option_ID_2 = $get_contact_navi_option_2['option_id'];
        $get_option_image_2 = $get_contact_navi_option_2['option_image'];
        $get_option_title_2 = $get_contact_navi_option_2['option_title'];
        $get_option_desc_2 = $get_contact_navi_option_2['option_desc'];
      }
      if($get_contact_navi_option_3){
        $get_option_ID_3 = $get_contact_navi_option_3['option_id'];
        $get_option_image_3 = $get_contact_navi_option_3['option_image'];
        $get_option_title_3 = $get_contact_navi_option_3['option_title'];
        $get_option_desc_3 = $get_contact_navi_option_3['option_desc'];
      }
    ?>
    <div class="option-block navi">
      <div class="row">
        <div class="d-flex">
          <div class="col-4 flex">
            <div class="card">
              <?php if($get_option_ID_1){ ?>
              <a href="#<?php echo $get_option_ID_1; ?>">
              <?php } else { ?>
              <a href="#getintouch">
              <?php } ?>
                <?php if(!empty( $get_option_image_1 )){ ?>
                  <img src="<?php echo esc_url($get_option_image_1['url']); ?>" alt="<?php echo esc_attr($get_option_image_1['alt']); ?>">
                <?php } else { ?>
                  <img src="<?php echo get_bloginfo('template_directory'); ?>/images/icon-getintouch.png" alt="Get in touch">
                <?php } ?>
              </a>
              <div class="card-body">
                <?php if($get_option_title_1){ ?>
                  <h4 class="card-title"><?php echo $get_option_title_1; ?> </h4>
                <?php } else { ?>
                  <h4 class="card-title">Get in touch</h4>
                <?php } ?>
                <?php if($get_option_desc_1){ ?>
                  <?php echo $get_option_desc_1; ?>
                <?php } else { ?>
                  <p class="card-text">Keep calm and contact the HIVE team for anything you need.</p>
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="col-4 flex">
            <div class="card">
              <?php if($get_option_ID_2){ ?>
              <a href="#<?php echo $get_option_ID_2; ?>">
              <?php } else { ?>
              <a href="#howtosubmit">
              <?php } ?>
                <?php if(!empty( $get_option_image_2 )){ ?>
                  <img src="<?php echo esc_url($get_option_image_2['url']); ?>" alt="<?php echo esc_attr($get_option_image_2['alt']); ?>">
                <?php } else { ?>
                  <img src="<?php echo get_bloginfo('template_directory'); ?>/images/icon-howtosubmit.png" alt="How to submit">
                <?php } ?>
              </a>
              <div class="card-body">
                <?php if($get_option_title_2){ ?>
                  <h4 class="card-title"><?php echo $get_option_title_2; ?> </h4>
                <?php } else { ?>
                  <h4 class="card-title">How to submit</h4>
                <?php } ?>
                <?php if($get_option_desc_2){ ?>
                  <?php echo $get_option_desc_2; ?>
                <?php } else { ?>
                  <p class="card-text">Send us your content at team.hive@autodesk.com or via Slack #hive-hub</p>
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="col-4 flex">
            <div class="card">
              <?php if($get_option_ID_3){ ?>
              <a href="#<?php echo $get_option_ID_3; ?>">
              <?php } else { ?>
              <a href="#faqs">
              <?php } ?>
                <?php if(!empty( $get_option_image_3 )){ ?>
                  <img src="<?php echo esc_url($get_option_image_3['url']); ?>" alt="<?php echo esc_attr($get_option_image_3['alt']); ?>">
                <?php } else { ?>
                  <img src="<?php echo get_bloginfo('template_directory'); ?>/images/icon-faq.png" alt="FAQs">
                <?php } ?>
              </a>
              <div class="card-body">
                <?php if($get_option_title_3){ ?>
                  <h4 class="card-title"><?php echo $get_option_title_3; ?> </h4>
                <?php } else { ?>
                  <h4 class="card-title">FAQs</h4>
                <?php } ?>
                <?php if($get_option_desc_3){ ?>
                  <?php echo $get_option_desc_3; ?>
                <?php } else { ?>
                  <p class="card-text">Good things come to those who wait 1-2 weeks. Conditions apply*</p>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php if($get_option_ID_1){ ?>
    <div id="<?php echo $get_option_ID_1; ?>" class="option-block option-1">
    <?php } else { ?>
    <div id="getintouch" class="option-block option-1">
    <?php } ?>
      <div class="row">
        <div class="col-12">
          <?php
          $get_contact_section_1 = get_field('contact_section_1');
          if($get_contact_section_1) :
            $get_contact_section_title_1 = $get_contact_section_1['section_title'];
            $get_contact_section_desc_1 = $get_contact_section_1['section_desc'];
            $get_contact_section_block_1 = $get_contact_section_1['block_1'];
            $get_contact_section_block_2 = $get_contact_section_1['block_2'];
            $get_contact_section_block_3 = $get_contact_section_1['block_3'];
          ?>
          <div class="card">
            <div class="card-body">
              <?php if($get_contact_section_title_1){ ?>
                <h1 class="card-title"><?php echo $get_contact_section_title_1; ?> </h1>
              <?php } else { ?>
                <h1 class="card-title">What do you think of the HIVE?</h1>
              <?php } ?>

              <?php if($get_contact_section_desc_1){ ?>
                <h6><?php echo $get_contact_section_desc_1; ?> </h6>
              <?php } else { ?>
                <h6>Questions? Comments? Feedback? Get in touch via any of the following ways.</h6>
              <?php } ?>
              
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-4">
                  <?php if($get_contact_section_block_1){
                    $get_image = $get_contact_section_block_1['block_image'];
                    $get_title = $get_contact_section_block_1['block_title'];
                    $get_desc = $get_contact_section_block_1['block_desc'];
                  ?>
                    <div class="option-wrapper">
                      <div class="option-image">
                        <?php if(!empty( $get_image )){ ?>
                          <img src="<?php echo esc_url($get_image['url']); ?>" alt="<?php echo esc_attr($get_image['alt']); ?>">
                        <?php } else { ?>
                          <img src="<?php echo get_bloginfo('template_directory'); ?>/images/img-contact.png" alt="">
                        <?php } ?>
                      </div>
                      <?php if($get_title){ ?>
                        <h4 class="card-title"><?php echo $get_title; ?> </h4>
                      <?php } else { ?>
                        <h4 class="card-title">Contact</h4>
                      <?php } ?>
                      <?php if($get_desc){ ?>
                        <?php echo $get_desc; ?> 
                      <?php } else { ?>
                        <p class="card-text">Madhura Chavan<br>Sr. User Researcher, DCP-XD-RA team</p>
                      <?php } ?>
                    </div>
                    
                  <?php } ?>
                    
                </div>
                
                <div class="col-4">
                  <?php if($get_contact_section_block_2){
                    $get_image = $get_contact_section_block_2['block_image'];
                    $get_title = $get_contact_section_block_2['block_title'];
                    $get_desc = $get_contact_section_block_2['block_desc'];
                  ?>
                    <div class="option-wrapper">
                      <div class="option-image">
                        <?php if(!empty( $get_image )){ ?>
                          <img src="<?php echo esc_url($get_image['url']); ?>" alt="<?php echo esc_attr($get_image['alt']); ?>">
                        <?php } else { ?>
                          <img src="<?php echo get_bloginfo('template_directory'); ?>/images/img-email.png" alt="">
                        <?php } ?>
                      </div>
                      <?php if($get_title){ ?>
                        <h4 class="card-title"><?php echo $get_title; ?> </h4>
                      <?php } else { ?>
                        <h4 class="card-title">Email</h4>
                      <?php } ?>
                      <?php if($get_desc){ ?>
                        <?php echo $get_desc; ?> 
                      <?php } else { ?>
                        <p class="card-text">Hivehub@Autodesk.com</p>
                      <?php } ?>
                    </div>
                    
                  <?php } ?>
                    
                </div>
                
                <div class="col-4">
                  <?php if($get_contact_section_block_3){
                    $get_image = $get_contact_section_block_3['block_image'];
                    $get_title = $get_contact_section_block_3['block_title'];
                    $get_desc = $get_contact_section_block_3['block_desc'];
                  ?>
                    <div class="option-wrapper">
                      <div class="option-image">
                        <?php if(!empty( $get_image )){ ?>
                          <img src="<?php echo esc_url($get_image['url']); ?>" alt="<?php echo esc_attr($get_image['alt']); ?>">
                        <?php } else { ?>
                          <img src="<?php echo get_bloginfo('template_directory'); ?>/images/img-slack.png" alt="">
                        <?php } ?>
                      </div>
                      <?php if($get_title){ ?>
                        <h4 class="card-title"><?php echo $get_title; ?> </h4>
                      <?php } else { ?>
                        <h4 class="card-title">Slack</h4>
                      <?php } ?>
                      <?php if($get_desc){ ?>
                        <?php echo $get_desc; ?> 
                      <?php } else { ?>
                        <p class="card-text">#Hive-hub</p>
                      <?php } ?>
                    </div>
                    
                  <?php } ?>
                    
                </div>
              </div>
            </div>
          </div>

          <?php
          endif; //get_contact_section_1
          ?>
        </div>
      </div>
    </div>

    <?php if($get_option_ID_2){ ?>
    <div id="<?php echo $get_option_ID_2; ?>" class="option-block option-2">
    <?php } else { ?>
    <div id="howtosubmit" class="option-block option-2">
    <?php } ?>
      <?php
        // $get_contact_section_2 = get_field('contact_section_2');

        // Check value exists.
        if( have_rows('contact_section_2') ):

            // Loop through rows.
            while ( have_rows('contact_section_2') ) : the_row();

              // Case: Right image layout.
              if( get_row_layout() == 'image_on_the_right' ):
                  $text = get_sub_field('section_desc');
                  $image = get_sub_field('section_image_right');
                  $btn = get_sub_field('section_btn');

      ?>

      <div class="row">
        <div class="col-7 flex">
          <div class="option-center">

            <?php echo $text; ?>

            <?php

              if( $btn ){

                $customLink_url = $btn['url'];
                $customLink_title = $btn['title'];
                $customLink_target = $btn['target'] ? $btn['target'] : '_self';
              
              ?>
              <a href="<?php echo esc_url($customLink_url); ?>" target="<?php echo esc_attr($customLink_target); ?>" class="btn mt-2"><?php echo esc_html($customLink_title); ?></a>
              <?php } //end of $btn ?>

          </div>
        </div>
        <div class="col-5 flex">
          <?php if(!empty( $image )){
            $img = wp_get_attachment_image_src($image);
            $alt_text = get_post_meta($image, '_wp_attachment_image_alt', true);
            ?>
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($alt_text); ?>">
          <?php } else { ?>
            <img src="<?php echo get_bloginfo('template_directory'); ?>/images/icon-hive.png" alt="">
          <?php } ?>
        </div>
      </div>
      <?php 
      endif; //end of image_on_the_right

              if( get_row_layout() == 'embedded_form' ):
                $text = get_sub_field('section_desc'); 
      ?>
      <div class="row pt-5">
        <div class="col-12 flex">
          <div class="w-100">
            <?php echo $text; ?>
          </div>
        </div>
      </div>
      <?php
              endif; //end of embedded_form
      ?>
      <?php
              // Case: Left image layout.
              if( get_row_layout() == 'image_on_the_left' ): 
                  $text = get_sub_field('section_desc');
                  $image = get_sub_field('section_image_left');
                  $btn = get_sub_field('section_btn');
                  // Do something...
      ?>
      <div class="row pt-5">
      
        <div class="col-6 flex">
          <?php if(!empty( $image )){
            $img = wp_get_attachment_image_src($image);
            $alt_text = get_post_meta($image, '_wp_attachment_image_alt', true);
          ?>
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($alt_text); ?>">
          <?php } else { ?>
            <img src="<?php echo get_bloginfo('template_directory'); ?>/images/img-example.png" alt="">
          <?php } ?>
        
        </div>
        <div class="col-6 flex">
          <div class="option-list">
            <?php echo $text; ?>
          

            <?php

              if( $btn ){

                $customLink_url = $btn['url'];
                $customLink_title = $btn['title'];
                $customLink_target = $btn['target'] ? $btn['target'] : '_self';
              
              ?>

              <a href="<?php echo esc_url($customLink_url); ?>" target="<?php echo esc_attr($customLink_target); ?>" class="btn mt-2"><?php echo esc_html($customLink_title); ?></a>
              <?php } //end of $btn ?>
          </div>
        </div>
      </div>
      
      <?php
              endif; //end of image_on_the_left

          // End loop.
          endwhile;

        // end of have_rows
        endif;

      ?>
        
      
    </div> <!-- end of option 2 -->

    <?php if($get_option_ID_3){ ?>
    <div id="<?php echo $get_option_ID_3; ?>" class="option-block option-3">
    <?php } else { ?>
    <div id="faqs" class="option-block option-3">
    <?php } ?>
      <div class="row">
        <?php
        $get_contact_section_3 = get_field('contact_section_3');
          if($get_contact_section_3) :

            $get_contact_section_content = $get_contact_section_3['section_content'];
        ?>
        <div class="col-12">
          <?php echo $get_contact_section_content; ?>
        </div>
        <?php
        endif; //end of get_contact_section_3
        ?>
      </div>
    </div>


    <?php
    endif; //get_contact_navigation
    ?>


  </div>
</div>
<?php get_footer(); ?>