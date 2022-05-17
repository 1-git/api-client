<?php

namespace OneGit\Api\SecretGenerator;

/**
 * Interface SignGeneratorInterface
 * @package OneGit\Api\SecretGenerator
 */
interface SignGeneratorInterface
{
    /**
     * @param string $data
     * @param string $key
     * @return string
     */
    public function getSign(string $data, string $key): string;
}