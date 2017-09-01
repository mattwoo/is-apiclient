<?php
/**
 * This file is a part of apiclient package.
 * Author: Mateusz Westwalewicz
 * Date: 01.09.2017
 * Time: 10:06
 */

namespace Mattwoo\IsystemsClient\HTTP\Response;

use Mattwoo\IsystemsClient\HTTP\Response\DTO\Producer;

class CreateOneProducerResponse extends AbstractResponse
{
    public function getProducer(): ?Producer
    {
        $decoded = json_decode($this->content, true);

        return Producer::createByArray($decoded['data']['producer']);
    }
}
