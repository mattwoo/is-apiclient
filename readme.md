i-systems producers api client
==============================

### Installaton


```bash
$ composer require mattwoo/is-apiclient
```

### Running tests:

```bash
$ php vendor/bin/phpunit -c phpunit.xml.dist
```

### Usage

GetAllProducers

```php
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
```


```php
use Mattwoo\IsystemsClient\HTTP\Auth\BasicAuth;
use Mattwoo\IsystemsClient\HTTP\Request\UserCredentials;
use Mattwoo\IsystemsClient\HTTP\Request\CreateOneProducerRequest;
use Mattwoo\IsystemsClient\HTTP\Response\DTO\Producer;
use Mattwoo\IsystemsClient\ApiClient;

$credentials = new UserCredentials('username', 'password');
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


```