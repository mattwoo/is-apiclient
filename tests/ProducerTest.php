<?php
/**
 * This file is a part of apiclient package.
 * Author: Mateusz Westwalewicz
 * Date: 01.09.2017
 * Time: 11:10
 */

namespace Mattwoo\IsystemsClient;

use Mattwoo\IsystemsClient\HTTP\Response\DTO\Producer;
use PHPUnit\Framework\TestCase;

class ProducerTest extends TestCase
{

    public function testCreatesByArray()
    {
        $producer = Producer::createByArray(
            [
                'id' => 1,
                'name' => 'name',
                'site_url' => 'siteurl',
                'logo_filename' => 'logo.jpg',
                'ordering' => 5,
                'source_id' => 'srcid',
            ]
        );

        $this->assertInstanceOf(Producer::class, $producer);
        $this->assertEquals(1, $producer->getId());
        $this->assertEquals('name', $producer->getName());
        $this->assertEquals('siteurl', $producer->getSiteUrl());
        $this->assertEquals('logo.jpg', $producer->getLogoFilename());
        $this->assertEquals(5, $producer->getOrdering());
        $this->assertEquals('srcid', $producer->getSourceId());
    }
}
