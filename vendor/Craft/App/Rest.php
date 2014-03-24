<?php

namespace Craft\App;

class Rest extends Kernel
{

    /**
     * Package ready to use
     * @param array $routes
     */
    public function __construct(array $routes)
    {
        $this->plug(new Plugin\Router($routes));
        $this->plug(new Plugin\Metadata);
        $this->plug(new Plugin\Firewall);
        $this->plug(new Plugin\JsonOut);
    }

} 