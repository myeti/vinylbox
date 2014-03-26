<?php

namespace Craft\Orm;

use Craft\Orm\Driver\MySQL;
use Craft\Orm\Driver\SQLite;

abstract class Syn
{

    /** jars priority */
    const MASTER = 'master.db';
    const SLAVE = 'slave.db';

    /** @var JarInterface[] */
    protected static $jars = [];

    /** @var int */
    protected static $use = self::MASTER;


    /**
     * Load jar as master
     * @param JarInterface $jar
     * @param string $as
     * @return \Craft\Orm\JarInterface
     */
    public static function load(JarInterface $jar, $as = self::MASTER)
    {
        static::$jars[$as] = $jar;
        return static::jar();
    }


    /**
     * Load jar as master
     * @param string $as
     * @throws \LogicException
     * @return JarInterface
     */
    public static function jar($as = null)
    {
        // set jar
        if($as) {
            static::$use = $as;
        }

        // no jar
        if(!isset(static::$jars[static::$use])) {
            throw new \LogicException('No jar [' . static::$use . '] loaded.');
        }

        return static::$jars[static::$use];
    }


    /**
     * Get entity
     * @param $entity
     * @return Jar\Bean
     */
    public static function get($entity)
    {
        return static::jar()->get($entity);
    }


    /**
     * Get many entities
     * @param $entity
     * @param array $where
     * @param null $sort
     * @param null $limit
     * @return array
     */
    public static function all($entity, array $where = [], $sort = null, $limit = null)
    {
        $jar = static::jar()->get($entity);

        foreach($where as $expression => $value) {
            $jar->where($expression, $value);
        }

        if($sort and is_array($sort)) {
            foreach($sort as $field => $sorting) {
                $jar->sort($field, $sorting);
            }
        }
        elseif($sort) {
            $jar->sort($sort);
        }

        if($limit and is_array($limit)) {
            $jar->limit($limit[0], $limit[1]);
        }
        elseif($limit) {
            $jar->limit($limit);
        }

        return $jar->all();
    }


    /**
     * Get one entities
     * @param $entity
     * @param array $where
     * @return mixed
     */
    public static function one($entity, $where = [])
    {
        if(!is_array($where)) {
            $where = ['id' => $where];
        }

        $jar = static::jar()->get($entity);

        foreach($where as $expression => $value) {
            $jar->where($expression, $value);
        }

        return $jar->one();
    }


    /**
     * Save entity
     * @param $entity
     * @param $data
     * @return int
     */
    public static function save($entity, $data)
    {
        // parse object
        if(is_object($data)) {
            $data = get_object_vars($data);
        }

        // insert
        if(empty($data['id'])) {
            return static::jar()->get($entity)->add($data);
        }

        // update
        return static::jar()->get($entity)->where('id', $data['id'])->set($data);
    }


    /**
     * Drop entity
     * @param $entity
     * @param $where
     * @return int
     */
    public static function drop($entity, $where = [])
    {
        if(!is_array($where)) {
            $where = ['id' => $where];
        }

        $jar = static::jar()->get($entity);

        foreach($where as $expression => $value) {
            $jar->where($expression, $value);
        }

        return $jar->drop();
    }


    /**
     * Setup mysql
     * @param string $dbname
     * @param array $config
     * @return \Craft\Orm\JarInterface
     */
    public static function MySQL($dbname, array $config = [])
    {
        // set config params
        $config = $config + [
            'host'      => 'localhost',
            'username'  => 'root',
            'password'  => null,
            'prefix'    => null,
        ];

        // create pdo
        $pdo = new MySQL($config['host'], $config['username'], $config['password'],  $dbname);

        // create jar
        $jar = new Jar($pdo, $config['prefix']);
        static::load($jar);

        return static::jar();
    }


    /**
     * Setup mysql
     * @param string $filename
     * @param string $prefix
     * @return \Craft\Orm\JarInterface
     */
    public static function SQLite($filename, $prefix = null)
    {
        $pdo = new SQLite($filename);
        $jar = new Jar($pdo, $prefix);
        static::load($jar);

        return static::jar();
    }

} 