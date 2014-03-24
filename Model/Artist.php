<?php

namespace My\Model;

use Craft\Orm\Model;

class Artist
{

    use Model;

    /** @var int */
    public $id;

    /** @var string */
    public $firstname;

    /** @var string */
    public $lastname;

    /** @var string */
    public $fullname;

    /** @var string */
    public $country;


    /**
     * Get all albums
     * return Album[]
     */
    public function albums()
    {
        return $this->_many('album', 'artist_id');
    }

} 