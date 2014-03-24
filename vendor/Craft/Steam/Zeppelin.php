<?php

namespace Craft\Steam;

use Craft\App\Kernel;
use Craft\App\Plugin;
use Craft\App\Request;
use Craft\Box\Mog;

class Zeppelin
{

    /** @var Kernel */
    protected $engine;

    /**
     * Setup airship
     * @param Kernel $engine
     */
    public function __construct(Kernel $engine = null)
    {
        $this->engine = $engine ?: new Kernel;
    }


    /**
     * Hire gear
     * @param Plugin $gear
     * @return $this
     */
    public function engage(Plugin $gear)
    {
        return $this->engine->plug($gear);
    }


    /**
     * Let's go captain !
     */
    public function fly()
    {
        return $this->engine->handle();
    }


    /**
     * Render steam template
     * @param $template
     * @return callable
     */
    public static function go($template)
    {
        return function(Request $request) use($template)
        {
            $path = str_replace(Mog::path(), '', __DIR__ . '/templates/' . $template);
            $request->meta['render'] = $path;
        };
    }

} 