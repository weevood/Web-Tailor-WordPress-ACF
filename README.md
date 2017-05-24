# wp-acf-starter
A starter package of Advanced Custom Fields templates with Bootstrap 4.

## Templates
- 🎠 Carousel
- 🖼️ Gallery
- 📍 Google Map
- 📝 Posts Mosaic
- 🏞 Masonry

### Use
1. Synchronize the necessary fields from JSON (https://goo.gl/vtmBLR)
2. Include templates wherever you want in your theme with `<?php get_template_part('*template_name*'); ?>`

## Theme Options Page
- General
  - 🎠 Carousel Options
- Restricted Access
  - 🚧 Maintenance Mode
  - 🤠 Apache Authentification

### Use
1. Include *acf.php* file from *options-page* folder in your *functions.php* file with `<?php require_once dirname(__FILE__) . '/acf.php'; ?>`
2. Move *apache-auth.php* and *maintenance-mode.php* files from *mu-plugins* folder in your *mu-plugins* folder
3. Move *maintenance.php* file from *options-page* folder in the root of your *wp-content* folder
