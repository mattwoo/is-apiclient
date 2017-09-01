<?php
/**
 * This file is a part of apiclient package.
 * Author: Mateusz Westwalewicz
 * Date: 31.08.2017
 * Time: 12:31
 */

namespace Mattwoo\IsystemsClient\HTTP\Response;

use Mattwoo\IsystemsClient\HTTP\Response\DTO\Producer;

class GetAllProducersResponse extends AbstractResponse
{
    /**
     * @return Producer[]
     * @throws ResponseParseException
     */
    public function getProducers(): array
    {
        $decoded = json_decode($this->content, true);
        if (null === $decoded) {
            throw new ResponseParseException('Response json could not be parsed: '.$this->content);
        }
        $producers = [];
        foreach ($decoded['data']['producers'] as $p) {
            $producers[] = new Producer(
                $p['id'],
                $p['name'],
                $p['site_url'],
                $p['logo_filename'],
                $p['ordering'],
                $p['source_id']
            );
        }

        return $producers;
    }
}
