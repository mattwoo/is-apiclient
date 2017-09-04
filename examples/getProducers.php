<?php
require_once __DIR__.'/../vendor/autoload.php';

use Mattwoo\IsystemsClient\ApiClient;
use Mattwoo\IsystemsClient\HTTP\Request\GetAllProducersRequest;
use Mattwoo\IsystemsClient\HTTP\Request\UserCredentials;
use Mattwoo\IsystemsClient\HTTP\Response\GetAllProducersResponse;
use Mattwoo\IsystemsClient\HTTP\Auth\BasicAuth;

$credentials = new UserCredentials('username', 'password');
$basicAuth = new BasicAuth($credentials);

$url = 'http://grzegorz.demos.i-sklep.pl/rest_api/shop_api/v1/producers';

$request = new GetAllProducersRequest($url);
$apiClient = new ApiClient($request, $basicAuth);
try {
    /** @var GetAllProducersResponse $resp */
    $resp = $apiClient->sendRequest();
    print_r($resp->getProducers());
} catch (\Exception $e) {
    echo $e->getMessage();
}

