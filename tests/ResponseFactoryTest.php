<?php
/**
 * This file is a part of apiclient package.
 * Author: Mateusz Westwalewicz
 * Date: 01.09.2017
 * Time: 10:48
 */

namespace Mattwoo\IsystemsClient;

use Mattwoo\IsystemsClient\HTTP\Request\GetAllProducersRequest;
use Mattwoo\IsystemsClient\HTTP\Response\GetAllProducersResponse;
use Mattwoo\IsystemsClient\HTTP\Response\ResponseFactory;
use PHPUnit\Framework\TestCase;

class ResponseFactoryTest extends TestCase
{

    public function testReturnsCorrectResponseObject()
    {
        $respContent = 'Respcontent';
        /** @var GetAllProducersResponse $res */
        $res = ResponseFactory::getInstance(new GetAllProducersRequest('asd'), 200, $respContent);

        $this->assertInstanceOf(GetAllProducersResponse::class, $res);
        $this->assertTrue($res->isSuccessful());
        $this->assertEquals($respContent, $res->getRawContent());
    }
}
