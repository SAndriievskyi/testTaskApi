<?php

namespace testTask\Components\BuyersSorters;

use testTask\Aggregates\Auction\Buyer;

class BiggestBidBuyersSorter implements BuyersSorterInterface
{
    /**
     * @param Buyer[] $buyers
     *
     * @return Buyer[]
     */
    public function sort(array $buyers): array
    {
        usort($buyers, static fn(Buyer $a, Buyer $b) => $b->getMaxBid() <=> $a->getMaxBid());

        return $buyers;
    }
}