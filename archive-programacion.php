<?php
get_header();

$date = time();

$ahora = new WP_Query(array(
  'post_type' => 'programacion',
  'posts_per_page' => 1,
  'meta_query' => array(
    'relation' => 'AND',
    array(
      'key'     => '_igv_start_time',
      'value'   => $date,
      'compare' => '<=',
      'type'    => 'NUMERIC'
    ),
    array(
      'key'     => '_igv_end_time',
      'value'   => $date,
      'compare' => '>=',
      'type'    => 'NUMERIC'
    )
  )
));

$future = new WP_Query(array(
  'post_type' => 'programacion',
  'posts_per_page' => 1,
  'meta_query' => array(
    array(
      'key'     => '_igv_start_time',
      'value'   => $date,
      'compare' => '>',
      'type'    => 'NUMERIC'
    ),
  )
));

$past = new WP_Query(array(
  'post_type' => 'programacion',
  'posts_per_page' => -1,
  'meta_query' => array(
    array(
      'key'     => '_igv_end_time',
      'value'   => $date,
      'compare' => '<',
      'type'    => 'NUMERIC'
    ),
  )
));
?>

<!-- main content -->
<main id="main-content" class="container text-align-center">

<?php
if ($ahora->have_posts() || $future->have_posts() || $past->have_posts()) {
  if (!$future->have_posts()) {
?>
  <div class="row">
    <div class="col col-12">
      <h3 class="margin-bottom-small"><?php echo __('[:es]Ahora[:en]Now'); ?></h3>
    </div>
  </div>

  <div class="row margin-bottom-basic">
    <div class="col col-4"></div>
    <div class="col col-4">
        <?php
          if ($ahora->have_posts()) {
            while ($ahora->have_posts()) {
              $ahora->the_post();
              render_programacion_index($post->ID);
            }
          }
          wp_reset_postdata();
        ?>
    </div>
  </div>
<?php
  } else {
?>
  <div class="row margin-bottom-basic">
    <?php
      if ($ahora->have_posts()) {
        $ahora->the_post();
    ?>
    <div class="col col-2"></div>
    <div class="col col-4">
      <h3 class="margin-bottom-small"><?php echo __('[:es]Ahora[:en]Now'); ?></h3>
      <?php render_programacion_index($post->ID); ?>
    </div>
    <?php
      } else {
    ?>
    <div class="col col-4"></div>
    <?php
      }
      wp_reset_postdata();
    ?>
    <div class="col col-4">
      <h3 class="margin-bottom-small"><?php echo __('[:es]Futura[:en]Future'); ?></h3>
      <?php
          if ($future->have_posts()) {
            while ($future->have_posts()) {
              $future->the_post();
              render_programacion_index($post->ID);
            }
          }
          wp_reset_postdata();
        ?>
    </div>
  </div>
<?php
  }
?>

  <div class="row">
    <div class="col col-12">
      <h3 class="margin-bottom-basic"><?php echo __('[:es]Pasadas[:en]Past'); ?></h3>
    </div>
  </div>

  <div class="row">
  <?php
      if ($past->have_posts()) {
        $i = 0;
        while ($past->have_posts()) {
          $past->the_post();
          if (($i % 2) == 0) {
            if (count($past->posts) > 1) {
    ?>
      <div class="col col-2"></div>
    <?php
            } else {
    ?>
      <div class="col col-4"></div>
    <?php
            }
          }
    ?>
      <div class="col col-4 margin-bottom-small">
    <?php
          render_programacion_index($post->ID);
    ?>
      </div>
    <?php
          if (($i % 2) == 1) {
    ?>
      <div class="col col-2"></div>
    <?php
          }
        $i++;
        }
      }
?>
  </div>
<?php
      wp_reset_postdata();
} else {
?>
  <div class="row margin-bottom-basic">
    <article class="col col-12 u-alert"><?php _e('[:es]Lo sentimos, pero no podemos encontrar lo que estás buscando.[:en]Sorry, no posts matched your criteria[:]'); ?></article>
  </div>
<?php } ?>

<!-- end main-content -->
</main>

<?php
get_footer();
?>
