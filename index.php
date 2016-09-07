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
    $time = new \Moment\Moment(get_the_date('r'));

    $event = get_post_meta($post->ID, '_igv_related_event', true);
    $color = !empty($event) ? get_post_meta($event, '_igv_color', true) : false;
?>

    <article <?php post_class('row margin-bottom-mid'); ?> id="post-<?php the_ID(); ?>">

      <!-- Desktop Article Meta -->
      <div class="article-meta col col-s-12 col-m-3 only-desktop">
        <div class="article-date margin-bottom-small">
          <h3 class="font-capitalize"><?php echo $time->format('j F,'); ?><br/><?php echo $time->format('Y'); ?></h3>
        </div>
        <div class="article-author">
          <?php echo __('[:es]Por[:en]By'); ?>:<br/>
          <?php the_author(); ?>
        </div>
      </div>

      <!-- Mobile Article Meta -->
      <div class="article-meta col col-s-12 col-m-3 only-mobile">
        <h3 class="font-capitalize"><?php echo $time->format('j F, Y');?></h3>
        <h4><?php echo __('[:es]Por[:en]By'); ?>: <?php the_author(); ?></h4>
      </div>

      <!-- Article Content -->
      <div class="article-content col col-s-12 col-m-9 col-l-6">
        <header class="article-content-header margin-bottom-small">
          <a href="<?php the_permalink() ?>"><h3 class="u-inline-block" <?php echo $color ? 'style="color: ' . $color . '"' : ''; ?>><?php the_title(); ?></h3></a><?php
            $sources = get_the_terms($post, 'source');

            if ($sources) {
              echo '&nbsp;<h4 class="font-serif u-inline-block">&nbsp;—&nbsp;</h4>&nbsp;';
              echo '<h4 class="font-serif u-inline-block"><a href="' . get_term_link($sources[0]) . '">' . $sources[0]->name . '</a></h4>';
            }
          ?>
        </header>
        <?php the_content(__('[:es]LEER MAS[:en]READ MORE')); ?>
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