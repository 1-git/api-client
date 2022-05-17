<?php

namespace OneGit\Api;

use OneGit\Api\SecretGenerator\SignGeneratorInterface;

/**
 * Class RequestParamTransfer
 * @package OneGit\Api
 */
class RequestClient
{
    public function __construct(
        protected SignGeneratorInterface $signGenerator,
        protected SecretParamTransfer $secretParamTransfer,
        protected ?string $baseApiUrl = 'https://payeer.com/api/trade/',
    )
    {
    }

    /**
     * @return string[]
     */
    protected function defaultHeaders(): array
    {
        return ['Content-Type: application/json'];
    }

    /**
     * @param string $data
     * @return string[]
     */
    protected function getSecretHeader(string $data): array
    {
        return [
            'API-ID: ' . $this->secretParamTransfer->getId(),
            'API-SIGN: ' . $this->signGenerator->getSign($data, $this->secretParamTransfer->getKey()),
        ];
    }

    public function getResponse($req = [])
    {
        $req['post']['ts'] = round(microtime(true) * 1000);

        $post = json_encode($req['post']);

        $headers = array_merge(
            $this->defaultHeaders(),
            $this->getSecretHeader($req['method'] . $post)
        );

        $url = 'https://payeer.com/api/trade/' . $req['method'];



        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://payeer.com/api/trade/" . $req['method']);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);


        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        $arResponse = json_decode($response, true);

        if ($arResponse['success'] !== true) {
            $this->arError = $arResponse['error'];
            throw new Exception($arResponse['error']['code']);
        }

        return $arResponse;
    }
}