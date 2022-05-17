<?php

declare(strict_types=1);

namespace OneGit\ApiClient\Client\Response;

use Exception;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ResponseMapper
 * @package OneGit\ApiClient\Client\Response
 */
class ResponseMapper implements ResponseMapperInterface
{
    /**
     * @inheritDoc
     */
    public function getData(ResponseInterface $response): array
    {
        if (!in_array($response->getStatusCode(), [200, 201])) {
            throw new Exception('Wrong response code: ' . $response->getReasonPhrase() . ' - ' . $response->getBody());
        }

        $contents = $response->getBody()->getContents();
        $data = json_decode($contents, true);

        if (json_last_error() !== JSON_ERROR_NONE || !$data) {
            throw new Exception('Json is incorrect: ' . $contents);
        }

        if (!$data['success']) {
            throw new Exception('Server error: ' . $data['error']['code']);
        }

        return $data;
    }
}
