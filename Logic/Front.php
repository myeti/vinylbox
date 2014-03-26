<?php

/**
 * This is a controller, a class that contains many actions.
 * Use it to write all your business layer !
 */
namespace My\Logic;

use My\Model\Artist;

class Front
{

    /**
     * Landing page
     * @render views/front.hello
     * @return array
     */
    public function hello()
    {
        // get all artists
        $artists = Artist::all();

        return ['artists' => $artists];
    }

    /**
     * 404 Not found
     * @render views/front.404
     */
    public function lost() {}

}