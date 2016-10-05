<span id="search-toggle" class="u-pointer"><?php _e('[:es]Buscar[:en]Search'); ?></span>
<form role="search" method="get" id="search-form" class="u-cf" action="<?php echo home_url(); ?>" autocomplete="off">
  <input id="search-input" type="text" value="" name="s">
  <button type="submit" id="search-submit"><?php 
    echo file_get_contents(get_bloginfo('stylesheet_directory') . '/img/dist/ui-arrow-right.svg'); 
    ?></button>
</form>
