<?php
/**
 * This file is a part of apiclient package.
 * Author: Mateusz Westwalewicz
 * Date: 01.09.2017
 * Time: 09:57
 */

namespace Mattwoo\IsystemsClient\HTTP\Request;

class RequestException extends \Exception
{
    public function __construct(int $statusCode, string $content)
    {
        $message = sprintf('Got http code %d with message "%s"', $statusCode, $content);
        parent::__construct($message);
    }
}
