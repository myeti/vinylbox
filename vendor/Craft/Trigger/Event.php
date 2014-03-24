<?php

namespace Craft\Trigger;

trait Event
{

    /** @var array */
    protected $listeners = [];


    /**
     * Attach callback
     * @param string $event
     * @param callable $callable
     * @return $this
     */
    public function on($event, callable $callable)
    {
        $this->listeners[$event][] = $callable;
        return $this;
    }


    /**
     * Clear listener list
     * @param string $event
     * @return $this
     */
    public function off($event)
    {
        $this->listeners[$event] = [];
        return $this;
    }


    /**
     * Fire event
     * @param string $event
     * @param array $params
     * @return int
     */
    public function fire($event, array $params = [])
    {
        // fire * event
        if($event != '*') {
            array_unshift($params, $event);
            $this->fire('*', $params);
        }

        // no listeners
        if(!isset($this->listeners[$event])) {
            return false;
        }

        // trigger all listeners
        foreach($this->listeners[$event] as $callable){
            call_user_func_array($callable, $params);
        }

        // total triggered
        return count($this->listeners[$event]);
    }

}