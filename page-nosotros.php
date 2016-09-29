<?php
get_header();
?>

<!-- main content -->

<main id="main-content" class="container">

  <!-- main posts loop -->
  <section id="posts">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
?>

    <article <?php post_class('row margin-bottom-small'); ?> id="page-<?php the_ID(); ?>">

      <div class="page-content col col-s-12 col-m-9 col-l-6">
        <div class="margin-bottom-small font-bold font-size-h4 line-tighter">
          <?php the_content(); ?>
        </div>

        <div class="margin-bottom-small">
          <h3 class="font-bolder font-uppercase"><?php echo __('[:es]Directorio[:en]Directory'); ?></h3>
          <div class="font-bold font-size-h4 line-tighter">
            <?php
              if (qtranxf_getLanguage() === 'es') {
                $about_directory = IGV_get_option('_igv_about_directory');
              } else {
                $about_directory = IGV_get_option('_igv_about_directory_en');
              }
              if (!empty($about_directory)) {
                echo apply_filters('the_content', $about_directory);
              }
            ?>
          </div>
        </div>

        <div class="margin-bottom-small" id="prensa">
          <h3 class="font-bolder font-uppercase"><?php echo __('[:es]Prensa[:en]Press'); ?></h3>
      <?php
      $prensa_query = new WP_query( array(
        'post_type' => 'programacion',
        'posts_per_page' => -1,
        'meta_key' => '_igv_number',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
      ));

      if ($prensa_query->have_posts()) {
      ?>
          <ul class="u-inline-list margin-bottom-micro">
      <?php
        while ($prensa_query->have_posts()) {
          $prensa_query->the_post();

          if (qtranxf_getLanguage() == 'es') {
            $program_file = get_post_meta($post->ID, '_igv_program_file_es', true);
          } else {
            $program_file = get_post_meta($post->ID, '_igv_program_file_en', true);
          }

          if (!empty($program_file)) {
            $number = get_post_meta($post->ID, '_igv_number', true);
            $color = get_post_meta($post->ID, '_igv_color', true);
          ?>
            <li><a class="file-icon u-inline-block" href="<?php echo $program_file; ?>" target="_blank" rel="noopener" class="font-underline" style="color: <?php echo $color; ?>">No. <?php echo $number; ?></a></li>
          <?php
          }
        }
        ?>
          </ul>
      <?php
      }
      wp_reset_postdata();
?>
          <p class="font-bold font-size-h4 line-tighter">
          <?php
            $press_email = IGV_get_option('_igv_prensa_email');
            $press_telephone = IGV_get_option('_igv_prensa_telephone');
            if (!empty($press_email)) {echo '<a href="mailto:' . $press_email . '">' . $press_email . '</a><br/>';}
            if (!empty($press_telephone)) {echo '<a href="tel:' . $press_telephone . '">' . $press_telephone . '</a>';}
          ?>
          </p>
        </div>

        <div class="margin-bottom-basic" id="contacto">
          <h3 class="font-bolder font-uppercase"><?php echo __('[:es]Contacto[:en]Contact'); ?></h3>
          <div class="font-bold font-size-h4 line-tighter">
            <?php
              $about_contact = IGV_get_option('_igv_about_contact');
              if (!empty($about_contact)) {
                echo apply_filters('the_content', $about_contact);
              }
            ?>
          </div>
        </div>

        <div id="social-logo" class="row align-center">
          <?php 
            $facebook = IGV_get_option('_igv_social_facebook');
            $instagram = IGV_get_option('_igv_social_instagram');
            $twitter = IGV_get_option('_igv_social_twitter');

            if (!empty($facebook)) {
          ?>
          <a class="social-link font-bolder u-inline-block font-size-h3" href="<?php echo esc_url($facebook); ?>">FB</a>
          <?php 
            }
            if (!empty($instagram)) {
          ?>
          <a class="social-link font-bolder u-inline-block font-size-h3" href="<?php echo esc_url($instagram); ?>">IG</a>
          <?php 
            }
            if (!empty($twitter)) {
          ?>
          <a class="social-link font-bolder u-inline-block font-size-h3" href="<?php echo esc_url($twitter); ?>">TW</a>
          <?php 
            }
          ?>
          <a class="femsa-logo u-inline-block"><?php 
            echo file_get_contents(get_bloginfo('stylesheet_directory') . '/img/dist/femsa-logo.svg'); 
          ?></a>
        </div>

      </div>

    </article>

<?php
  }
} else {
?>
    <article class="u-alert"><?php _e('Sorry, no posts matched your criteria :{'); ?></article>
<?php
} ?>

  <!-- end posts -->
  </section>

<!-- end main-content -->

</main>

<?php
get_footer();
?>
