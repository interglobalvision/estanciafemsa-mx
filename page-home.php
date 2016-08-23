<?php
get_header();
?>

<!-- main content -->
<main id="main-content" class="container">
  <div class="row">
    <div class="col col-s-12 col-m-11 col-l-10">
<?php
  $home_content = IGV_get_option('_igv_home_content');

  if ($home_content) {
    foreach ($home_content as $item) {
      echo '<div class="home-item">';
      if (!empty($item['link'])) {
        echo '<a href="' . get_permalink($item['link']) . '">';
      }
      if (!empty($item['image_id'])) {
        echo wp_get_attachment_image($item['image_id'], 'home-thumb');

        if (!empty($item['caption'])) {
          echo '<div class="home-item-image-caption">' . $item['caption'] . '</div>';
        }
      } else if (!empty($item['text'])) {
        echo $item['text'];
      }
      if (!empty($item['link'])) {
        echo '</a>';
      }
    }
  }
?>
    </div>
  </div>
<!-- end main-content -->
</main>

<?php
get_footer();
?>