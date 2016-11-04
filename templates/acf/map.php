<?php

if( function_exists('get_field') && $map = get_field('map') ):
  $id = get_the_id();
  // App\pre_print($id);
  // App\pre_print($map);
?>

  <div id="map-<?php echo $id ?>" class="acf-map hidden-xs">
		<div class="marker" data-lat="<?php echo $map['lat']; ?>" data-lng="<?php echo $map['lng']; ?>"></div>
	</div>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0x4svfKCtZu-UygFHO-KrmLgvVyf04is"></script>
  
<?php
else:
  return;
endif;
?>