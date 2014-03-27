<?php

/**
 * This is a controller, a class that contains many actions.
 * Use it to write all your business layer !
 */
namespace My\Logic;

use My\Model\Album;
use My\Model\Artist;
use My\Model\Track;

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

        // get stats
        $c_artists = count($artists);
        $c_albums = count(Album::all());
        $c_tracks = count(Track::all());

        return [
            'artists' => $artists,
            'c_artists' => $c_artists,
            'c_albums' => $c_albums,
            'c_tracks' => $c_tracks,
        ];
    }

    /**
     * 404 Not found
     * @render views/front.404
     */
    public function lost() {}

}