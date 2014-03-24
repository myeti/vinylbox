<?php

namespace My\Logic\Preset;

use Craft\Box\Auth;
use Craft\Box\Flash;
use My\Model\User;

class AuthUser
{

    /**
     * Attempt login
     * @render views/auth.login
     * @return mixed
     */
    public function login()
    {
        // login submitted
        if(post())
        {
            // extract env
            $username = post('username');
            $password = post('username');

            // find user
            $user = User::one([
                'username' => $username,
                'password' => sha1($password)
            ]);

            // user exists
            if($user) {

                // remove password for security
                $user->password = null;

                // login
                Auth::login(1, $user);
                Flash::set('login.success', 'Welcome ' . $username . ' !');
                go('/');

            }
            else {
                Flash::set('login.fail', 'Bad user data.');
            }
        }

    }


    /**
     * Logout current user
     */
    public function logout()
    {
        Auth::logout();
        go('/');
    }


    /**
     * Register new user
     * @render views/auth.register
     * @return array
     */
    public function register()
    {
        // create user
        $user = new User();

        // register attempt
        if($data = post()) {

            // remove rank injection
            unset($data['rank']);

            // find user
            $exists = User::one([
                'username' => post('username')
            ]);

            // create user
            $user = hydrate($user, $data);

            // check if user already exists
            if($exists) {
                Flash::set('register.failed', 'Username already exists.');
            }
            // create + autologin
            else {
                User::save($user);
                Auth::login(1, $user);
                Flash::set('register.success', 'Welcome, ' . $user->username . '.');
                go('/');
            }

        }

        return ['user' => $user];
    }

} 