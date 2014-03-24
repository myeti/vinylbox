<?php
/**
 * This file is part of the Craft package.
 *
 * Copyright Aymeric Assier <aymeric.assier@gmail.com>
 *
 * For the full copyright and license information, please view the Licence.txt
 * file that was distributed with this source code.
 */
namespace Craft\Box\Provider;

interface AuthInterface
{

    /**
     * Log user in
     * @param int $rank
     * @param mixed $user
     * @return bool
     */
    public function login($rank = 1, $user = null);


    /**
     * Get rank
     * @return int
     */
    public function rank();


    /**
     * Get user
     * @return mixed
     */
    public function user();


    /**
     * Log user out
     * @return bool
     */
    public function logout();

} 