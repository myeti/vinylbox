<?php

namespace Craft\Orm;

use Craft\Reflect\Annotation;

class Jar implements JarInterface
{

    /** @var \PDO */
    protected $pdo;

    /** @var string */
    protected $prefix;

    /** @var Jar\Bean\EntityBuilder */
    protected $builder;

    /** @var array */
    protected $map = [];


    /**
     * Load pdo
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo, $prefix = null)
    {
        $this->pdo = $pdo;
        $this->prefix = $prefix;
        $this->builder = new Jar\Bean\EntityBuilder();
    }


    /**
     * Get inner pdo
     * @return \PDO
     */
    public function pdo()
    {
        return $this->pdo;
    }


    /**
     * Map entity class
     * @param $entity
     * @param $class
     */
    public function map($entity, $class)
    {
        $this->map[$entity] = $class;
        return $this;
    }


    /**
     * Create from models
     * @return bool
     */
    public function build()
    {
        $valid = true;
        foreach($this->map as $entity => $class) {

            // get props
            $fields = [];
            $props = get_class_vars($class);
            foreach($props as $prop => $null) {

                // get type
                $type = Annotation::property($class, $prop, 'var');
                $field = ['type' => $type];

                // index
                if($prop == 'id') {
                    $field['primary'] = true;
                }

                // make field
                $fields[$prop] = $field;
            }

            // create entity
            $valid &= $this->create($entity, $fields);
        }

        return $valid;
    }


    /**
     * Get lazy entity
     * @param $entity
     * @return Jar\Bean
     */
    public function get($entity)
    {
        $class = isset($this->map[$entity]) ? $this->map[$entity] : null;
        return new Jar\Bean($this->pdo, $this->prefix . $entity, $class);
    }


    /**
     * Create entity
     * @param $entity
     * @param array $fields
     * @return \PDOStatement
     */
    public function create($entity, array $fields)
    {
        // make sql
        $sql = $this->builder->create($this->prefix . $entity, $fields);

        return $this->pdo->query($sql)->rowCount();
    }


    /**
     * Drop entity
     * @param $entity
     * @return int
     */
    public function wipe($entity)
    {
        $sql = $this->builder->wipe($this->prefix . $entity);
        return $this->pdo->query($sql)->rowCount();
    }


    /**
     * Shorthand to get()
     * @param $entity
     * @return Jar\Bean
     */
    public function __invoke($entity)
    {
        return $this->get($entity);
    }

}