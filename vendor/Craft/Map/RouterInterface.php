<?php

namespace Craft\Map;

interface RouterInterface
{

    /**
     * Make route from path
     * @param string $from
     * @param mixed $to
     * @param array $customs
     * @return $this
     */
    public function map($from, $to, array $customs = []);


    /**
     * Add route
     * @param Route $route
     * @return $this
     */
    public function add(Route $route);


    /**
     * Get all routes
     * @return Route[]
     */
    public function routes();


    /**
     * Find route
     * @param string $query
     * @param array $customs
     * @param mixed $fallback
     * @return Route
     */
    public function find($query, array $customs = [], $fallback = null);

} 