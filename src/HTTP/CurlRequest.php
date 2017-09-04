<?php
/**
 * This file is a part of apiclient package.
 * Author: Mateusz Westwalewicz
 * Date: 04.09.2017
 * Time: 09:24
 */

namespace Mattwoo\IsystemsClient\HTTP;

use Mattwoo\IsystemsClient\HTTP\Request\RequestInterface;

class CurlRequest
{

    /**
     * @var string
     */
    private $url;
    /**
     * @var string
     */
    private $method;
    /**
     * @var array
     */
    private $headers;
    /**
     * @var resource
     */
    private $curl;

    /**
     * @var array
     */
    private $requestContent;

    public function __construct(string $url, string $method, array $requestContent, array $headers)
    {
        $this->url = $url;
        $allowedMethods = [RequestInterface::METHOD_GET, RequestInterface::METHOD_POST];
        if (!in_array($method, $allowedMethods)) {
            throw new \InvalidArgumentException(
                sprintf('Invalid HTTP method %s given, allowed methods: %s', $method, join(',', $allowedMethods))
            );
        }
        $this->method = $method;
        $this->requestContent = $requestContent;
        $this->headers = $headers;
        $this->initialize();
    }

    public static function createFromRequestObject(RequestInterface $request): self
    {
        return new self($request->getUrl(), $request->getMethod(), $request->getContent(), $request->getHeaders());
    }

    private function initialize(): void
    {
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_URL, $this->url);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->curl, CURLOPT_HEADER, false);
        if ($this->isPostRequest()) {
            curl_setopt($this->curl, CURLOPT_POST, true);
            $requestContent = json_encode($this->requestContent);
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, $requestContent);
        } else {
            if (!empty($this->requestContent)) {
                $url = $this->url.'?'.http_build_query($this->requestContent);
                curl_setopt($this->curl, CURLOPT_URL, $url);
            }
        }
        if (count($this->headers) > 0) {
            $headers = [];
            /** @var HttpHeader $header */
            foreach ($this->headers as $header) {
                $headers[] = $header->asCurlHeaderString();
            }
            curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
        }
    }

    public function send(): CurlRequestResult
    {
        $content = curl_exec($this->curl);
        $httpCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
        curl_close($this->curl);

        return new CurlRequestResult($httpCode, $content);
    }

    public function isPostRequest(): bool
    {
        return RequestInterface::METHOD_POST === $this->method;
    }

    public function getCurl()
    {
        return $this->curl;
    }
}
