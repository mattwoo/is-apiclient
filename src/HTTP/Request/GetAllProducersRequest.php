<?php
/**
 * This file is a part of apiclient package.
 * Author: Mateusz Westwalewicz
 * Date: 30.08.2017
 * Time: 16:11
 */

namespace Mattwoo\IsystemsClient\HTTP\Request;

use Mattwoo\IsystemsClient\HTTP\HttpHeader;

class GetAllProducersRequest implements RequestInterface, AuthenticatedRequestInterface
{

    /**
     * @var UserCredentials
     */
    private $credentials;

    public function __construct(UserCredentials $credentials)
    {
        $this->credentials = $credentials;
    }

    public function getCredentials(): UserCredentials
    {
        return $this->credentials;
    }

    public function getMethod(): string
    {
        return RequestInterface::METHOD_GET;
    }

    public function getUrl(): string
    {
        return 'http://grzegorz.demos.i-sklep.pl/rest_api/shop_api/v1/producers';
    }

    public function getHeaders(): array
    {
        return [
            new HttpHeader('Accept-Language', 'pl-PL')
        ];
    }

    public function serializeContent(): array
    {
        return [];
    }
}
