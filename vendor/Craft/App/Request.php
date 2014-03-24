<?php
/**
 * This file is part of the Craft package.
 *
 * Copyright Aymeric Assier <aymeric.assier@gmail.com>
 *
 * For the full copyright and license information, please view the Licence.txt
 * file that was distributed with this source code.
 */
namespace Craft\App;

use Craft\Box\Mog;

class Request
{

    /** @var string */
    public $query;

    /** @var array */
    public $args = [];

    /** @var callable */
    public $action;

    /** @var array */
    public $meta = [];


    /**
     * Init request
     * @param null $query
     */
    public function __construct($query = null)
    {
        $this->query = $query;
    }


    /**
     * Generate request from globals
     */
    public static function generate()
    {
        // resolve query
        $query = Mog::query();

        // create request
        return new self($query);
    }

} 