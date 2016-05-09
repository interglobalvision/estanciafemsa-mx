<?php
get_header();
?>

<!-- main content -->
<main id="main-content" class="container">

  <!-- main posts loop -->
  <section id="single-programacion">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
    $meta = get_post_meta($post->ID);
?>

    <article <?php post_class('row'); ?> id="post-<?php the_ID(); ?>">
      <div id="single-programacion-header-mobile" class="text-align-center only-mobile">
        <h4 class="font-sans"><?php if (!empty($meta['_igv_number'][0])) {echo 'No. ' . add_leading_zero($meta['_igv_number'][0]);} ?></h4>
        <h2 class="margin-top-tiny margin-bottom-tiny"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
        <h4 class="font-sans margin-bottom-basic"><?php if (!empty($meta['_igv_subtitle'][0])) {echo __($meta['_igv_subtitle'][0]);} ?></h4>
      </div>

      <div class="col col-1"></div>
      <div class="col col-7 copy">
        <?php the_content(); ?>
      </div>
      <div class="col col-1"></div>
      <div class="col col-2">
        <header id="single-programacion-header" class="text-align-center margin-bottom-mid only-desktop">
          <h4 class="font-sans"><?php if (!empty($meta['_igv_number'][0])) {echo 'No. ' . add_leading_zero($meta['_igv_number'][0]);} ?></h4>
          <h2 class="margin-top-tiny margin-bottom-tiny"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
          <h4 class="font-sans"><?php if (!empty($meta['_igv_subtitle'][0])) {echo __($meta['_igv_subtitle'][0]);} ?></h4>
        </header>

        <div id="single-programacion-credits">
        <?php
          if (!empty($meta['_igv_credits'][0])) {
            echo wpautop($meta['_igv_credits'][0]);
          }
        ?>
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
