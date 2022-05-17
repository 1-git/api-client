<?php

namespace OneGit\Api\SecretGenerator;

/**
 * Class HashHmacSignGenerator
 * @package OneGit\Api\SecretGenerator
 */
class HashHmacSignGenerator implements SignGeneratorInterface
{
    /**
     * HashHmacSignGenerator constructor.
     * @param string $algo
     */
    public function __construct(
        protected string $algo = 'sha256',
    )
    {
    }

    /**
     * @param string $data
     * @param string $key
     * @return string
     */
    public function getSign(string $data, string $key): string
    {
        return hash_hmac($this->algo, $data, $key);
    }
}