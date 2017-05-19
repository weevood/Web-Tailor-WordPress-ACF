# wp-acf-starter
A starter package of Advanced Custom Fields templates with Bootstrap 4.

## Templates
- Carousel
- Gallery
- Google Map
- Posts Mosaic
- Masonry
- Theme Options Page
  - General
  - Maintenance Mode

## Use
1. Synchronize the necessary fields from JSON (https://goo.gl/vtmBLR)
2. Include templates wherever you want in your theme with `<?php get_template_part('acf/*template_name*'); ?>`
3. For "Theme Options Page" only :
  - Include acf.php file in your functions.php file with `<?php require_once dirname(__FILE__) . '/acf.php'; ?>`
