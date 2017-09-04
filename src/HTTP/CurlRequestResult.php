<?php
/**
 * This file is a part of apiclient package.
 * Author: Mateusz Westwalewicz
 * Date: 04.09.2017
 * Time: 10:09
 */

namespace Mattwoo\IsystemsClient\HTTP;

class CurlRequestResult
{
    /**
     * @var int
     */
    private $statusCode;
    /**
     * @var string
     */
    private $content;

    public function __construct(int $statusCode, string $content)
    {
        $this->statusCode = $statusCode;
        $this->content = $content;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}
