<?php

// if(!(is_front_page()) && is_page())
$cat = get_the_category();
$categories = array();
foreach($cat as $category){
	$categories[] = $category->cat_ID;
}


?>
<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <!-- <a href="#" type="submit" id="searchsubmit" class="search-icon"></a> -->
  <a class="search-icon"></a>
  <button type="submit" id="searchsubmit" class="btn"></button>
  <a class="search-cancel-icon"></a>
  <?php if(!(is_front_page()) && is_page()): ?>
  <input type="hidden" name="cat" id="cat" value="<?php echo implode(',',$categories); ?>" />
	<?php endif; ?>
  <?php if ( is_front_page() ) {

          $get_search = get_field('search_section');
          if ($get_search):
      
          $get_search_placeholder = $get_search['intro_search'];
      
  ?>
  <input type="text" class="form-control search-box" placeholder="<?php echo $get_search_placeholder; ?>" name="s" id="s" value="<?php the_search_query(); ?>">
<?php
endif;
} else if (is_search()) {
?>

<input type="text" class="form-control search-box" placeholder="" name="s" id="s" value="<?php the_search_query(); ?>">

<?php
} else { 

$get_search_placeholder = get_field('search_banner_placeholder','option');
?>

  <input type="text" class="form-control search-box" placeholder="<?php echo $get_search_placeholder; ?>" name="s" id="s" value="<?php the_search_query(); ?>">
  <!-- <input type="hidden" class="submit" name="submit" id="searchsubmit" /> -->
<?php } ?>
</form>
