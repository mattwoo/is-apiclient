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

#####GetAllProducers

```php
use Mattwoo\IsystemsClient\ApiClient;
use Mattwoo\IsystemsClient\HTTP\Request\GetAllProducersRequest;
use Mattwoo\IsystemsClient\HTTP\Request\UserCredentials;
use Mattwoo\IsystemsClient\HTTP\Response\GetAllProducersResponse;
use Mattwoo\IsystemsClient\HTTP\Request\RequestException;

$client = new ApiClient();

try {
    /** @var GetAllProducersResponse $response */
    $response = $client->sendRequest(new GetAllProducersRequest(new UserCredentials('rest', 'vKTUeyrt')));
    print_r($response->getProducers());
} catch (RequestException $e) {
    echo $e->getMessage();
}
```

#####CreateOneProducer

```php
use Mattwoo\IsystemsClient\ApiClient;
use Mattwoo\IsystemsClient\HTTP\Request\CreateOneProducerRequest;
use Mattwoo\IsystemsClient\HTTP\Request\UserCredentials;
use Mattwoo\IsystemsClient\HTTP\Response\DTO\Producer;
use Mattwoo\IsystemsClient\HTTP\Request\RequestException;
use Mattwoo\IsystemsClient\HTTP\Response\CreateOneProducerResponse;

$credentials = new UserCredentials('rest', 'vKTUeyrt');
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

```