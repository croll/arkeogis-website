<?php

function get_arkeogis_news($lang, $limit = 9) {

  $args = array(
    'post_type' => 'post',
    'posts_per_page' => $limit,
    'lang' => $lang,
    'post_status' => 'publish',
    'meta_key'			=> 'news_date',
    'orderby'			=> 'meta_value',
    'order'				=> 'DESC'
  );

  $posts = get_posts($args);

  $items = array();

  foreach ($posts as $post) {
    $acfFields = get_fields($post->ID);
    $r = new \stdClass();
    $r->title = $post->post_title;
    $r->image = esc_url(get_the_post_thumbnail_url($post->ID, 'medium'));
    $r->url = get_permalink($post->ID);
    $r->id = $post->ID;
    $date = $acfFields['news_date'];
    if (preg_match("/([0-9]{4})([0-9]{2})([0-9]{2})/", $date, $m)) {
      if ($lang === 'en') {
        $r->date = $m[1].'.'.$m[2].'.'.$m[3];
      } else {
        $r->date = $m[3].'.'.$m[2].'.'.$m[1];
      }
    }
    $items[] = $r;
  }

  return $items;
}

function get_arkeogis_news_dates($lang, $num) {

  $args = array(
    'post_type' => 'arkeogis_news',
    'posts_per_page' => $num || -1,
    'lang' => $lang,
    'post_status' => 'publish',
    'meta_query'     => array(
        'relation' => 'AND',
        'news_date_clause' => array(
            'key' => 'news_date',
            'compare' => 'EXISTS'
        ),
        'news_order_clause' => array(
            'key' => 'news_order',
            'compare' => 'EXISTS'
        )
    ),

    'orderby'    => array(
        'news_date_clause' => 'ASC',
        'news_order_clause' => 'ASC'
    )
  );

  $posts = get_posts($args);

  $items = array();

  foreach ($posts as $post) {
    $acfFields = get_fields($post->ID);
    $r = new \stdClass();
    $r->title = $post->post_title;
    $r->image = esc_url(get_the_post_thumbnail_url($post->ID, 'medium'));
    $r->url = get_permalink($post->ID);
    $r->date = $acfFields['news_date'];
    $r->content = $post->post_content;
    $items[] = $r;
  }

  return $items;
}