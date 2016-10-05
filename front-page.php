<?php
get_header();

$splash_text = IGV_get_option('_igv_splash_text');
$splash_text_en = IGV_get_option('_igv_splash_text_en');

?>

<!-- main content -->
<main id="front-page" class="font-bolder">
  <a href="<?php echo qtranxf_convertURL(home_url('/home'), 'es', false, true); ?>" class="front-page-block font-size-h1 line-tighter">
    <div class="col-l-9">
      <?php if (!empty($splash_text)) {echo $splash_text;} ?>&nbsp;>
    </div>
  </a>
  <a href="<?php echo qtranxf_convertURL(home_url('/home'), 'en', false, true); ?>" class="front-page-block font-size-h1 line-tighter">
    <div class="col-l-9">
      <?php if (!empty($splash_text_en)) {echo $splash_text_en;} ?>&nbsp;>
    </div>
  </a>
  <div class="front-page-block front-page-block-bottom"></div>
  <div class="front-page-block front-page-block-bottom"></div>
<!-- end main-content -->
</main>

<?php
get_footer();
?>