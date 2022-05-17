<?php

declare(strict_types=1);

namespace OneGit\ApiClient\SecretGenerator;

/**
 * Interface SignGeneratorInterface
 * @package OneGit\ApiClient\SecretGenerator
 */
interface SignGeneratorInterface
{
    /**
     * @param array $params
     * @return string
     */
    public function getSign(array $params): string;
}
