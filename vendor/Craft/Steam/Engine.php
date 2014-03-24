<?php

namespace Craft\Steam;

use Craft\App\Kernel;
use Craft\App\Plugin;

class Engine extends Kernel
{

    /**
     * Engage crew
     * @param Plugin $gear
     * @return $this
     */
    public function engage(Plugin $gear)
    {
        return $this->plug($gear);
    }


    /**
     * Listen on problem
     * @param $error
     * @param $to
     * @return $this
     */
    public function fail($error, $to)
    {
        return $this->on($error, function() use($to){
            $this->to($to);
        });
    }

} 