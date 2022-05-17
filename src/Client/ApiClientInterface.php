<?php

declare(strict_types=1);

namespace OneGit\ApiClient\Client;

use Psr\Http\Client\ClientExceptionInterface;

/**
 * Interface ApiClientInterface
 * @package OneGit\ApiClient\Client
 */
interface ApiClientInterface
{
    /**
     * @return array
     */
    public function getTime(): array;

    /**
     * @param string|null $pair
     * @return array
     */
    public function getInfo(string $pair = null): array;

    /**
     * @param string $pair
     * @return array
     */
    public function getTicker(string $pair): array;

    /**
     * @param string $pair
     * @return array
     */
    public function getOrders(string $pair): array;

    /**
     * @param string $pair
     * @return array
     * @throws ClientExceptionInterface
     */
    public function getTrades(string $pair): array;

    /**
     * @return array
     */
    public function getAccount(): array;

    /**
     * @param array $post
     * @return array
     */
    public function getOrderCreate(array $post = []): array;

    /**
     * @param array $post
     * @return array
     */
    public function getOrderStatus(array $post = []): array;

    /**
     * @param array $post
     * @return array
     * @throws ClientExceptionInterface
     */
    public function getOrderCancel(array $post = []): array;

    /**
     * @param array $post
     * @return array
     * @throws ClientExceptionInterface
     */
    public function getOrdersCancel(array $post = []): array;

    /**
     * @param array $post
     * @return array
     */
    public function getMyOrders(array $post = []): array;

    /**
     * @param array $post
     * @return array
     * @throws ClientExceptionInterface
     */
    public function getMyHistory(array $post = []): array;

    /**
     * @param array $post
     * @return array
     * @throws ClientExceptionInterface
     */
    public function getMyTrades(array $post = []): array;
}
