<?php

namespace OneGit\Api;

class ApiTradePayeer
{
    /**
     * @var array
     */
    private array $arError = [];

    /**
     * ApiTradePayeer constructor.
     * @param RequestClient $requestParamTransfer
     */
    public function __construct(
        protected RequestClient $requestClient
    )
    {
    }


    private function getResponse($req = [])
    {
        $req['post']['ts'] = round(microtime(true) * 1000);

        $post = json_encode($req['post']);

        $sign = hash_hmac('sha256', $req['method'] . $post, $this->requestParamTransfer->getKey());

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://payeer.com/api/trade/" . $req['method']);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "API-ID: " . $this->requestParamTransfer->getId(),
            "API-SIGN: " . $sign
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        $arResponse = json_decode($response, true);

        if ($arResponse['success'] !== true) {
            $this->arError = $arResponse['error'];
            throw new Exception($arResponse['error']['code']);
        }

        return $arResponse;
    }


    public function getGetError()
    {
        return $this->arError;
    }

    protected const METHOD_INFO = 'info';
    protected const METHOD_ORDERS = 'orders';
    protected const METHOD_ACCOUNT = 'account';
    protected const METHOD_ORDER_CREATE = 'order_create';
    protected const METHOD_ORDER_STATUS = 'order_status';
    protected const METHOD_MY_ORDERS = 'my_orders';

    /**
     * @return array
     */
    public function getInfo(): array
    {
        return $this->requestClient->getResponse([
            'method' => self::METHOD_INFO,
        ]);
    }

    /**
     * @param string $pair
     * @return array
     */
    public function getOrders(string $pair = 'BTC_USDT'): array
    {
        $response = $this->requestClient->getResponse([
            'method' => self::METHOD_ORDERS,
            'post' => [
                'pair' => $pair,
            ],
        ]);

        return $response['pairs'];
    }

    /**
     * @return array
     */
    public function getAccount(): array
    {
        $response = $this->requestClient->getResponse([
            'method' => self::METHOD_ACCOUNT,
        ]);

        return $response['balances'];
    }

    /**
     * @param array $postParams
     * @return array
     */
    public function getOrderCreate(array $postParams = []): array
    {
        return $this->requestClient->getResponse([
            'method' => self::METHOD_ORDER_CREATE,
            'post' => $postParams,
        ]);
    }

    /**
     * @param array $postParams
     * @return array
     */
    public function getOrderStatus(array $postParams = []): array
    {
        $response = $this->requestClient->getResponse([
            'method' => self::METHOD_ORDER_STATUS,
            'post' => $postParams,
        ]);

        return $response['order'];
    }

    /**
     * @param array $postParams
     * @return array
     */
    public function getMyOrders(array $postParams = []): array
    {
        $response = $this->requestClient->getResponse([
            'method' => self::METHOD_MY_ORDERS,
            'post' => $postParams,
        ]);

        return $response['items'];
    }
}