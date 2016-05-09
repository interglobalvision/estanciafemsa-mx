<?php
get_header();
?>

<!-- main content -->

<main id="main-content">

  <!-- main posts loop -->
  <section id="posts">

<?php
if(have_posts()) {
  while(have_posts()) {
    the_post();
    $img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'col-4');
?>

    <article <?php post_class('container'); ?> id="post-<?php the_ID(); ?>">

      <div class="row">
        <div class="col col-7">

          <h3 class="margin-top-basic margin-bottom-small"><?php echo __('[:es]Sobre Estancia FEMSA[:en]About Estancia FEMSA'); ?></h3>

          <div class="copy"><?php the_content(); ?></div>

        </div>

        <div class="col col-1"></div>

        <div class="col col-4">

          <h3 class="margin-top-basic margin-bottom-small"><?php echo __('[:es]Contacto[:en]Contact'); ?></h3>

          <div>
          <?php
            $about_contact = IGV_get_option('_igv_about_contact');
            if (!empty($about_contact)) {
              echo apply_filters('the_content', $about_contact);
            }
          ?>
          </div>

          <h3 class="margin-top-basic margin-bottom-small"><?php echo __('[:es]Directorio[:en]Directory'); ?></h3>

          <div>
          <?php
            if (qtranxf_getLanguage() === 'es') {
              $about_directoy = IGV_get_option('_igv_about_directory');
            } else {
              $about_directoy = IGV_get_option('_igv_about_directory_en');
            }

            if (!empty($about_directoy)) {
              echo apply_filters('the_content', $about_directoy);
            }
          ?>
          </div>

        </div>

      </div>
    </article>

<?php
  }
} else {
?>
    <article class="u-alert"><?php _e('[:es]Lo sentimos, pero no podemos encontrar lo que estás buscando.[:en]Sorry, no posts matched your criteria[:]'); ?></article>
<?php
} ?>

  <!-- end posts -->
  </section>

<!-- end main-content -->

</main>

<?php
get_footer();
?>
