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

    <article <?php post_class('row margin-bottom-mid'); ?> id="post-<?php the_ID(); ?>">

      <div class="article-meta col col-s-12 col-m-3">
        <div class="article-date margin-bottom-small">
          <h3><?php the_time('j F'); ?><br/><?php the_time('Y'); ?></h3>
        </div>
        <div class="article-author">
          <?php echo __('[:es]Por[:en]By'); ?>:<br/>
          <?php the_author(); ?>
        </div>
      </div>

      <div class="article-content col col-s-12 col-m-6">
        <header class="article-content-header margin-bottom-small">
          <a href="<?php the_permalink() ?>"><h3 class="u-inline-block"><?php the_title(); ?></h3></a><?php
            $sources = get_the_terms($post, 'source');

            if ($sources) {
              echo '&nbsp;<h4 class="font-serif u-inline-block">&nbsp;—&nbsp;</h4>&nbsp;';
              echo '<h4 class="font-serif u-inline-block"><a href="' . get_term_link($sources[0]) . '">' . $sources[0]->name . '</a></h4>';
            }
          ?>
        </header>
        <?php the_content(); ?>
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