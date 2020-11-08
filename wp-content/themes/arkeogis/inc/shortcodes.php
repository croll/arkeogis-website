<?php

function mercate_key_dates_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'lang' => 'fr',
  ), $atts );

  $posts = get_mercate_key_dates($a['lang']);

  $postsByYear = array();

  foreach($posts as $p) {
    if (!$p->year) {
      continue;
    }
    if (!is_array($postsByYear[$p->year])) {
      $postsByYear[$p->year] = array();
    }
    $postsByYear[$p->year][] = $p;
  }


  ob_start();
	get_template_part( 'template-parts/shortcode', 'key_dates', $postsByYear );
  $outp = ob_get_clean();

  return $outp;

}
add_shortcode( 'mercate_key_dates', 'mercate_key_dates_shortcode' );

function mercate_news_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'lang' => 'fr',
  ), $atts );

  $posts = get_mercate_news($a['lang'], -1);

  ob_start();
  get_template_part( 'template-parts/shortcode', 'news', $posts );
  $outp = ob_get_clean();

  return $outp;

}
add_shortcode( 'mercate_news', 'mercate_news_shortcode' );