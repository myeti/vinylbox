<?php

namespace Craft\Orm;

interface JarInterface
{

    /**
     * Get inner pdo
     * @return \PDO
     */
    public function pdo();

    /**
     * Map entity class
     * @param $entity
     * @param $class
     * @return $this
     */
    public function map($entity, $class);

    /**
     * Create from models
     * @return bool
     */
    public function build();

    /**
     * Get lazy entity
     * @param $entity
     * @return Jar\Bean
     */
    public function get($entity);

    /**
     * Create entity
     * @param $entity
     * @param array $fields
     * @return \PDOStatement
     */
    public function create($entity, array $fields);

    /**
     * Drop entity
     * @param $entity
     * @return int
     */
    public function wipe($entity);

} 