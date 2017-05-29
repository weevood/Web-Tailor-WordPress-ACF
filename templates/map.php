<?php

define('MAP_MAIN_FIELD',          'map');   // (String)   Name of main field
define('MAP_DISABLE_UI',          TRUE);    // (Boolean)  Enable (false) or disable (true) all default UI
define('MAP_DISABLE_CLICK_ZOOM',  FALSE);   // (Boolean)  Enable (false) or disable (true) zoom and center on double click
define('MAP_DRAGGABLE',           TRUE);    // (Boolean)  False prevent the map from being dragged
define('MAP_SCROLLWHEEL',         TRUE);    // (Boolean)  False disables scrollwheel zooming on the map
define('MAP_ZOOM',                14);      // (Number)   The initial Map zoom level

if( function_exists('get_field') && $map = ws_get_field(constant('MAP_MAIN_FIELD')) ):
  $ID         = get_the_id();       // App\pre_print('$ID', $ID);
  $address    = $map['address'];    // App\pre_print('$addr', $addr);
  $lat        = $map['lat'];        // App\pre_print('$lat', $lat);
  $lng        = $map['lng'];        // App\pre_print('$lng', $lng); ?>

  <div id="map-<?php echo $ID ?>" class="acf-map hidden-xs">
		<div class="marker" data-lat="<?php echo $lat ?>" data-lng="<?php echo $lng ?>"></div>
	</div>

  <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0x4svfKCtZu-UygFHO-KrmLgvVyf04is"></script>
  <script type="text/javascript">!function(a){function c(c){var f=c.find(".marker"),g=new google.maps.Map(c[0],b);return g.markers=[],f.each(function(){d(a(this),g)}),e(g),g}function d(a,b){var c=new google.maps.LatLng(a.attr("data-lat"),a.attr("data-lng")),d=new google.maps.Marker({position:c,map:b});if(b.markers.push(d),a.html()){var e=new google.maps.InfoWindow({content:a.html()});google.maps.event.addListener(d,"click",function(){e.open(b,d)})}}function e(c){var d=new google.maps.LatLngBounds;a.each(c.markers,function(a,b){var c=new google.maps.LatLng(b.position.lat(),b.position.lng());d.extend(c)}),1==c.markers.length?(c.setCenter(d.getCenter()),c.setZoom(b.zoom)):c.fitBounds(d)}var b={disableDefaultUI:<?php echo constant('MAP_DISABLE_UI') ? 'true' : 'false'; ?>,disableDoubleClickZoom:<?php echo constant('MAP_DISABLE_CLICK_ZOOM') ? 'true' : 'false'; ?>,draggable:<?php echo constant('MAP_DRAGGABLE') ? 'true' : 'false'; ?>,scrollwheel:<?php echo constant('MAP_SCROLLWHEEL') ? 'true' : 'false'; ?>,zoom:<?php echo constant('MAP_ZOOM') ?>,center:new google.maps.LatLng(0, 0),mapTypeId:google.maps.MapTypeId.ROADMAP},f=null;a(document).ready(function(){a(".acf-map").each(function(){f=c(a(this))})})}(jQuery);</script>

<?php
else:
  return;
endif;
?>