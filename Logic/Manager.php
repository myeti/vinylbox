<?php

namespace My\Logic;

use My\Model\Album;
use My\Model\Artist;

class Manager
{

    /**
     * Landing page
     * @render views/manager.dashboard
     * @return array
     */
    public function dashboard()
    {
        // get all artists
        $artist = Artist::all();

        return ['artists' => $artist];
    }


    /**
     * Get artist
     * @param int $artist
     * @return array
     * @render views/manager.artist
     */
    public function artist($artist)
    {
        // get artist
        $artist = Artist::one(['id' => $artist]);

        return ['artist' => $artist];
    }


    /**
     * Get album
     * @param int $album
     * @return array
     * @render views/manager.album
     */
    public function album($album)
    {
        // get album
        $album = Album::one(['id' => $album]);

        return ['album' => $album];
    }

} 