<?php
/**
 * This file is part of the Craft package.
 *
 * Copyright Aymeric Assier <aymeric.assier@gmail.com>
 *
 * For the full copyright and license information, please view the Licence.txt
 * file that was distributed with this source code.
 */
namespace Craft\Trace;

use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;

class Tracker extends AbstractLogger implements TrackerInterface
{

    /** @var Log[] */
    protected $logs = [];

    /** @var Task[] */
    protected $tasks = [];

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function emergency($message, array $context = [])
    {
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }


    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function alert($message, array $context = [])
    {
        $this->log(LogLevel::ALERT, $message, $context);
    }


    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function critical($message, array $context = [])
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }


    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function error($message, array $context = [])
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }


    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function warning($message, array $context = [])
    {
        $this->log(LogLevel::WARNING, $message, $context);
    }


    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function notice($message, array $context = [])
    {
        $this->log(LogLevel::NOTICE, $message, $context);
    }


    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function info($message, array $context = [])
    {
        $this->log(LogLevel::INFO, $message, $context);
    }


    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function debug($message, array $context = [])
    {
        $this->log(LogLevel::DEBUG, $message, $context);
    }


    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     */
    public function log($level, $message, array $context = [])
    {
        $this->logs[] = new Log($level, $message);
    }


    /**
     * Get all logs
     * @return Log[]
     */
    public function logs()
    {
        return $this->logs;
    }


    /**
     * Start tracking
     * @param $process
     */
    public function start($process)
    {
        $this->tasks[$process] = new Task($process);
    }


    /**
     * Stop tracking
     * @param $process
     * @return Task
     * @throws \InvalidArgumentException
     */
    public function end($process)
    {
        if(!isset($this->tasks[$process])) {
            throw new \InvalidArgumentException('Unknown process "' . $process . '".');
        }

        $this->tasks[$process]->end();
        return $this->tasks[$process];
    }


    /**
     * Monitor action
     * @param $process
     * @param callable $subject
     * @return array
     */
    public function monitor($process, callable $subject)
    {
        $this->start($process);
        call_user_func($subject);
        return $this->end($process);
    }


    /**
     * Get all tasks
     * @return Task[]
     */
    public function tasks()
    {
        return $this->tasks;
    }


    /**
     * Basic report
     * @return string
     */
    public function __toString()
    {
        $string = '';

        foreach($this->tasks() as $task) {
            $string .= $task->report() . '<br/>';
        }

        foreach($this->logs() as $log) {
            $string .= $log . '<br/>';
        }

        return $string;
    }

}