<?php
/**
 * This file is a part of apiclient package.
 * Author: Mateusz Westwalewicz
 * Date: 30.08.2017
 * Time: 16:02
 */

namespace Mattwoo\IsystemsClient\HTTP\Request;

interface RequestInterface
{

    const METHOD_POST = 'POST';
    const METHOD_GET = 'GET';

    public function getMethod(): string;

    public function getUrl(): string;

    public function getHeaders(): array;

    public function getContent(): array;
}
