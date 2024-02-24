<?php

namespace HiEvents\DomainObjects\Generated;

/**
 * THIS FILE IS AUTOGENERATED - DO NOT EDIT IT DIRECTLY.
 * @package TicketKitten\DomainObjects\Generated
 */
abstract class FailedJobDomainObjectAbstract extends \HiEvents\DomainObjects\AbstractDomainObject
{
    final public const SINGULAR_NAME = 'failed_job';
    final public const PLURAL_NAME = 'failed_jobs';
    final public const ID = 'id';
    final public const UUID = 'uuid';
    final public const CONNECTION = 'connection';
    final public const QUEUE = 'queue';
    final public const PAYLOAD = 'payload';
    final public const EXCEPTION = 'exception';
    final public const FAILED_AT = 'failed_at';

    protected int $id;
    protected string $uuid;
    protected string $connection;
    protected string $queue;
    protected string $payload;
    protected string $exception;
    protected string $failed_at = 'CURRENT_TIMESTAMP';

    public function toArray(): array
    {
        return [
                    'id' => $this->id ?? null,
                    'uuid' => $this->uuid ?? null,
                    'connection' => $this->connection ?? null,
                    'queue' => $this->queue ?? null,
                    'payload' => $this->payload ?? null,
                    'exception' => $this->exception ?? null,
                    'failed_at' => $this->failed_at ?? null,
                ];
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setConnection(string $connection): self
    {
        $this->connection = $connection;
        return $this;
    }

    public function getConnection(): string
    {
        return $this->connection;
    }

    public function setQueue(string $queue): self
    {
        $this->queue = $queue;
        return $this;
    }

    public function getQueue(): string
    {
        return $this->queue;
    }

    public function setPayload(string $payload): self
    {
        $this->payload = $payload;
        return $this;
    }

    public function getPayload(): string
    {
        return $this->payload;
    }

    public function setException(string $exception): self
    {
        $this->exception = $exception;
        return $this;
    }

    public function getException(): string
    {
        return $this->exception;
    }

    public function setFailedAt(string $failed_at): self
    {
        $this->failed_at = $failed_at;
        return $this;
    }

    public function getFailedAt(): string
    {
        return $this->failed_at;
    }
}
