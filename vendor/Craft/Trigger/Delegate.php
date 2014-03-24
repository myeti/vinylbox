<?php

namespace Craft\Trigger;

trait Delegate
{

    /** @var EventInterface */
    protected $channel;

    /**
     * Attach listener
     * @param string $event
     * @param callable $listener
     */
    public function on($event, callable $listener)
    {
        $this->channel->on($event, $listener);
    }


    /**
     * Detach all event listeners
     * @param $event
     * @return mixed
     */
    public function off($event)
    {
        $this->channel->off($event);
    }


    /**
     * Trigger event
     * @param string $event
     * @param array $params
     * @return int
     */
    public function fire($event, array $params = [])
    {
        return $this->channel->fire($event, $params);
    }

} 