<?php
require_once __DIR__.'/../vendor/autoload.php';

use Mattwoo\IsystemsClient\ApiClient;
use Mattwoo\IsystemsClient\HTTP\Request\GetAllProducersRequest;
use Mattwoo\IsystemsClient\HTTP\Request\UserCredentials;
use Mattwoo\IsystemsClient\HTTP\Response\GetAllProducersResponse;
use Mattwoo\IsystemsClient\HTTP\Request\RequestException;

$client = new ApiClient();

try {
    /** @var GetAllProducersResponse $response */
    $response = $client->sendRequest(new GetAllProducersRequest(new UserCredentials('username', 'password')));
    print_r($response->getProducers());
} catch (RequestException $e) {
    echo $e->getMessage();
}
