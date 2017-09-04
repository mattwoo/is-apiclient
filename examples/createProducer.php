<?php
require_once __DIR__.'/../vendor/autoload.php';

use Mattwoo\IsystemsClient\HTTP\Auth\BasicAuth;
use Mattwoo\IsystemsClient\HTTP\Request\UserCredentials;
use Mattwoo\IsystemsClient\HTTP\Request\CreateOneProducerRequest;
use Mattwoo\IsystemsClient\HTTP\Response\DTO\Producer;
use Mattwoo\IsystemsClient\ApiClient;

$credentials = new UserCredentials('rest', 'vKTUeyrt');
$basicAuth = new BasicAuth($credentials);

$url = 'http://grzegorz.demos.i-sklep.pl/rest_api/shop_api/v1/producers';
$producer = new Producer(null, 'name', 'site.url', 'logo.png', 1, time());

$request = new CreateOneProducerRequest($producer, $url);
$apiClient = new ApiClient($request, $basicAuth);
try {
    $resp = $apiClient->sendRequest();
    print_r($resp);
} catch (\Exception $e) {
    echo $e->getMessage();
}
