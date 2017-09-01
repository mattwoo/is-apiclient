<?php
/**
 * This file is a part of apiclient package.
 * Author: Mateusz Westwalewicz
 * Date: 31.08.2017
 * Time: 16:30
 */

namespace Mattwoo\IsystemsClient\HTTP\Request;

use Mattwoo\IsystemsClient\HTTP\HttpHeader;
use Mattwoo\IsystemsClient\HTTP\Response\DTO\Producer;

class CreateOneProducerRequest implements RequestInterface, AuthenticatedRequestInterface
{

    /**
     * @var UserCredentials
     */
    private $credentials;
    /**
     * @var Producer
     */
    private $producer;

    public function __construct(UserCredentials $credentials, Producer $producer)
    {
        $this->credentials = $credentials;
        $this->producer = $producer;
    }

    public function getCredentials(): UserCredentials
    {
        return $this->credentials;
    }

    public function getMethod(): string
    {
        return RequestInterface::METHOD_POST;
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
        return [
            'producer' => [
                'id' => $this->producer->getId(),
                'name' => $this->producer->getName(),
                'site_url' => $this->producer->getSiteUrl(),
                'logo_filename' => $this->producer->getLogoFilename(),
                'ordering' => $this->producer->getOrdering(),
                'source_id' => $this->producer->getSourceId(),
            ],
        ];
    }
}
