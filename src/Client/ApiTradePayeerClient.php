<?php

declare(strict_types=1);

namespace OneGit\ApiClient\Client;

use Exception;
use OneGit\ApiClient\Client\Request\RequestBuilderInterface;
use OneGit\ApiClient\Client\Response\ResponseMapperInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;

/**
 * Class ApiTradePayeerClient
 * @package OneGit\ApiClient\Client
 */
class ApiTradePayeerClient implements ApiClientInterface
{
    public const METHOD_TIME = 'time';
    public const METHOD_INFO = 'info';
    public const METHOD_TICKER = 'ticker';
    public const METHOD_ORDERS = 'orders';
    public const METHOD_TRADES = 'trades';

    public const METHOD_ACCOUNT = 'account';
    public const METHOD_ORDER_CREATE = 'order_create';
    public const METHOD_ORDER_STATUS = 'order_status';
    public const METHOD_ORDER_CANCEL = 'order_cancel';
    public const METHOD_ORDERS_CANCEL = 'orders_cancel';
    public const METHOD_MY_ORDERS = 'my_orders';
    public const METHOD_MY_HISTORY = 'my_history';
    public const METHOD_MY_TRADES = 'my_trades';

    public const DEFAULT_PAIR = 'BTC_USDT';

    /**
     * ApiTradePayeerClient constructor.
     * @param ClientInterface $client
     * @param RequestBuilderInterface $requestBuilder
     * @param ResponseMapperInterface $responseMapper
     */
    public function __construct(
        protected ClientInterface $client,
        protected RequestBuilderInterface $requestBuilder,
        protected ResponseMapperInterface $responseMapper,
    )
    {
    }

    /**
     * @return array
     * @throws ClientExceptionInterface
     */
    public function getTime(): array
    {
        return $this->send(self::METHOD_TIME);
    }

    /**
     * @param string|null $pair
     * @return array
     * @throws ClientExceptionInterface
     */
    public function getInfo(string $pair = null): array
    {
        $response = $this->send(self::METHOD_INFO, $pair ? ['pair' => $pair] : []);

        return $response['pairs'];
    }

    /**
     * @param string $pair
     * @return array
     * @throws ClientExceptionInterface
     */
    public function getTicker(string $pair = self::DEFAULT_PAIR): array
    {
        $response = $this->send(self::METHOD_TICKER, ['pair' => $pair]);

        return $response['pairs'];
    }

    /**
     * @param string $pair
     * @return array
     * @throws ClientExceptionInterface
     */
    public function getOrders(string $pair = self::DEFAULT_PAIR): array
    {
        $response = $this->send(self::METHOD_ORDERS, ['pair' => $pair]);

        return $response['pairs'];
    }

    /**
     * @param string $pair
     * @return array
     * @throws ClientExceptionInterface
     */
    public function getTrades(string $pair = self::DEFAULT_PAIR): array
    {
        $response = $this->send(self::METHOD_TRADES, ['pair' => $pair]);

        return $response['pairs'];
    }

    /**
     * @return array
     * @throws ClientExceptionInterface
     */
    public function getAccount(): array
    {
        $response = $this->send(self::METHOD_ACCOUNT);

        return $response['balances'];
    }

    /**
     * @param array $post
     * @return array
     * @throws ClientExceptionInterface
     */
    public function getOrderCreate(array $post = []): array
    {
        return $this->send(self::METHOD_ORDER_CREATE, $post);
    }

    /**
     * @param array $post
     * @return array
     * @throws ClientExceptionInterface
     */
    public function getOrderStatus(array $post = []): array
    {
        $response = $this->send(self::METHOD_ORDER_STATUS, $post);

        return $response['order'];
    }

    /**
     * @param array $post
     * @return array
     * @throws ClientExceptionInterface
     */
    public function getOrderCancel(array $post = []): array
    {
        return $this->send(self::METHOD_ORDER_CANCEL, $post);
    }

    /**
     * @param array $post
     * @return array
     * @throws ClientExceptionInterface
     */
    public function getOrdersCancel(array $post = []): array
    {
        $response = $this->send(self::METHOD_ORDERS_CANCEL, $post);

        return $response['items'];
    }

    /**
     * @param array $post
     * @return array
     * @throws ClientExceptionInterface
     */
    public function getMyOrders(array $post = []): array
    {
        $response = $this->send(self::METHOD_MY_ORDERS, $post);

        return $response['items'];
    }

    /**
     * @param array $post
     * @return array
     * @throws ClientExceptionInterface
     */
    public function getMyHistory(array $post = []): array
    {
        $response = $this->send(self::METHOD_MY_HISTORY, $post);

        return $response['items'];
    }

    /**
     * @param array $post
     * @return array
     * @throws ClientExceptionInterface
     */
    public function getMyTrades(array $post = []): array
    {
        $response = $this->send(self::METHOD_MY_TRADES, $post);

        return $response['items'];
    }

    /**
     * @param string $resourcePath
     * @param array $post
     * @return array
     * @throws ClientExceptionInterface|Exception
     */
    protected function send(string $resourcePath, array $post = []): array
    {
        $request = $this->requestBuilder->build($resourcePath, $post);
        $response = $this->client->sendRequest($request);

        return $this->responseMapper->getData($response);
    }
}
