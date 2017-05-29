<style>.masonry .row{padding:10px}.masonry .masonry-inner{margin-bottom:10px;padding:0 5px}.masonry .thumbnail{border:0;border-radius:0;height:100%;background-position:center center;background-repeat:no-repeat;background-size:cover;opacity:.95}.masonry .thumbnail:hover{opacity:1}.masonry .row-1{height:140px}.masonry .row-2{height:290px}.masonry .masonry-inner .date,.masonry .masonry-inner .title{margin:0;position:absolute;padding:5px;color:#EEE;background-color:rgba(0,0,0,.8)}.masonry .masonry-inner .date{top:0;right:5px}.masonry .masonry-inner .title{bottom:0;right:5px;left:5px}</style>
<?php

define('MASONRY_MAIN_FIELD',          'layout');            // (String) Name of main field
define('MASONRY_FLEX_FIELD',          'masonry');           // (String) Name of flex field
define('MASONRY_SHOW_NAV_TOUCH',      FALSE);               // (Boolean)  Always show nav on touch devices
define('MASONRY_SHOW_IMAGE_NUMBER',   TRUE);                // (Boolean)  If false, the text below the caption will be hidden
define('MASONRY_ALBUM_LABEL',         'Image %1 sur %2');   // (String)   The text displayed below the caption
define('MASONRY_DISABLE_SCROLLING',   TRUE);                // (Boolean)  If true, prevent the page from scrolling
define('MASONRY_FADE_DURATION',       500);                 // (Number)   The time for the Lightbox to show up in ms
define('MASONRY_RESIZE_DURATION',     500);                 // (Number)   The time for the container to animate transition in ms
define('MASONRY_WRAP_AROUND',         FALSE);               // (Boolean)  If true, when a user reaches the last image the set start again

if( function_exists('get_sub_field') && have_rows(constant('MASONRY_MAIN_FIELD')) ):

  function get_masonry_size( $i, $count ) {
    $isLast = ($i === $count - 1);
    switch( $i % 16 ):
      case 0: case 10: return $isLast ? [12,2] : [8,2];
      case 1: case 11: return $isLast ? [4,2] : [4,1];
      case 2: case 6: case 12: return [4,1];
      case 3: return $isLast ? [12,2] : [4,2];
      case 4: return $isLast ? [8,2] : [8,1];
      case 5: return $isLast ? [8,1] : [4,1];
      case 7: case 15: return [12,1];
      case 8: return $isLast ? [12,1] : [4,1];
      case 9: return [8,1];
      case 13: return $isLast ? [12,1] : [4,2];
      case 14: return [8,2];
    endswitch;
  }

  while( have_rows(constant('MASONRY_MAIN_FIELD')) ) : the_row();
    if( get_row_layout() === constant('MASONRY_FLEX_FIELD') ):
      $ID               = get_the_id();                                                 // App\pre_print('$ID', $ID); 
      $images           = get_sub_field(constant('MASONRY_FLEX_FIELD').'_images');      //App\pre_print('$images', $images);
      $show_lightbox    = get_sub_field(constant('MASONRY_FLEX_FIELD').'_lightbox');    // App\pre_print('$show_lightbox', $show_lightbox); 
      $show_title       = get_sub_field(constant('MASONRY_FLEX_FIELD').'_title');       // App\pre_print('$show_title', $show_title); 
      $show_caption     = get_sub_field(constant('MASONRY_FLEX_FIELD').'_caption');     // App\pre_print('$show_caption', $show_caption); 
      $nb_images        = count($images);                                               // App\pre_print('$nb_images', $nb_images); ?> 
      
      <div id="masonry-<?php echo $ID ?>" class="masonry">
        <div class="row">
          
          <?php foreach( $images as $i => $image ):
                  $id         = $image['id'];                           // App\pre_print('$id', $id);
                  $title      = $image['title'];                        // App\pre_print('$title', $title);
                  $caption    = $image['caption'];                      // App\pre_print('$caption', $caption);
                  $width      = get_masonry_size($i, $nb_images)[0];    // App\pre_print('$width', $width);
                  $height     = get_masonry_size($i, $nb_images)[1];    // App\pre_print('$height', $height); 
                  $full       = $image['sizes']['1920x1080'];           // App\pre_print('$full', $full);                   
                  $src        = $image['sizes']['col-'.$width];         // App\pre_print('$src', $src);
                  
                  if( ($show_title && $title) && ($show_caption && $caption) ): $data_title = $title.' - '.$caption;
                  elseif( $show_title && $title ): $data_title = $title;
                  elseif( $show_caption && $caption ): $data_title = $caption;
                  else: $data_title = NULL;
                  endif; ?>
                  
                  <div class="masonry-inner col-sm-<?php echo $width ?> row-<?php echo $height ?>">
                    <a  id="<?php echo 'masonry-'.$ID.'-item-'.$i ?>" 
                        class="thumbnail" 
                        href="<?php echo( $show_lightbox ? $full : '#' ); ?>"
                        style="background-image: url(<?php echo $src ?>);"
                        <?php echo( $show_lightbox ? ' data-lightbox="masonry-'.$ID.'"' : '' ); ?>
                        <?php echo( $show_lightbox && $data_title ? ' data-title="'.$data_title.'"' : '' ); ?>>
                    </a>
                  </div><!-- /.masonry-inner -->
 
          <?php endforeach; ?>
          
        </div><!-- /.row -->
      </div><!-- /.masonry -->
      
      <?php if( $show_lightbox ): ?>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/css/lightbox.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/js/lightbox-plus-jquery.min.js"></script>
        <script>lightbox.option({'alwaysShowNavOnTouchDevices':'<?php echo constant('MASONRY_SHOW_NAV_TOUCH')?>','albumLabel':'<?php echo constant('MASONRY_ALBUM_LABEL')?>','disableScrolling':'<?php echo constant('MASONRY_DISABLE_SCROLLING')?>','fadeDuration':<?php echo constant('MASONRY_FADE_DURATION')?>,'resizeDuration':<?php echo constant('MASONRY_RESIZE_DURATION')?>,'showImageNumberLabel':'<?php echo constant('MASONRY_SHOW_IMAGE_NUMBER')?>','wrapAround':'<?php echo constant('MASONRY_WRAP_AROUND')?>'})</script>
      <?php endif; ?>
      
<?php 
    endif;
  endwhile;
else:
  return;
endif;
?>