<?php

// RENDER functions

function render_programacion_index($post_id) {

  $meta = get_post_meta($post_id);
  $img = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'index-programacion-post');
?>

<div class="index-programacion-post u-flex-center" style="background-color: <?php if (!empty($meta['_igv_color'][0])) {echo $meta['_igv_color'][0];} ?>; background-image: url(<?php if (!empty($img)) {echo $img[0];} ?>);">
  <?php if (!empty($meta['_igv_number'][0])) {echo $meta['_igv_number'][0];} ?>
</div>

<?php
}