<?php
/**
 * This file is a part of apiclient package.
 * Author: Mateusz Westwalewicz
 * Date: 30.08.2017
 * Time: 15:57
 */

namespace Mattwoo\IsystemsClient;

use Mattwoo\IsystemsClient\HTTP\Auth\AuthorizationInterface;
use Mattwoo\IsystemsClient\HTTP\CurlRequest;
use Mattwoo\IsystemsClient\HTTP\Request\RequestException;
use Mattwoo\IsystemsClient\HTTP\Request\RequestInterface;
use Mattwoo\IsystemsClient\HTTP\Response\AbstractResponse;
use Mattwoo\IsystemsClient\HTTP\Response\ResponseFactory;

class ApiClient
{

    /**
     * @var CurlRequest
     */
    private $curlRequest;
    /**
     * @var RequestInterface
     */
    private $request;

    public function __construct(RequestInterface $request, ?AuthorizationInterface $authorization = null)
    {
        $this->request = $request;
        $this->curlRequest = CurlRequest::createFromRequestObject($request);
        if (null !== $authorization) {
            $authorization->authorize($this->curlRequest);
        }
    }

    public function sendRequest(): AbstractResponse
    {
        $result = $this->curlRequest->send();
        $response = ResponseFactory::getInstance($this->request, $result->getStatusCode(), $result->getContent());
        if (!$response->isSuccessful()) {
            $decoded = json_decode($response->getRawContent(), true);
            $errorMsg = $response->getRawContent();
            if (null !== $decoded && isset($decoded['error']['messages'])) {
                $errorMsg = join(', ', $decoded['error']['messages']);
            }
            throw new RequestException($response->getStatusCode(), $errorMsg);
        }

        return $response;
    }
}
