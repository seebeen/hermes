<?php

namespace SGI\WP\Hermes\Module;

class Relative_URLs
{

    private static $filters = [
        'bloginfo_url',
        'the_permalink',
        'wp_list_pages',
        'wp_list_categories',
        'wp_get_attachment_url',
        'the_content_more_link',
        'post_link',
        'the_tags',
        'get_pagenum_link',
        'get_comment_link',
        'month_link',
        'day_link',
        'year_link',
        'term_link',
        'the_author_posts_link',
        'script_loader_src',
        'style_loader_src',
        'theme_file_uri',
        'parent_theme_file_uri'
    ];

    public function __construct()
    {

        if (!current_theme_supports('hermes-relative-url'))
            return;

        if ((is_admin() && !wp_doing_ajax()) || isset($_GET['sitemap']) || in_array($GLOBALS['pagenow'], ['wp-login.php', 'wp-register.php']))
             return;

        foreach (self::$filters as $tag)
            add_filter($tag, [&$this, 'make_relative_url']);

        add_filter('wp_calculate_image_srcset', [&$this, 'make_srcset_relative']);

    }

    public function make_srcset_relative($sources)
    {

        foreach ( (array)$sources as $source => $src) :

            $sources[$source]['url'] = $this->make_relative_url(($src['url']));

        endforeach;

    }

    public function make_relative_url($input)
    {

        if(is_feed())
            return $input;

        preg_match('|https?://([^/]+)(/.*)|i', $input, $matches);

        if (isset($matches[1]) && isset($matches[2]) && $matches[1] === $_SERVER['SERVER_NAME']) :
            
            return wp_make_link_relative($input);

        else :

            return $input;

        endif;

    }

}