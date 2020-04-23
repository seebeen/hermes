<?php

namespace SGI\WP;

use SGI\WP\Hermes\Module as Module;

class Hermes
{

    public function __construct()
    {

        new Module\Cleanup();
        new Module\Assets();
        new Module\Relative_URLs();
        new Module\Trackbacks();
        new Module\Media();

    }

}