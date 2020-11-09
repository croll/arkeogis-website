<?php
function get_arkeogis_news($lang, $home_only) {

  $args = array(
    'post_type' => 'arkeogis_news',
    'posts_per_page' => ($home_only) ? 3 : -1,
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
        'news_order_clause' => 'ASC',
        'news_date_clause' => 'ASC'
    )
  );

  if ($home_only) {
    $args['meta_query']['news_home_clause'] = array(
      'key' => 'news_home',
      'compare' => '=',
      'value' => true
    );
    $args['orderby']['news_home_clause'] = 'ASC';
  }

  $posts = get_posts($args);

  $items = array();

  foreach ($posts as $post) {
    $acfFields = get_fields($post->ID);
    $r = new \stdClass();
    $r->title = $post->post_title;
    $r->image = esc_url(get_the_post_thumbnail_url($post->ID, 'medium'));
    $r->url = get_permalink($post->ID);
    $r->content = $post->post_content;
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