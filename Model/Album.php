<?php

namespace My\Model;

use Craft\Orm\Model;

class Album
{

    use Model;

    /** @var int */
    public $id;

    /** @var string */
    public $title;

    /** @var string */
    public $date;

    /** @var string */
    public $genre;

    /** @var string */
    public $cover;

    /** @var int */
    public $artist_id;


    /**
     * Get artist
     * @return Artist
     */
    public function artist()
    {
        return $this->_one('artist', 'artist_id');
    }


    /**
     * Get all tracks
     * @return array
     */
    public function tracks()
    {
        // get all tracks
        $tracks = Track::get()->where('album_id', $this->id)->sort('side')->all();

        // sort by side
        $sides = [];
        foreach($tracks as $track) {

            // create side
            if(!isset($sides[$track->side])) {
                $sides[$track->side] = [];
            }

            // add track
            $sides[$track->side][] = $track;
        }

        return $sides;
    }

} 