<div class="margin-bottom-small font-sans">
  <h3 class="font-bolder font-uppercase"><?php echo __('[:es]Previa Cita[:en]Appointments'); ?></h3>
  <div class="font-bold font-size-h4">
    <?php
      $cita_text = get_post_meta( get_the_ID(),'_igv_visits_text', true);
      $cita_url = get_post_meta( get_the_ID(),'_igv_visits_url', true);
      $cita_url_text = get_post_meta( get_the_ID(),'_igv_visits_url_text', true);
      $cita_text_2 = get_post_meta( get_the_ID(),'_igv_visits_text_two', true);
      if (!empty($cita_text)) {
        echo apply_filters('the_content', $cita_text);
      }
      if (!empty($cita_url && $cita_url_text)) {
        echo '<p>' . __($cita_url_text) . ' <a href="' . esc_url($cita_url) . '" target="_blank" rel="noopener noreferrer">' . 
          '<img class="citas-arrow" src="' . get_bloginfo('stylesheet_directory') . '/img/dist/ui-cursor-right.png"></a></p>'; 
      }
      if (!empty($cita_text_2)) {
        echo apply_filters('the_content', $cita_text_2);
      }
    ?>
  </div>
</div>

<div class="margin-bottom-small font-sans">
  <h3 class="font-bolder font-uppercase"><?php echo __('[:es]Agendar cita[:en]Schedule appointment'); ?></h3>
  <div class="font-bold font-size-h4">
    <?php
      $cita_text_2 = get_post_meta( get_the_ID(),'_igv_visits_guide', true);
      $cost = get_post_meta( get_the_ID(),'_igv_visits_cost', true);
      if (!empty($cita_text_2)) {
        echo apply_filters('the_content', $cita_text_2);
      }
      if (!empty($cost)) {
        echo apply_filters('the_content', $cost);
      }
    ?>
  </div>
</div>