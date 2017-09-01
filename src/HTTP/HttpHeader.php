<?php
/**
 * This file is a part of apiclient package.
 * Author: Mateusz Westwalewicz
 * Date: 31.08.2017
 * Time: 10:08
 */

namespace Mattwoo\IsystemsClient\HTTP;

class HttpHeader
{
    /**
     * @var string
     */
    private $key;
    /**
     * @var string
     */
    private $value;

    public function __construct(string $key, string $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    public function asCurlHeaderString(): string
    {
        return sprintf('%s: %s', $this->key, $this->value);
    }
}
