<?php

declare(strict_types=1);

namespace OneGit\ApiClient\Client\Request;

use Psr\Http\Message\RequestInterface;

/**
 * Interface RequestBuilderInterface
 * @package OneGit\ApiClient\Client\Request
 */
interface RequestBuilderInterface
{
    /**
     * @param string $resourcePath
     * @param array $post
     * @return RequestInterface
     */
    public function build(string $resourcePath, array $post = []): RequestInterface;
}
