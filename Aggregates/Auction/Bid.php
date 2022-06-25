<?php

namespace testTask\Aggregates\Auction;

class Bid
{
    private int $sum;

    public function getSum(): int
    {
        return $this->sum;
    }

    public function setSum(int $sum): Bid
    {
        $this->sum = $sum;

        return $this;
    }
}