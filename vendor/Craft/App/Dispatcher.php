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

class Dispatcher implements Handler
{

    /**
     * Run on request
     * @param Request $request
     * @throws \BadMethodCallException
     * @return Response
     */
    public function handle(Request $request)
    {
        // not a valid callable
        if(!is_callable($request->action)) {
            throw new \BadMethodCallException('Request::action must be a valid callable.');
        }

        // add request in args
        $args = $request->args;
        $args[] = &$request;

        // run
        $data = call_user_func_array($request->action, $args);

        // create response
        $response = new Response();
        $response->data = $data;

        return $response;
    }

}

