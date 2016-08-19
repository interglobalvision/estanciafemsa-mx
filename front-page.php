<?php
get_header();

$splash_text = IGV_get_option('_igv_splash_text');
$splash_text_en = IGV_get_option('_igv_splash_text_en');

?>

<!-- main content -->
<main id="front-page">
  <div>
    <a href="<?php echo site_url('/es/home'); ?>"><?php if (!empty($splash_text)) {echo $splash_text;} ?> ></a>
  </div>
  <div>
    <a href="<?php echo site_url('/en/home'); ?>"><?php if (!empty($splash_text_en)) {echo $splash_text_en;} ?> ></a>
  </div>
  <div></div>
  <div></div>
<!-- end main-content -->
</main>

<?php
get_footer();
?>