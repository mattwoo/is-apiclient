<?php
/**
 * This file is a part of apiclient package.
 * Author: Mateusz Westwalewicz
 * Date: 30.08.2017
 * Time: 15:57
 */

namespace Mattwoo\IsystemsClient;

use Mattwoo\IsystemsClient\HTTP\HttpHeader;
use Mattwoo\IsystemsClient\HTTP\Request\AuthenticatedRequestInterface;
use Mattwoo\IsystemsClient\HTTP\Request\RequestException;
use Mattwoo\IsystemsClient\HTTP\Request\RequestInterface;
use Mattwoo\IsystemsClient\HTTP\Response\AbstractResponse;
use Mattwoo\IsystemsClient\HTTP\Response\ResponseFactory;

class ApiClient
{

    private $curl;

    public function __construct()
    {
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($this->curl, CURLOPT_HEADER, 0);
    }

    public function sendRequest(RequestInterface $request): AbstractResponse
    {
        curl_setopt($this->curl, CURLOPT_URL, $request->getUrl());

        $isPostRequest = $request->getMethod() === RequestInterface::METHOD_POST;
        curl_setopt($this->curl, CURLOPT_POST, $isPostRequest);
        if ($isPostRequest) {
            $content = json_encode($request->serializeContent());
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, $content);
        }

        if ($request instanceof AuthenticatedRequestInterface) {
            curl_setopt($this->curl, CURLOPT_USERPWD, $request->getCredentials()->asCurlString());
        }

        $this->setHeaders($request->getHeaders());

        $responseContent = curl_exec($this->curl);
        $code = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
        curl_close($this->curl);

        return $this->handleResponse(ResponseFactory::getInstance(get_class($request), $code, $responseContent));
    }

    private function handleResponse(AbstractResponse $response): AbstractResponse
    {
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

    private function setHeaders(array $headers): void
    {
        $hdrs = [];
        /** @var HttpHeader $header */
        foreach ($headers as $header) {
            $hdrs[] = $header->asCurlHeaderString();
        }
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $hdrs);
    }
}
