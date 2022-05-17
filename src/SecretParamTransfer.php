<?php

namespace OneGit\Api;

/**
 * Class SecretParamTransfer
 * @package OneGit\Api
 */
class SecretParamTransfer
{
    /**
     * SecretParamTransfer constructor.
     * @param string $key
     * @param string $id
     */
    public function __construct(
        protected string $key,
        protected string $id,
    )
    {
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