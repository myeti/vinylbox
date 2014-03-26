<?php

namespace Craft\Orm\Jar\Bean;

class EntityBuilder
{

    /**
     * Create entity
     * @param $entity
     * @param array $fields
     * @return mixed
     */
    public function create($entity, array $fields)
    {
        // default opts
        $defaults = [
            'type'      => 'varchar(255)',
            'primary'   => false,
            'null'      => true,
            'default'   => 'null'
        ];

        // if not exists
        $sql = 'create table if not exists `' . $entity . '` (';

        // each field
        foreach($fields as $field => $type) {

            // full opts
            if(is_array($type)) {
                $opts = $type + $defaults;
            }
            // shorthand
            else {

                // fix varchar
                if($type == 'varchar') {
                    $type .= '(255)';
                }

                $opts = $defaults;
                $opts['type'] = $type;
            }

            // fix type
            $opts['type'] = trim($opts['type']);
            if($opts['type'] == 'string') {
                $opts['type'] = 'varchar(255)';
            }
            elseif($opts['type'] == 'int') {
                $opts['type'] = 'integer';
            }

            // add line
            $sql .= '`' . $field . '` ' . trim($opts['type']);

            // primary
            if($opts['primary']) {
                $sql .= ' primary key autoincrement';
                $opts['null'] = false;
                $opts['default'] = null;
            }

            // null
            if(!$opts['null']) {
                $sql .= ' not null';
            }

            // default
            if($opts['default']) {
                $sql .= ' default ' . $opts['default'];
            }

            // end of line
            $sql .= ',';
        }

        // end
        $sql = trim($sql, ',') . ')';

        return $sql;
    }


    /**
     * Remove entity
     * @param $entity
     * @return mixed
     */
    public function wipe($entity)
    {
        return 'drop table `' . $entity . '`';
    }

}