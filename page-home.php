<?php
get_header();
?>

<!-- main content -->
<main id="main-content" class="container">
  <div class="row">
    <div class="col col-s-12 col-m-11 col-l-10">
<?php
  $home_content = get_post_meta( get_the_ID(), '_igv_home_content', true);

  if ($home_content) {
    foreach ($home_content as $item) {
      echo '<div class="home-item u-pointer">';
      if (!empty($item['link'])) {
        echo '<a href="' . get_permalink($item['link']) . '">';
      }
      if (!empty($item['image_id'])) {
        echo '<div class="home-item-image-holder">' . wp_get_attachment_image($item['image_id'], 'home-thumb') . '</div>';

        if (!empty($item['caption'])) {
          echo '<h4 class="home-item-image-caption padding-top-tiny text-align-center">' . $item['caption'] . '</h4>';
        }
      } else if (!empty($item['text'])) {
        echo '<h3>' . $item['text'] . '</h3>';
      }
      if (!empty($item['link'])) {
        echo '</a>';
      }
      echo '</div>';
    }
  }
?>
    </div>
  </div>
<!-- end main-content -->
</main>

<nav id="home-plus">
  <a href="<?php echo site_url('/noticias'); ?>">+</a>
</nav>

<?php
get_footer();
?>
