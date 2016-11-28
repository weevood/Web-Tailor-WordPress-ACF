<?php

define('G_MAIN_FIELD',          'layout');            // (String)   Name of main field
define('G_FLEX_FIELD',          'gallery');           // (String)   Name of flex field
define('G_SHOW_NAV_TOUCH',      FALSE);               // (Boolean)  Always show nav on touch devices
define('G_SHOW_IMAGE_NUMBER',   TRUE);                // (Boolean)  If false, the text below the caption will be hidden
define('G_ALBUM_LABEL',         'Image %1 sur %2');   // (String)   The text displayed below the caption
define('G_DISABLE_SCROLLING',   TRUE);                // (Boolean)  If true, prevent the page from scrolling
define('G_FADE_DURATION',       500);                 // (Number)   The time for the Lightbox to show up in ms
define('G_RESIZE_DURATION',     500);                 // (Number)   The time for the container to animate transition in ms
define('G_WRAP_AROUND',         FALSE);               // (Boolean)  If true, when a user reaches the last image the set start again

if( function_exists('get_sub_field') && have_rows(constant('G_MAIN_FIELD')) ):
  while( have_rows(constant('G_MAIN_FIELD')) ) : the_row();
    if( get_row_layout() === constant('G_FLEX_FIELD') ):
      $ID             = get_the_id();                                          // App\pre_print('$ID', $ID); 
      $images         = get_sub_field(constant('G_FLEX_FIELD').'_images');     // App\pre_print('$images', $images); 
      $show_lightbox  = get_sub_field(constant('G_FLEX_FIELD').'_lightbox');   // App\pre_print('$show_lightbox', $show_lightbox); 
      $show_title     = get_sub_field(constant('G_FLEX_FIELD').'_title');      // App\pre_print('$show_title', $show_title); 
      $show_caption   = get_sub_field(constant('G_FLEX_FIELD').'_caption');    // App\pre_print('$show_caption', $show_caption); 
      $col_lg         = get_sub_field(constant('G_FLEX_FIELD').'_col_lg');     // App\pre_print('$col_lg', $col_lg); 
      $col_md         = get_sub_field(constant('G_FLEX_FIELD').'_col_md');     // App\pre_print('$col_md', $col_md); 
      $col_xs         = get_sub_field(constant('G_FLEX_FIELD').'_col_xs');     // App\pre_print('$col_xs', $col_xs); 
      
      $size = '90x90';
      $col_xs == 4 || $col_md == 3 || $col_lg == 2 ? $size = '160x160' : '';
      $col_xs == 6 || $col_md == 4 || $col_lg == 3 ? $size = '255x255' : '';
      $col_lg == 4 ? $size = '350x350' : '';
      $col_lg == 6 ? $size = '510x510' : ''; // App\pre_print('$size',$size); ?> 

      <div id="gallery-<?php echo $ID ?>" class="gallery">
        <div class="row">
          
          <?php foreach( $images as $i => $image ):
                  $id       = $image['id'];                                  // App\pre_print('$id', $id);
                  $title    = $image['title'];                               // App\pre_print('$title', $title);
                  $caption  = $image['caption'];                             // App\pre_print('$caption', $caption);
                  $full     = $image['sizes']['1920x1080'];                  // App\pre_print('$full', $full);                   
                  $src      = $image['sizes'][$size];                        //  App\pre_print('$src', $src);
                  $width    = $image['sizes'][$size.'-width'];               // App\pre_print('$width', $width);
                  $height   = $image['sizes'][$size.'-height'];              // App\pre_print('$height', $height); 
                  
                  if( ($show_title && $title) && ($show_caption && $caption) ): $data_title = $title.' - '.$caption;
                  elseif( $show_title && $title ): $data_title = $title;
                  elseif( $show_caption && $caption ): $data_title = $caption;
                  else: $data_title = NULL;
                  endif; ?>
            
                  <div class="gallery-inner <?php echo 'col-lg-'.$col_lg.' col-md-'.$col_md.' col-xs-'.$col_xs ?>">
                    <a  id="<?php echo 'gallery-'.$ID.'-item-'.$i ?>" 
                        class="thumbnail" 
                        href="<?php echo( $show_lightbox ? $full : '#' ); ?>"
                        <?php echo( $show_lightbox ? ' data-lightbox="gallery-'.$ID.'"' : '' ); ?>
                        <?php echo( $show_lightbox && $data_title ? ' data-title="'.$data_title.'"' : '' ); ?>>
                      <img  src="<?php echo $src ?>"
                            srcset="<?php echo $srcset ?>" 
                            alt="<?php echo $title ?>" 
                            width="<?php echo $width ?>" 
                            height="<?php echo $height ?>"/>
                    </a>
                  </div><!-- /.gallery-inner -->
            
          <?php endforeach; ?>
          
        </div><!-- /.row -->
      </div><!-- /.gallery -->
      
      <?php if( $show_lightbox ): ?>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/css/lightbox.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/js/lightbox-plus-jquery.min.js"></script>
        <script>lightbox.option({'alwaysShowNavOnTouchDevices':'<?php echo constant('G_SHOW_NAV_TOUCH')?>','albumLabel':'<?php echo constant('G_ALBUM_LABEL')?>','disableScrolling':'<?php echo constant('G_DISABLE_SCROLLING')?>','fadeDuration':<?php echo constant('G_FADE_DURATION')?>,'resizeDuration':<?php echo constant('G_RESIZE_DURATION')?>,'showImageNumberLabel':'<?php echo constant('G_SHOW_IMAGE_NUMBER')?>','wrapAround':'<?php echo constant('G_WRAP_AROUND')?>'})</script>
      <?php endif; ?>
      
<?php 
    endif;
  endwhile;
else:
  return;
endif;
?>