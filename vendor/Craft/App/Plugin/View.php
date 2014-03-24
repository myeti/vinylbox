<?php

namespace Craft\App\Plugin;

use Craft\App\Plugin;
use Craft\App\Request;
use Craft\App\Response;
use Craft\Box\Mog;
use Craft\View\Engine;
use Craft\View\EngineInterface;
use Craft\View\Helper\Asset;
use Craft\View\Helper\Html;

class View extends Plugin
{

    /** @var Engine */
    protected $engine;


    /**
     * Setup engine
     * @param string $root
     */
    public function __construct($root = null)
    {
        if($root instanceof EngineInterface) {
            $this->engine = $root;
        }
        else {
            $this->engine = new Engine($root ?: Mog::path());
            $this->engine->mount(new Html);
            $this->engine->mount(new Asset(Mog::base()));
        }
    }


    /**
     * Handle response
     * @param Response $response
     * @param Request $request
     * @return Response
     */
    public function after(Request $request, Response $response = null)
    {
        // render if metadata provided
        if(!empty($request->meta['render'])) {
            $response->content = $this->engine->render($request->meta['render'], $response->data);
        }

        return $response;
    }

}