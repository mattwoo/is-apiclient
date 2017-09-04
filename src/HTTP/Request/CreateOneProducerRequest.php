<?php
/**
 * This file is a part of apiclient package.
 * Author: Mateusz Westwalewicz
 * Date: 31.08.2017
 * Time: 16:30
 */

namespace Mattwoo\IsystemsClient\HTTP\Request;

use Mattwoo\IsystemsClient\HTTP\Response\DTO\Producer;

class CreateOneProducerRequest extends ProducersRequest
{

    /**
     * @var Producer
     */
    private $producer;

    public function __construct(Producer $producer, string $url)
    {
        parent::__construct($url);
        $this->producer = $producer;
    }

    public function getMethod(): string
    {
        return RequestInterface::METHOD_POST;
    }

    public function getContent(): array
    {
        return [
            'producer' => $this->producer->jsonSerialize(),
        ];
    }
}
