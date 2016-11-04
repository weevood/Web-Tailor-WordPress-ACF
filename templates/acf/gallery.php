<?php

if( function_exists('get_sub_field') && have_rows('medias') ):
  while ( have_rows('medias') ) : the_row();
    if( get_row_layout() === 'gallery' ):
      $id = get_the_id();
      // App\pre_print($id);
      $images = get_sub_field('gallery_images');
      // App\pre_print($images);
?>

  <div id="gallery-<?php echo $id ?>" class="gallery">

    <div class="row">
      <?php foreach ($images as $i => $image): ?>
        <div class="col-lg-3 col-md-4 col-xs-6">
          <a 
            id="<?php echo 'gallery-'.$id.'-item-'.$i ?>" 
            class="thumbnail" 
            href="<?php echo $image['sizes']['1920x1080'] ?>" 
            data-lightbox="gallery-<?php echo $id ?>"
            data-title="<?php echo $image['title'] ?>">
            <img 
              src="<?php echo $image['sizes']['510x510'] ?>" 
              alt="<?php echo $image['title'] ?>" 
              width="<?php echo $image['sizes']['510x510-width'] ?>" 
              height="<?php echo $image['sizes']['510x510-height'] ?>"/>
          </a>
        </div>
      <?php endforeach; ?>
    </div><!-- /.carousel-inner -->

  </div><!-- /.gallery -->
  
<?php 
    endif;
  endwhile;
else:
  return;
endif;
?>