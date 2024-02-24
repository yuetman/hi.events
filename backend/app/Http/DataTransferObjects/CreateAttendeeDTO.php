<?php

namespace HiEvents\Http\DataTransferObjects;

use Illuminate\Support\Collection;
use HiEvents\DataTransferObjects\Attributes\CollectionOf;
use HiEvents\DataTransferObjects\BaseDTO;

class CreateAttendeeDTO extends BaseDTO
{
    public function __construct(
        public readonly string      $first_name,
        public readonly string      $last_name,
        public readonly string      $email,
        public readonly int         $ticket_id,
        public readonly int         $event_id,
        public readonly bool        $send_confirmation_email,
        public readonly float       $amount_paid,
        public readonly ?bool       $amount_includes_tax = false,
        public readonly ?int        $ticket_price_id = null,
        #[CollectionOf(CreateAttendeeTaxAndFeeDTO::class)]
        public readonly ?Collection $taxes_and_fees = null,
    )
    {
    }
}
