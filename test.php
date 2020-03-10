<?php
/*
 * Plugin Name: Test
 */

add_action('rest_api_init', function () {
    register_rest_route('wp/v1', 'podcasts', array(
        'methods' => 'GET',
        'callback' => 'get_podcast',
    ));
});

function get_podcast()
{
    $args = [
        'post_type' => 'post',
        'numberposts' => 99999,
        'category_name'  => 'podcast'
    ];

    $posts = get_posts($args);

    $data = [];

    $i = 0;

    foreach ($posts as $post) {
        $data[$i]['title'] = $post->post_title;

        $i++;
    }

    if (empty($data)) {
        $response = new WP_REST_Response($data, 418);
    } else {
        $response = new WP_REST_Response($data, 200);
    }



    return $response;
}
