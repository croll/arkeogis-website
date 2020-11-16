<?php

function arkeogis_users_map_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'lang' => 'fr',
  ), $atts );

  ob_start();
  get_template_part( 'template-parts/shortcode', 'users', $posts );
  $outp = ob_get_clean();

  return $outp;

}
add_shortcode( 'arkeogis_users_map', 'arkeogis_users_map_shortcode' );