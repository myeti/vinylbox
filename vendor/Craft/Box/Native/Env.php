<?php

namespace Craft\Box\Native;

use Craft\Data\Repository;

class Env extends Repository
{

    /**
     * Create provider instance
     */
    public function __construct()
    {
        parent::__construct($_ENV);
    }


    /**
     * Set and save
     * @param $key
     * @param $value
     * @return bool|void
     */
    public function set($key, $value)
    {
        parent::set($key, $value);
        $this->save();
    }


    /**
     * Drop and save
     * @param $key
     * @return bool|void
     */
    public function drop($key)
    {
        parent::drop($key);
        $this->save();
    }


    /**
     * Clear and save
     * @return bool|void
     */
    public function clear()
    {
        parent::clear();
        $this->save();
    }


    /**
     * Replicate inner data into external source
     * @return mixed
     */
    protected function save()
    {
        $_ENV = $this->all();
    }


    /**
     * Get or set timezone
     * @param string $timezone
     * @return string
     */
    public static function timezone($timezone = null)
    {
        if($timezone) {
            date_default_timezone_set($timezone);
        }

        return date_default_timezone_get();
    }


    /**
     * Get or set locale
     * @param $lang
     * @return string
     */
    public static function locale($lang = null)
    {
        if($lang) {
            setlocale(LC_ALL, $lang);
            locale_set_default($lang);
        }

        return locale_get_default();
    }

}