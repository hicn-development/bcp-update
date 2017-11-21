<?php
function lms() {

    global $wp_query;

    wp_enqueue_script('jquery');

    wp_register_script( 'mylms', get_template_directory_uri() . '/js/script-on-ajax.js', array('jquery'), '1.0.0', true );

    wp_localize_script( 'mylms', 'mlp', array(
        'bcp_ajaxurl' => admin_url('admin-ajax.php', 'relative'),
        'posts' => serialize( $wp_query->query_vars ),
        'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
        'max_page' => $wp_query->max_num_pages
    ) );

    wp_enqueue_script( 'mylms' );
}

add_action( 'wp_enqueue_scripts', 'lms' );

function bcp_lmr_ajax_handler(){

    $args = json_decode( stripslashes( $_POST['query'] ), true );
    $args['paged'] = $_POST['page'] + 1;
    $args['post_status'] = 'publish';

    query_posts( $args );
    if( have_posts() ) :
        while( have_posts() ): the_post();
            get_template_part( 'template-parts/content', get_post_format());
        endwhile;

    endif;
    die;
}

add_action('wp_ajax_lmr', 'bcp_lmr_ajax_handler');
add_action('wp_ajax_nopriv_lmr', 'bcp_lmr_ajax_handler');