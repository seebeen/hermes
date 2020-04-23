<?php

namespace SGI\WP\Hermes;

class Media
{

    public function __construct()
    {

        if (!current_theme_supports('hermes-use-imagick'))
            return;

        add_filter('wp_image_editors', [&$this,'use_imagick']);

    }

    public function use_imagick()
    {

        return ['WP_Image_Editor_Imagick'];

    }

}