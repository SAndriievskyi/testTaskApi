<?php

namespace testTask\Components\BuyersSorters;

use testTask\Aggregates\Auction\Buyer;

interface BuyersSorterInterface
{
    /**
     * @param Buyer[] $buyers
     *
     * @return Buyer[]
     */
    public function sort(array $buyers): array;
}