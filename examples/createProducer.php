<?php
require_once __DIR__.'/../vendor/autoload.php';

use Mattwoo\IsystemsClient\ApiClient;
use Mattwoo\IsystemsClient\HTTP\Request\CreateOneProducerRequest;
use Mattwoo\IsystemsClient\HTTP\Request\UserCredentials;
use Mattwoo\IsystemsClient\HTTP\Response\DTO\Producer;
use Mattwoo\IsystemsClient\HTTP\Request\RequestException;

$credentials = new UserCredentials('rest', 'vKTUeyrt');
$apiClient = new ApiClient();

$producer = new Producer(null, 'name', 'site.url', 'logo.png', 1, time());
$req = new CreateOneProducerRequest($credentials, $producer);
try {
    $resp = $apiClient->sendRequest($req);
    print_r($resp);
} catch (RequestException $e) {
    echo $e->getMessage();
}
