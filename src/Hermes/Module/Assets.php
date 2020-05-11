<?php

namespace SGI\WP\Hermes\Module;

class Assets
{

    public function __construct()
    {

        if (current_theme_supports('hermes-disable-jquery-migrate'))
            add_action( 'wp_default_scripts', [&$this, 'remove_jquery_migrate'] );

        if (current_theme_supports('hermes-disable-asset-versioning')) :

            add_filter('style_loader_src', [&$this, 'remove_asset_version'], 15, 1);
            add_filter('script_loader_src', [&$this, 'remove_asset_version'], 15, 1);
            
        endif;

        if(current_theme_supports('hermes-js-to-footer'))
            add_action('wp_enqueue_scripts', [&$this, 'js_to_footer']);

        if(current_theme_supports('hermes-remove-block_styles'))
            add_action('wp_enqueue_scripts', [&$this, 'remove_block_styles']);

    }

    public function remove_block_styles()
    {

        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );

    }

    public function remove_asset_version($src)
    {

        return $src ? esc_url(remove_query_arg('ver', $src)) : false;

    }

    public function js_to_footer()
    {

        remove_action('wp_head', 'wp_print_scripts');
        remove_action('wp_head', 'wp_print_head_scripts', 9);
        remove_action('wp_head', 'wp_enqueue_scripts', 1);

    }

    public function remove_jquery_migrate( $scripts )
    {

        if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) :

            $script = $scripts->registered['jquery'];
 
            if ( $script->deps )
                $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
             
        endif;
    }

}