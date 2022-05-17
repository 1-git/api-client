<?php

declare(strict_types=1);

namespace OneGit\ApiClient\Client\Response;

use Exception;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface ResponseMapperInterface
 * @package OneGit\ApiClient\Client\Response
 */
interface ResponseMapperInterface
{
    /**
     * @param ResponseInterface $response
     * @return array
     * @throws Exception
     */
    public function getData(ResponseInterface $response): array;
}
