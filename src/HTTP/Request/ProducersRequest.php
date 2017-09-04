<?php
/**
 * This file is a part of apiclient package.
 * Author: Mateusz Westwalewicz
 * Date: 04.09.2017
 * Time: 09:24
 */

namespace Mattwoo\IsystemsClient\HTTP\Request;

use Mattwoo\IsystemsClient\HTTP\HttpHeader;

abstract class ProducersRequest implements RequestInterface
{

    /**
     * @var string
     */
    protected $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getHeaders(): array
    {
        return [
            new HttpHeader('Accept-Language', 'pl-PL'),
        ];
    }
}
