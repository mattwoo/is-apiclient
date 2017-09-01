<?php
/**
 * This file is a part of apiclient package.
 * Author: Mateusz Westwalewicz
 * Date: 31.08.2017
 * Time: 10:13
 */

namespace Mattwoo\IsystemsClient\HTTP\Response;

abstract class AbstractResponse
{

    /**
     * @var int
     */
    protected $statusCode;
    /**
     * @var string
     */
    protected $content;

    public function __construct(int $statusCode, string $content)
    {
        $this->statusCode = $statusCode;
        $this->content = $content;
    }

    public function isSuccessful(): bool
    {
        return 200 === $this->statusCode;
    }

    public function getRawContent(): string
    {
        return $this->content;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
