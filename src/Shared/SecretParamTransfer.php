<?php

declare(strict_types=1);

namespace OneGit\ApiClient\Shared;

/**
 * Class SecretParamTransfer
 * @package OneGit\ApiClient\Shared
 */
class SecretParamTransfer
{
    /**
     * @var string
     */
    protected string $key;

    /**
     * @var string
     */
    protected string $id;

    /**
     * SecretParamTransfer constructor.
     * @param string $key
     * @param string $id
     */
    public function __construct(
        string $key,
        string $id
    )
    {
        $this->key = $key;
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
