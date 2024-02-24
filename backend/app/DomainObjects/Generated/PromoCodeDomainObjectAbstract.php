<?php

namespace HiEvents\DomainObjects\Generated;

/**
 * THIS FILE IS AUTOGENERATED - DO NOT EDIT IT DIRECTLY.
 * @package TicketKitten\DomainObjects\Generated
 */
abstract class PromoCodeDomainObjectAbstract extends \HiEvents\DomainObjects\AbstractDomainObject
{
    final public const SINGULAR_NAME = 'promo_code';
    final public const PLURAL_NAME = 'promo_codes';
    final public const ID = 'id';
    final public const EVENT_ID = 'event_id';
    final public const CODE = 'code';
    final public const DISCOUNT = 'discount';
    final public const APPLICABLE_TICKET_IDS = 'applicable_ticket_ids';
    final public const EXPIRY_DATE = 'expiry_date';
    final public const DISCOUNT_TYPE = 'discount_type';
    final public const ATTENDEE_USAGE_COUNT = 'attendee_usage_count';
    final public const ORDER_USAGE_COUNT = 'order_usage_count';
    final public const MAX_ALLOWED_USAGES = 'max_allowed_usages';
    final public const CREATED_AT = 'created_at';
    final public const UPDATED_AT = 'updated_at';
    final public const DELETED_AT = 'deleted_at';

    protected int $id;
    protected int $event_id;
    protected string $code;
    protected float $discount = 0.0;
    protected array|string|null $applicable_ticket_ids = null;
    protected ?string $expiry_date = null;
    protected ?string $discount_type = null;
    protected int $attendee_usage_count = 0;
    protected int $order_usage_count = 0;
    protected ?int $max_allowed_usages = null;
    protected string $created_at;
    protected ?string $updated_at = null;
    protected ?string $deleted_at = null;

    public function toArray(): array
    {
        return [
                    'id' => $this->id ?? null,
                    'event_id' => $this->event_id ?? null,
                    'code' => $this->code ?? null,
                    'discount' => $this->discount ?? null,
                    'applicable_ticket_ids' => $this->applicable_ticket_ids ?? null,
                    'expiry_date' => $this->expiry_date ?? null,
                    'discount_type' => $this->discount_type ?? null,
                    'attendee_usage_count' => $this->attendee_usage_count ?? null,
                    'order_usage_count' => $this->order_usage_count ?? null,
                    'max_allowed_usages' => $this->max_allowed_usages ?? null,
                    'created_at' => $this->created_at ?? null,
                    'updated_at' => $this->updated_at ?? null,
                    'deleted_at' => $this->deleted_at ?? null,
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

    public function setEventId(int $event_id): self
    {
        $this->event_id = $event_id;
        return $this;
    }

    public function getEventId(): int
    {
        return $this->event_id;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setDiscount(float $discount): self
    {
        $this->discount = $discount;
        return $this;
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function setApplicableTicketIds(array|string|null $applicable_ticket_ids): self
    {
        $this->applicable_ticket_ids = $applicable_ticket_ids;
        return $this;
    }

    public function getApplicableTicketIds(): array|string|null
    {
        return $this->applicable_ticket_ids;
    }

    public function setExpiryDate(?string $expiry_date): self
    {
        $this->expiry_date = $expiry_date;
        return $this;
    }

    public function getExpiryDate(): ?string
    {
        return $this->expiry_date;
    }

    public function setDiscountType(?string $discount_type): self
    {
        $this->discount_type = $discount_type;
        return $this;
    }

    public function getDiscountType(): ?string
    {
        return $this->discount_type;
    }

    public function setAttendeeUsageCount(int $attendee_usage_count): self
    {
        $this->attendee_usage_count = $attendee_usage_count;
        return $this;
    }

    public function getAttendeeUsageCount(): int
    {
        return $this->attendee_usage_count;
    }

    public function setOrderUsageCount(int $order_usage_count): self
    {
        $this->order_usage_count = $order_usage_count;
        return $this;
    }

    public function getOrderUsageCount(): int
    {
        return $this->order_usage_count;
    }

    public function setMaxAllowedUsages(?int $max_allowed_usages): self
    {
        $this->max_allowed_usages = $max_allowed_usages;
        return $this;
    }

    public function getMaxAllowedUsages(): ?int
    {
        return $this->max_allowed_usages;
    }

    public function setCreatedAt(string $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setUpdatedAt(?string $updated_at): self
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    public function setDeletedAt(?string $deleted_at): self
    {
        $this->deleted_at = $deleted_at;
        return $this;
    }

    public function getDeletedAt(): ?string
    {
        return $this->deleted_at;
    }
}
