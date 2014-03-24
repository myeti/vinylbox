<?php
/**
 * This file is part of the Craft package.
 *
 * Copyright Aymeric Assier <aymeric.assier@gmail.com>
 *
 * For the full copyright and license information, please view the Licence.txt
 * file that was distributed with this source code.
 */
namespace Craft\Box\Native;

use Craft\Box\Provider\AuthInterface;
use Craft\Data\Provider\ProviderInterface;

class Auth implements AuthInterface
{

    /** @var ProviderInterface */
    protected $session;


    /**
     * Bind to session
     */
    public function __construct()
    {
        $this->session = new Session\Storage('craft/auth');
    }


    /**
     * Log user in
     * @param int $rank
     * @param mixed $user
     * @return bool
     */
    public function login($rank = 1, $user = null)
    {
        $this->session->set('rank', $rank);
        $this->session->set('user', $user);
    }


    /**
     * Get rank
     * @return int
     */
    public function rank()
    {
        return (int)$this->session->get('rank');
    }


    /**
     * Get user
     * @return mixed
     */
    public function user()
    {
        return $this->session->get('user');
    }


    /**
     * Log user out
     * @return bool
     */
    public function logout()
    {
        $this->session->clear();
    }

}