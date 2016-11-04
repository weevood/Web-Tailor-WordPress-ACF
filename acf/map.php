<?php

if( function_exists('get_field') && $map = get_field('map') ):  // App\pre_print($map);
  $id = get_the_id(); // App\pre_print($id); ?>

  <div id="map-<?php echo $id ?>" class="acf-map hidden-xs">
		<div class="marker" data-lat="<?php echo $map['lat']; ?>" data-lng="<?php echo $map['lng']; ?>"></div>
	</div>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0x4svfKCtZu-UygFHO-KrmLgvVyf04is"></script>
  <script type="text/javascript">!function(a){function b(b){var e=b.find(".marker"),f={scrollwheel:!1,zoom:11,center:new google.maps.LatLng(0,0),mapTypeId:google.maps.MapTypeId.ROADMAP},g=new google.maps.Map(b[0],f);return g.markers=[],e.each(function(){c(a(this),g)}),d(g),g}function c(a,b){var c=new google.maps.LatLng(a.attr("data-lat"),a.attr("data-lng")),d=new google.maps.Marker({position:c,map:b});if(b.markers.push(d),a.html()){var e=new google.maps.InfoWindow({content:a.html()});google.maps.event.addListener(d,"click",function(){e.open(b,d)})}}function d(b){var c=new google.maps.LatLngBounds;a.each(b.markers,function(a,b){var d=new google.maps.LatLng(b.position.lat(),b.position.lng());c.extend(d)}),1==b.markers.length?(b.setCenter(c.getCenter()),b.setZoom(11)):b.fitBounds(c)}var e=null;a(document).ready(function(){a(".acf-map").each(function(){e=b(a(this))})})}(jQuery);</script>
  
<?php
else:
  return;
endif;
?>