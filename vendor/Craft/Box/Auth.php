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
use Craft\Data\Provider\Container;

abstract class Auth extends Container
{

    /**
     * Create provider instance
     * @return AuthProvider
     */
    protected static function bind()
    {
        return new Native\Auth();
    }


    /**
     * Get rank
     * @return int
     */
    public static function rank()
    {
        return static::instance()->rank();
    }


    /**
     * Get stored user
     * @return mixed
     */
    public static function user()
    {
        return static::instance()->user();
    }


    /**
     * Log user in
     * @param int  $rank
     * @param mixed $user
     */
    public static function login($rank = 1, $user = null)
    {
        static::instance()->login($rank, $user);
    }


    /**
     * Log user out
     */
    public static function logout()
    {
        static::instance()->logout();
    }

}