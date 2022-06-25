<?php

namespace testTask\Aggregates\Auction;

class AuctionWinner
{
    private Buyer $buyer;
    private int $sum;

    public function __construct(Buyer $buyer, int $sum)
    {
        $this->buyer = $buyer;
        $this->sum = $sum;
    }

    public function getBuyer(): Buyer
    {
        return $this->buyer;
    }

    public function getSum(): int
    {
        return $this->sum;
    }
}