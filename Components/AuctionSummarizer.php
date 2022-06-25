<?php

namespace testTask\Components;

use testTask\Aggregates\Auction\Auction;
use testTask\Aggregates\Auction\AuctionWinner;
use testTask\Components\BuyersSorters\BuyersSorterInterface;
use testTask\Components\WinningSumCalculators\WinningSumCalculatorInterface;
use testTask\Exceptions\EmptyAuctionException;

class AuctionSummarizer
{
    private BuyersSorterInterface $buyersSorter;
    private WinningSumCalculatorInterface $winningSumCalculator;

    public function __construct(
        BuyersSorterInterface $buyersSorter,
        WinningSumCalculatorInterface $winningSumCalculator
    ) {
        $this->buyersSorter = $buyersSorter;
        $this->winningSumCalculator = $winningSumCalculator;
    }

    public function summarize(Auction $auction): AuctionProcessReviewer
    {
        $buyers = $auction->getBuyers();
        if (!$buyers) {
            throw new EmptyAuctionException('Nobody present in auction!');
        }

        $sortedBuyers = $this->buyersSorter->sort($buyers);
        $winningSum = $this->winningSumCalculator->calculate($sortedBuyers);
        $auctionWinner = new AuctionWinner(reset($sortedBuyers), $winningSum);

        return new AuctionProcessReviewer($auctionWinner, $sortedBuyers);
    }
}