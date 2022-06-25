<?php

namespace testTask\Components;

use testTask\Aggregates\Auction\AuctionWinner;
use testTask\Aggregates\Auction\Bid;
use testTask\Aggregates\Auction\Buyer;

class AuctionProcessReviewer
{
    private AuctionWinner $auctionWinner;
    /** @var Buyer[] */
    private array $buyersPositionList;

    public function __construct(AuctionWinner $auctionWinner, array $buyersPositionList)
    {
        $this->auctionWinner = $auctionWinner;
        $this->buyersPositionList = $buyersPositionList;
    }

    public function printInformation(): string
    {
        $text = "The winner is {$this->auctionWinner->getBuyer()} with winning sum - {$this->auctionWinner->getSum()}" . PHP_EOL;
        foreach ($this->buyersPositionList as $buyer) {
            $bids = array_map(static fn(Bid $bid) => $bid->getSum(), $buyer->getBids());
            rsort($bids);
            $text .= "{$buyer} bids " . implode(', ', $bids) . PHP_EOL;
        }

        return $text;
    }
}