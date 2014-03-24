<?php
/**
 * This file is part of the Craft package.
 *
 * Copyright Aymeric Assier <aymeric.assier@gmail.com>
 *
 * For the full copyright and license information, please view the Licence.txt
 * file that was distributed with this source code.
 */
namespace Craft\Box;

use Craft\Box\Provider\AuthProvider;
use Craft\Data\Provider;
use Craft\Data\Provider\Container;

abstract class Flash extends Container
{

    /**
     * Create provider instance
     * @return Provider
     */
    protected static function bind()
    {
        return new Native\Flash();
    }


    /**
     * Change session provider
     * @param AuthProvider $provider
     */
    public static function swap(AuthProvider $provider)
    {
        static::instance($provider);
    }

}