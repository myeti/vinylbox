<?php
/**
 * This file is part of the Craft package.
 *
 * Copyright Aymeric Assier <aymeric.assier@gmail.com>
 *
 * For the full copyright and license information, please view the Licence.txt
 * file that was distributed with this source code.
 */
namespace Craft\Storage\File;

class GlobFinder extends \RecursiveIteratorIterator
{

    /**
     * Recursive glob file finder
     * @param string $in
     * @param string $glob
     * @param int $flags
     */
    public function __construct($in, $glob, $flags = \FilesystemIterator::SKIP_DOTS)
    {
        $path = rtrim($in, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . ltrim($glob, DIRECTORY_SEPARATOR);
        $directory = new \GlobIterator($path, $flags);
        parent::__construct($directory);
    }


    /**
     * Check if file exists
     * @param $in
     * @param $glob
     * @return bool
     */
    public static function find($in, $glob)
    {
        $iterator = new self($in, $glob);
        return $iterator->valid();
    }

}