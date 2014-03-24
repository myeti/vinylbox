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

class Response
{

    /** @var int */
    public $code = 200;

    /** @var string */
    public $format = 'text/html';

    /** @var array */
    public $headers = [];

    /** @var array */
    public $data = [];

    /** @var string */
    public $content = '';


    /**
     * New content response
     * @param string $content
     * @param int $code
     */
    public function __construct($content = '', $code = 200)
    {
        $this->content = $content;
        $this->code = $code;
    }


    /**
     * Set header
     * @param $name
     * @param $value
     */
    public function header($name, $value)
    {
        $this->headers[$name] = $value;
    }


    /**
     * Send response
     * @return string
     */
    public function __toString()
    {
        // can send headers
        if(!headers_sent()) {

            // set content type
            if(!isset($this->headers['Content-Type'])) {
                $this->header('Content-Type', $this->format . '; charset=UTF-8');
            }

            // set http code
            if(!Response\Code::get($this->code)) {
                $this->code = 418;
            }
            header('HTTP/1.1 ' . $this->code . ' ' . Response\Code::get($this->code), true, $this->code);

            // compile header
            foreach($this->headers as $name => $value) {
                header($name . ': ' . $value, false, $this->code);
            }

        }

        return $this->content ?: '';
    }

} 