<?php
get_header();

$date = current_time( 'timestamp' );
?>

<!-- main content -->

<main id="main-content" class="container">

<?php
  $args = array(
    'post_type' => 'programacion',
    'posts_per_page' => 1,
    'meta_key' => '_igv_end_time',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_query' => array(
      'relation' => 'AND',
      array(
        'key'     => '_igv_end_time',
        'value'   => $date,
        'compare' => '>='  //returns Current or nearest Future
      )
    )
  );
  $query = new WP_Query($args);

  if (!$query->have_posts()) { // if no Current or Future, get Past
    $args = array(
      'post_type' => 'programacion',
      'posts_per_page' => 1,
      'meta_key' => '_igv_end_time',
      'orderby' => 'meta_value_num',
      'order' => 'DESC',
      'meta_query' => array(
        'relation' => 'AND',
        array(
          'key'     => '_igv_end_time',
          'value'   => $date,
          'compare' => '<'  //returns nearest Past
        )
      )
    );
    $query = new WP_Query($args);
  }

  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();

      $meta = get_post_meta($post->ID);
?>
    <a href="<?php the_permalink() ?>">
      <article <?php post_class('row font-sans font-key-color text-align-center home-programacion-height-fix'); ?>>

          <div class="col col-1"></div>

          <div class="col col-3 home-programacion-height-fix u-flex-center">
            <div>
            <?php if (!empty($meta['_igv_start_time'][0])) {
                $start_time = $meta['_igv_start_time'][0];
              ?>
              <h6><?php echo __('[:es]Desde[:en]From'); ?></h6>
              <h3 class="font-leading-zero"><?php echo date( 'M. d', $start_time ); ?><br/>
                <?php echo date( 'Y', $start_time ); ?></h3>
            <?php } ?>
            </div>
          </div>

          <div class="col col-4 home-programacion-height-fix u-flex-center">
            <div>
              <h3><?php if (!empty($meta['_igv_number'][0])) { echo 'No. ' . add_leading_zero( $meta['_igv_number'][0] ); } ?></h3>
              <h2 class="font-huge font-leading-zero margin-top-basic margin-bottom-tiny"><?php the_title(); ?></h2>
              <h3><?php if (!empty($meta['_igv_subtitle'][0])) { echo $meta['_igv_subtitle'][0];} ?></h3>
            </div>
          </div>

          <div class="col col-3 home-programacion-height-fix u-flex-center">
            <div>
            <?php if (!empty($meta['_igv_end_time'][0])) {
                $end_time = $meta['_igv_end_time'][0];
              ?>
              <h6><?php echo __('[:es]Hasta[:en]Until'); ?></h6>
              <h3 class="font-leading-zero"><?php echo date( 'M. d', $end_time ); ?><br/>
              <?php echo date( 'Y', $end_time ); ?></h3>
            <?php } ?>
            </div>
          </div>

      </article>
    </a>

<?php
    }
  } else {
?>
    <article class="u-alert"><?php _e('[:es]Lo sentimos, pero no podemos encontrar lo que estás buscando.[:en]Sorry, no posts matched your criteria[:]'); ?></article>
<?php
  }
  wp_reset_postdata();
?>

<!-- end main-content -->

</main>

<?php
get_footer();
?>