API client
========================

Example of api client
------------------------

Use in your project or create a simple example as below:
```
<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use OneGit\ApiClient\Client\ApiTradePayeerClient;
use OneGit\ApiClient\SecretGenerator\HashHmacSignGenerator;
use OneGit\ApiClient\Shared\SecretParamTransfer;
use OneGit\ApiClient\Client\Request\RequestBuilder;
use OneGit\ApiClient\Client\Response\ResponseMapper;

require_once __DIR__ . '/vendor/autoload.php';

$apiTradePayeer = new ApiTradePayeerClient(
    new Client(),
    new RequestBuilder(
        new HashHmacSignGenerator(),
        new SecretParamTransfer('KEY_TEST', 'ID_TEST'),
        Request::class,
    ),
    new ResponseMapper(),
);

$data = $apiTradePayeer->getInfo();

echo '<pre>';
var_dump($data);
```
