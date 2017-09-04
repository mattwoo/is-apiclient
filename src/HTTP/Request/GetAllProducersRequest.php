<?php
/**
 * This file is a part of apiclient package.
 * Author: Mateusz Westwalewicz
 * Date: 30.08.2017
 * Time: 16:11
 */

namespace Mattwoo\IsystemsClient\HTTP\Request;

class GetAllProducersRequest extends AbstractProducersRequest
{

    public function getMethod(): string
    {
        return RequestInterface::METHOD_GET;
    }

    public function getContent(): array
    {
        return [];
    }
}
