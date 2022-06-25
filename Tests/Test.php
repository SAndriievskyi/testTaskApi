<?php

namespace testTask\Tests;

use testTask\Aggregates\Auction\Auction;
use testTask\Components\AuctionSummarizer;
use testTask\Components\BuyersSorters\BiggestBidBuyersSorter;
use testTask\Components\WinningSumCalculators\SecondPlaceWinningSumCalculator;
use testTask\Exceptions\ValidateException;

class Test
{
    public function run(): void
    {
        $objectPrice = $this->objectPrice;
        $auction = new Auction($objectPrice);
        $validationErrors = [];
        foreach ($this->bidFixtures as $data) {
            $auction->addBuyer($data['buyer']);
            $buyer = $auction->getBuyer($data['buyer']);
            if (!$data['bid']) {
                continue;
            }
            try {
                $auction->addBid($buyer, $data['bid']);
            } catch (ValidateException $e) {
                $validationErrors[] = "Buyer {$data['buyer']} bid {$data['bid']}. " . $e->getMessage() . PHP_EOL;
            }
        }

        if ($validationErrors) {
            echo 'Validation errors:' . PHP_EOL;
            echo implode(PHP_EOL, $validationErrors);
            echo '-----------------------------------' . PHP_EOL;
        }

        $buyersSorter = new BiggestBidBuyersSorter();
        $winningSumCalculator = new SecondPlaceWinningSumCalculator($objectPrice);
        $auctionSummarizer = new AuctionSummarizer($buyersSorter, $winningSumCalculator);
        $auctionProcessReviewer = $auctionSummarizer->summarize($auction);

        echo $auctionProcessReviewer->printInformation();
    }

    private int $objectPrice = 100;

    private array $bidFixtures = [
        ['buyer' => 'D', 'bid' => 105],
        ['buyer' => 'A', 'bid' => 110],
        ['buyer' => 'D', 'bid' => 115],
        ['buyer' => 'C', 'bid' => 125],
        ['buyer' => 'A', 'bid' => 130],
        ['buyer' => 'E', 'bid' => 132],
        ['buyer' => 'E', 'bid' => 135],
        ['buyer' => 'B', 'bid' => null],
        ['buyer' => 'D', 'bid' => 90],
        ['buyer' => 'E', 'bid' => 140],
    ];
}