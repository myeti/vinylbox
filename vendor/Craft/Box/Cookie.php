<?php
/**
 * This file is part of the Craft package.
 *
 * Copyright Aymeric Assier <aymeric.assier@gmail.com>
 *
 * For the full copyright and license information, please view the Licence.txt
 * file that was distributed with this source code.
 */
namespace Craft\Box;

use Craft\Data\Provider;
use Craft\Data\Provider\Container;
use Craft\Data\Provider\Container\Swap;

abstract class Cookie extends Container
{

    use Swap;

    /**
     * Create provider instance
     * @return Provider
     */
    protected static function bind()
    {
        return new Native\Cookie();
    }

} 