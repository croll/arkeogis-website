<?php

function arkeogis_users_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'lang' => 'fr',
  ), $atts );

  $posts = get_mercate_news($a['lang'], -1);

  ob_start();
  get_template_part( 'template-parts/shortcode', 'users', $posts );
  $outp = ob_get_clean();

  return $outp;

}
add_shortcode( 'arkeogis_users', 'arkeogis_users_shortcode' );