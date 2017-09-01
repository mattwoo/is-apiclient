<?php
require_once __DIR__.'/../vendor/autoload.php';

use Mattwoo\IsystemsClient\ApiClient;
use Mattwoo\IsystemsClient\HTTP\Request\CreateOneProducerRequest;
use Mattwoo\IsystemsClient\HTTP\Request\UserCredentials;
use Mattwoo\IsystemsClient\HTTP\Response\DTO\Producer;
use Mattwoo\IsystemsClient\HTTP\Request\RequestException;
use Mattwoo\IsystemsClient\HTTP\Response\CreateOneProducerResponse;

$credentials = new UserCredentials('username', 'password');
$apiClient = new ApiClient();

$producer = new Producer(null, 'name', 'site.url', 'logo.png', 1, time());
$req = new CreateOneProducerRequest($credentials, $producer);
try {
    /** @var CreateOneProducerResponse $resp */
    $resp = $apiClient->sendRequest($req);
    print_r($resp->getProducer());
} catch (RequestException $e) {
    echo $e->getMessage();
}
