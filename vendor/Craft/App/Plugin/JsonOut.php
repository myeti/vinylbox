<?php

namespace Craft\App\Plugin;

use Craft\App\Plugin;
use Craft\App\Request;
use Craft\App\Response;

class JsonOut extends Plugin
{

    /**
     * Render data as json
     * @param Request $request
     * @param Response $response
     * @return Response|void
     */
    public function after(Request $request, Response $response)
    {
        $response->content = json_encode($response->data, JSON_PRETTY_PRINT);
    }

} 