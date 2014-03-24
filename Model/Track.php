<?php

namespace My\Model;

use Craft\Orm\Model;

class Track
{

    use Model;

    /** @var int */
    public $id;

    /** @var string */
    public $side;

    /** @var string */
    public $title;

    /** @var string */
    public $duration;

    /** @var int */
    public $album_id;


    /**
     * Get album
     * @return Album
     */
    public function album()
    {
        return $this->_many('album', 'album_id');
    }

} 