<?php

namespace Craft\App\Plugin;

use Craft\App\Event\Forbidden;
use Craft\App\Plugin;
use Craft\App\Request;
use Craft\Box\Auth;

class Firewall extends Plugin
{

    /**
     * Handle request
     * @param Request $request
     * @throws \Craft\App\Event\Forbidden
     * @return Request
     */
    public function before(Request $request)
    {
        if(isset($request->meta['auth']) and Auth::rank() < $request->meta['auth']) {
            throw new Forbidden('User not allowed for query "' . $request->query . '"');
        }

        return $request;
    }

}