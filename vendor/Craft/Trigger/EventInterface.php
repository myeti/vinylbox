<?php

namespace Craft\Trigger;

interface EventInterface
{

    /**
     * Attach listener
     * @param string $event
     * @param callable $listener
     */
    public function on($event, callable $listener);


    /**
     * Detach all event listeners
     * @param $event
     * @return mixed
     */
    public function off($event);


    /**
     * Trigger event
     * @param string $event
     * @param array $params
     * @return int
     */
    public function fire($event, array $params = []);

} 