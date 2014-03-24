<?php

namespace Craft\Orm\Jar;

interface BeanInterface
{

    /**
     * Add where clause
     * @param $expression
     * @param mixed $value
     * @return $this
     */
    public function where($expression, $value = null);

    /**
     * Sort data
     * @param $field
     * @param int $sort
     * @return $this
     */
    public function sort($field, $sort = SORT_ASC);

    /**
     * Limit rows
     * @param int $i
     * @param int $step
     * @return $this
     */
    public function limit($i, $step = 0);

    /**
     * Get many rows
     * @return array
     */
    public function all();

    /**
     * Get first row
     * @return mixed
     */
    public function one();

    /**
     * Set entity data
     * @param $data
     * @return int
     */
    public function add($data);

    /**
     * Set entity data
     * @param $data
     * @return int
     */
    public function set($data);

    /**
     * Drop entity
     * @return int
     */
    public function drop();

}