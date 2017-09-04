<?php
/**
 * This file is a part of apiclient package.
 * Author: Mateusz Westwalewicz
 * Date: 31.08.2017
 * Time: 16:43
 */

namespace Mattwoo\IsystemsClient\HTTP\Response;

use Mattwoo\IsystemsClient\HTTP\Request\CreateOneProducerRequest;
use Mattwoo\IsystemsClient\HTTP\Request\GetAllProducersRequest;
use Mattwoo\IsystemsClient\HTTP\Request\RequestInterface;

abstract class ResponseFactory
{

    private static $responseMap = [
        GetAllProducersRequest::class => GetAllProducersResponse::class,
        CreateOneProducerRequest::class => CreateOneProducerResponse::class,
    ];

    public static function getInstance(RequestInterface $request, int $statusCode, string $content): AbstractResponse
    {
        $requestClassName = get_class($request);
        if (!isset(self::$responseMap[$requestClassName])) {
            throw new \InvalidArgumentException(
                sprintf('Request class %s was not configured in %s', $requestClassName, __CLASS__)
            );
        }
        $className = self::$responseMap[$requestClassName];
        try {
            $reflection = new \ReflectionClass($className);
        } catch (\ReflectionException $e) {
            throw new \InvalidArgumentException(sprintf('Response class %s does not exist.', $className));
        }

        if (AbstractResponse::class !== $reflection->getParentClass()->getName()) {
            throw new \InvalidArgumentException(
                sprintf('Classes configured in %s must be child classes of %s.', __CLASS__, AbstractResponse::class)
            );
        }

        return new $className($statusCode, $content);
    }
}
