<?php

namespace HiEvents\Service\Common\Ticket;

use Illuminate\Support\Facades\DB;
use HiEvents\Repository\Interfaces\TicketPriceRepositoryInterface;

readonly class TicketQuantityService
{
    public function __construct(
        private TicketPriceRepositoryInterface $ticketPriceRepository,
    )
    {
    }

    public function increaseTicketPriceQuantitySold(int $priceId, int $adjustment = 1): void
    {
        $this->ticketPriceRepository->updateWhere([
            'quantity_sold' => DB::raw('quantity_sold + ' . $adjustment),
        ], [
            'id' => $priceId,
        ]);
    }

    public function decreaseTicketPriceQuantitySold(int $priceId, int $adjustment = 1): void
    {
        $this->ticketPriceRepository->updateWhere([
            'quantity_sold' => DB::raw('quantity_sold - ' . $adjustment),
        ], [
            'id' => $priceId,
        ]);
    }
}
