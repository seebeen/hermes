<?php

namespace SGI\WP\Hermes\Module;

class Trackbacks
{

    public function __construct()
    {

        if (!current_theme_supports('hermes-disable-trackbacks'))
            return;

        add_filter('xmlrpc_methods', [&$this, 'disable_pingback_xmlrpc'], 10, 1);
        add_filter('wp_headers', [&$this, 'disable_pingback_header'], 10, 1);
        add_filter('rewrite_rules_array', [&$this, 'disable_pingback_rewrite']);
        add_filter('bloginfo_url', [&$this, 'disable_pingback_url'], 10, 2);
        add_filter('xmlrpc_call', [&$this, 'disable_pingback_xmlrpc_call']);

    }

    public function disable_pingback_xmlrpc($methods)
    {

        unset($methods['pingback.ping']);
        return $methods;

    }

    public function disable_pingback_header($headers)
    {

        if (isset($headers['X-Pingback']))
            unset($headers['X-Pingback']);

        return $headers;

    }

    public function disable_pingback_rewrite($rules)
    {

        foreach ($rules as $rule => $rewrite)
            if (preg_match('/trackback\/\?\$$/i', $rule))
              unset($rules[$rule]);
            
        return $rules;

    }

    public function disable_pingback_url($output, $show)
    {

        if ($show === 'pingback_url')
            return '';

        return $output;

    }

    public function disable_pingback_xmlrpc_call($action)
    {

        if ($action === 'pingback.ping')
            wp_die(
                'Pingbacks are not supported',
                'Not Allowed!',
                ['response' => 403]
        );

    }

}