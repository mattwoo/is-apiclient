<?php
/**
 * This file is a part of apiclient package.
 * Author: Mateusz Westwalewicz
 * Date: 04.09.2017
 * Time: 10:33
 */

namespace Mattwoo\IsystemsClient\HTTP\Auth;

use Mattwoo\IsystemsClient\HTTP\CurlRequest;
use Mattwoo\IsystemsClient\HTTP\Request\UserCredentials;

class BasicAuth implements AuthorizationInterface
{

    /**
     * @var UserCredentials
     */
    private $credentials;

    public function __construct(UserCredentials $credentials)
    {
        $this->credentials = $credentials;
    }

    public function authorize(CurlRequest $curlRequest): void
    {
        $curl = $curlRequest->getCurl();
        curl_setopt($curl, CURLOPT_USERPWD, $this->credentials->asCurlString());
    }
}
