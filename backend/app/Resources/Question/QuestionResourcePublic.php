<?php

namespace HiEvents\Resources\Question;

use Illuminate\Http\Request;
use HiEvents\DomainObjects\QuestionDomainObject;
use HiEvents\Resources\BaseResource;
use HiEvents\Resources\Ticket\TicketResourcePublic;

/**
 * @mixin QuestionDomainObject
 */
class QuestionResourcePublic extends BaseResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getId(),
            'type' => $this->getType(),
            'title' => $this->getTitle(),
            'options' => $this->getOptions(),
            'required' => $this->getRequired(),
            'event_id' => $this->getEventId(),
            'belongs_to' => $this->getBelongsTo(),
            'ticket_ids' => $this->when(
                !is_null($this->getTickets()),
                fn() => $this->getTickets()->map(fn($ticket) => $ticket->getId())
            ),
        ];
    }
}
