<?php
/**
 * This file is a part of apiclient package.
 * Author: Mateusz Westwalewicz
 * Date: 04.09.2017
 * Time: 10:29
 */

namespace Mattwoo\IsystemsClient\HTTP\Auth;

use Mattwoo\IsystemsClient\HTTP\CurlRequest;

interface AuthorizationInterface
{
    public function authorize(CurlRequest $request): void;
}
