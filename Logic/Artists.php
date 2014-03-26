<?php

namespace My\Logic;

use Craft\Box\Mog;
use My\Model\Artist;

class Artists
{

    /**
     * Get artist
     * @param $id
     * @render views/artists.show
     * @return array
     */
    public function show($id)
    {
        $artist = Artist::one($id);

        return ['artist' => $artist];
    }


    /**
     * Create artist
     * @render views/artists.form
     * @return array
     */
    public function create()
    {
        // create artist
        $artist = new Artist;

        // form submitted
        if($data = Mog::post()) {
            $artist = hydrate($artist, $data);
            $artist = Artist::save($artist);
            go('/');
        }

        return ['artist' => $artist];
    }


    /**
     * Update artist
     * @render views/artists.form
     * @param $id
     * @return array
     */
    public function update($id)
    {
        // get artist
        $artist = Artist::one($id);

        // form submitted
        if($data = Mog::post()) {
            $artist = hydrate($artist, $data);
            $artist = Artist::save($artist);
        }

        return ['artist' => $artist];
    }


    /**
     * Delete artist
     * @param $id
     */
    public function delete($id)
    {
        Artist::drop($id);
        go('/');
    }

} 