<?php
/**
 * This file is part of the Craft package.
 *
 * Copyright Aymeric Assier <aymeric.assier@gmail.com>
 *
 * For the full copyright and license information, please view the Licence.txt
 * file that was distributed with this source code.
 */
namespace Craft\Map;

class Route
{

    /** @var string */
    public $from;

    /** @var mixed */
    public $to;

    /** @var array */
    public $customs = [];

    /** @var array */
    public $data = [];

    /** @var array */
    public $meta = [];


    /**
     * Define route
     * @param string $from
     * @param mixed $to
     * @param array $customs
     */
    public function __construct($from, $to, array $customs = [])
    {
        $this->from = $from;
        $this->to = $to;
        $this->customs = $customs;
    }

} 