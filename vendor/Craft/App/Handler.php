<?php
/**
 * This file is part of the Craft package.
 *
 * Copyright Aymeric Assier <aymeric.assier@gmail.com>
 *
 * For the full copyright and license information, please view the Licence.txt
 * file that was distributed with this source code.
 */
namespace Craft\App;

interface Handler
{

    /**
     * Handle context request
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request);

} 