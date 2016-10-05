<?php
get_header();
?>

<!-- main content -->

<main id="main-content" class="container">

  <!-- main posts loop -->
  <section id="results" class="row">

    <div id="results-meta" class="col col-s-12 col-m-3 col-xl-2 margin-bottom-tiny">
      <h3 class="font-bold font-capitalize"><?php echo get_search_query(); ?></h3>
    </div>

    <div id="posts" class="col col-s-12 col-m-9 col-l-8">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $post_type = get_post_type($post->ID);

    switch ($post_type) {
      case 'programacion':
        $post_type = '[:es]Programación[:en]Program';
        break;
      case 'post':
        $post_type = '[:es]Noticias[:en]News';
        break;
    }
?>

    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

      <h3 class="font-bold u-inline-block"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></h3>&nbsp;<h4 class="font-serif u-inline-block">&nbsp;—&nbsp;</h4>&nbsp;<h4 class="font-serif font-capitalize u-inline-block"><a href="<?php echo get_post_type($post->ID) == 'post' ? site_url('/noticias') : site_url('/programacion'); ?>"><?php echo _e($post_type); ?></a></h4>

    </article>

<?php
  }
} else {
?>
    <article class="u-alert">
      <?php _e('[:es]Lo sentimos, no hemos encontrado lo que estás buscando[:en]Sorry, no posts matched your criteria'); ?>
    </article>
<?php
} ?>

      <?php get_template_part('partials/pagination'); ?>

    </div>

  </section>

<!-- end main-content -->

</main>

<?php
get_footer();
?>
