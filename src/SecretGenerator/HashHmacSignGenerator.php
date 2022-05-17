<?php

declare(strict_types=1);

namespace OneGit\ApiClient\SecretGenerator;

/**
 * Class HashHmacSignGenerator
 * @package OneGit\ApiClient\SecretGenerator
 */
class HashHmacSignGenerator implements SignGeneratorInterface
{
    protected const ALGO = 'sha256';

    /**
     * @var string
     */
    protected string $algo = self::ALGO;

    /**
     * HashHmacSignGenerator constructor.
     * @param string $algo
     */
    public function __construct(
        string $algo = self::ALGO
    )
    {
        $this->$algo = $algo;
    }

    /**
     * @param [string, string] ...$params
     * @return string
     */
    public function getSign($params): string
    {
        return hash_hmac($this->algo, $params['data'], $params['key']);
    }
}
