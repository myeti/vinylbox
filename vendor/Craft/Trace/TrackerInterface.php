<?php

namespace Craft\Trace;

use Psr\Log\LoggerInterface;

interface TrackerInterface extends LoggerInterface
{

    /**
     * Monitor callable
     * @param string $process
     * @param callable $action
     * @return Task
     */
    public function monitor($process, callable $action);

    /**
     * Start tracking
     * @param string $process
     */
    public function start($process);

    /**
     * Stop tracking
     * @param string $process
     * @return Task
     */
    public function end($process);

} 