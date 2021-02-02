  

  <footer class="pt-3 pb-3 bg-white">
    <div class="container-fluid">
    <div class="row">
      <div class="col">
        <?php

        $get_footer_image = get_field('bottom_footer_image');
        if ($get_footer_image){
        ?>
       <img src="<?php echo $get_footer_image; ?>" alt="Autodesk">
        <?php
      } else {
        ?>

        <img src="<?php echo get_bloginfo('template_directory'); ?>/images/logo-autodesk.png" alt="Autodesk">
        <?php
      }
        ?>
      </div>
      </div>
    </div>
  </footer>
    <?php wp_footer(); ?>
  </div> <!-- end of body-wrapper -->
  </body>
</html>