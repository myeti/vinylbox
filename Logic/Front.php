<?php

/**
 * This is a controller, a class that contains many actions.
 * Use it to write all your business layer !
 */
namespace My\Logic;

use Craft\Orm\Syn;
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
        $stats = Syn::jar()->pdo()->query('
            SELECT count(ar.`id`) as c_artists,  count(al.`id`) as c_albums,  count(tr.`id`) as c_tracks
            FROM `artist` ar, `album` al, `track` tr;
        ')->fetch();

        return ['artists' => $artists] + $stats;
    }

    /**
     * 404 Not found
     * @render views/front.404
     */
    public function lost() {}

}