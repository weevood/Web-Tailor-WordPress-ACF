<?php

define('MAIN_FIELD', 'medias');     // Name of main field
define('FLEX_FIELD', 'carousel');   // Name of flex field
define('INTERVAL',   '10000');      // Delay between automatically cycling in ms
define('PAUSE',      'hover');      // Pauses the cycling on mouse over ('hover') or not (NULL)
define('WRAP',       'true');       // Cycle continuously ('true') or have hard stops ('false')
define('KEYBOARD',   'false');      // React to keyboard events ('true') or not ('false')

if( function_exists('get_sub_field') && have_rows(constant('MAIN_FIELD')) ):
  while ( have_rows(constant('MAIN_FIELD')) ) : the_row();
    if( get_row_layout() === constant('FLEX_FIELD') ):
      $id               = get_the_id();                                        // App\pre_print($id);
      $images           = get_sub_field(constant('FLEX_FIELD').'_images');     // App\pre_print($images);
      $size             = get_sub_field(constant('FLEX_FIELD').'_size');       // App\pre_print($size);
      $show_title       = get_sub_field(constant('FLEX_FIELD').'_title');      // App\pre_print($show_title);
      $show_caption     = get_sub_field(constant('FLEX_FIELD').'_caption');    // App\pre_print($show_caption);
      $show_controls    = get_sub_field(constant('FLEX_FIELD').'_controls');   // App\pre_print($show_controls);
      $show_indicators  = get_sub_field(constant('FLEX_FIELD').'_indicators'); // App\pre_print($show_indicators); ?>

      <div  id="carousel-<?php echo $id ?>" 
            class="carousel slide" 
            data-ride="carousel" 
            data-interval="<?php echo constant('INTERVAL'); ?>" 
            data-pause="<?php echo constant('PAUSE'); ?>"
            data-wrap="<?php echo constant('WRAP'); ?>"
            data-keyboard="<?php echo constant('KEYBOARD'); ?>">

        <div class="carousel-inner" role="listbox">
          <?php foreach( $images as $i => $image ):
                $title    = $image['title'];
                $caption  = $image['caption'];
                $src      = $image['sizes'][$size];
                $srcset   = wp_get_attachment_image_srcset( $image['id'], $size );
                $width    = $image['sizes'][$size.'-width'];
                $height   = $image['sizes'][$size.'-height']; ?>

          <div id="<?php echo 'carousel-'.$id.'-item-'.$i ?>" class="carousel-item<?php echo ($i == 0 ? ' active' : ''); ?>">
            <img  src="<?php echo $src ?>" 
                  srcset="<?php echo $srcset ?>" 
                  alt="<?php echo $title ?>" 
                  width="<?php echo $width ?>" 
                  height="<?php echo $height ?>"/>

            <?php if( $show_title || $show_caption ): ?>
              <div class="carousel-caption">
                <?php if( $show_title && $title ): ?><h3><?php echo $title; ?></h3><?php endif; ?>
                <?php if( $show_caption && $caption ): ?><p><?php echo $caption; ?></p><?php endif; ?>
              </div>
            <?php endif; ?>

          </div><!-- /.carousel-item -->

          <?php endforeach; ?>
        </div><!-- /.carousel-inner -->

        <?php if( count($images) > 1 ): ?>

          <?php if( $show_controls ): ?>
            <a class="carousel-control left" href="#carousel-<?php echo $id ?>" role="button" data-slide="prev"><span class="icon-prev"></span></a>
            <a class="carousel-control right" href="#carousel-<?php echo $id ?>" role="button" data-slide="next"><span class="icon-next"></span></a>
          <?php endif; ?>

          <?php if( $show_indicators ): ?>
            <ol class="carousel-indicators">
              <?php foreach( $images as $i => $image ): ?>
                <li data-target="#carousel-<?php echo $id ?>" data-slide-to="<?php echo $i ?>" class="<?php echo ($i == 0 ? ' active' : ''); ?>"></li>
              <?php endforeach; ?>
            </ol>
          <?php endif; ?>

        <?php endif; ?>

      </div><!-- /.carousel -->

<?php 
    endif;
  endwhile;
else:
  return;
endif;
?>