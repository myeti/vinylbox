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

class Task extends \ArrayObject
{

    /** @var string */
    public $name;

    /** @var float */
    public $base;

    /** @var array */
    public $data = [];

    /** @var bool */
    public $running = true;


    /**
     * Start task tracking
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->base = microtime(true);
        $this->step('start');
    }


    /**
     * Add step
     * @param string $label
     * @throws \LogicException
     */
    public function step($label = null)
    {
        if(!$this->running) {
            throw new \LogicException('Task is over, cannot add step.');
        }

        $this->data[] = [
            'label'  => $label,
            'time'   => microtime(true) - $this->base,
            'memory' => memory_get_usage(true)
        ];
    }


    /**
     * Stop task tracking
     * return array|bool
     */
    public function end()
    {
        if(!$this->running) {
            throw new \LogicException('Task is already over.');
        }

        $this->step('end');
        $this->running = false;

        return $this->total();
    }


    /**
     * calculate total data
     * @return array
     * @throws \LogicException
     */
    public function total()
    {
        if($this->running) {
            throw new \LogicException('Task is running, cannot make report.');
        }

        // get boundaries
        $first = $this->data[0];
        $last = $this->data[count($this->data) - 1];

        return (object)[
            'time'   => $last['time'] - $first['time'],
            'memory' => $last['memory'] - $first['memory']
        ];
    }


    /**
     * Get current state
     * @throws \LogicException
     * @return array
     */
    public function report()
    {
        // get boundaries
        $total = $this->total();

        // make string
        $string = '# ' . $this->name . ' : ';
        $string .= number_format($total->time, 4) . 'ms / ';
        $string .= ($total->memory / 1024) . 'ko ';

        return $string;
    }

} 