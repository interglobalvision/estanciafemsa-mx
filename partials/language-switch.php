<?php
  if (qtranxf_getLanguage() == 'es') {
    $lang_switch = is_404() ? site_url() : qtranxf_convertURL('', 'en', false, true);
  } else {
    $lang_switch = is_404() ? site_url() : qtranxf_convertURL('', 'es', false, true);
  }
?>
<a href="<?php echo $lang_switch; ?>"><?php _e('[:es]Read in English[:en]Leer en Español'); ?></a>