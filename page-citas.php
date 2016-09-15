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

    <article <?php post_class('row page-citas-row margin-bottom-small'); ?> id="page-<?php the_ID(); ?>">

      <div class="citas-text-content-mobile col col-s-12">

        <?php get_template_part('partials/citas-text-content'); ?>

      </div>

      <div class="page-images col col-s-12 col-m-7 col-l-9 font-size-h4 font-bold">
      <?php 
        $citas_content = get_post_meta( get_the_ID(), '_igv_citas_content', true);

        if ($citas_content) {
      ?>
        <div id="home-holder">
          <?php
          foreach ($citas_content as $item) {
            if (!empty($item['image_id'])) {
          ?>
          <div class="home-item citas-item margin-bottom-small margin-top-<?php echo rand(0,1) == 1 ? 'basic' : 'small'; ?> text-align-center">
            <div class="home-item-image-holder">
              <?php echo wp_get_attachment_image($item['image_id'], 'home-thumb'); ?>
            </div>
          </div>
          <?php
            }
          }
          ?>
        </div>
      <?php 
        }
      ?>
      </div>

      <div class="citas-text-content col col-m-5 col-l-3">

        <?php get_template_part('partials/citas-text-content'); ?>

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

  <?php get_template_part('partials/pagination'); ?>

<!-- end main-content -->

</main>

<?php
get_footer();
?>
