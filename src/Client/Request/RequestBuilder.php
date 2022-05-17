<?php

declare(strict_types=1);

namespace OneGit\ApiClient\Client\Request;

use OneGit\ApiClient\SecretGenerator\SignGeneratorInterface;
use OneGit\ApiClient\Shared\SecretParamTransfer;
use Psr\Http\Message\RequestInterface;

/**
 * Class RequestBuilder
 * @package OneGit\ApiClient\Client\Request
 */
class RequestBuilder implements RequestBuilderInterface
{
    protected const BASE_API_URL = 'https://payeer.com/api/trade/';

    /**
     * RequestBuilder constructor.
     * @param SignGeneratorInterface $signGenerator
     * @param SecretParamTransfer $secretParamTransfer
     * @param string $requestClassName
     * @param string $baseApiUrl
     */
    public function __construct(
        protected SignGeneratorInterface $signGenerator,
        protected SecretParamTransfer $secretParamTransfer,
        protected string $requestClassName,
        protected string $baseApiUrl = self::BASE_API_URL,
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function build(string $resourcePath, array $post = []): RequestInterface
    {
        $uri = $this->getUri($resourcePath);
        $post = $this->getBody($post);
        $headers = $this->getHeaders($resourcePath . json_encode($post));

        return new $this->requestClassName('POST', $uri, $headers, json_encode($post));
    }

    /**
     * @param string $resourcePath
     * @return string
     */
    protected function getUri(string $resourcePath): string
    {
        return $this->baseApiUrl . $resourcePath;
    }

    /**
     * @param array $post
     * @return array
     */
    protected function getBody(array $post): array
    {
        $post['ts'] = round(microtime(true) * 1000);

        return $post;
    }

    /**
     * @param string $data
     * @return string[]
     */
    protected function getHeaders(string $data): array
    {
        return [
            'Content-Type: application/json',
            'API-ID: ' . $this->secretParamTransfer->getId(),
            'API-SIGN: ' . $this->signGenerator->getSign(data: $data, key: $this->secretParamTransfer->getKey()),
        ];
    }
}
