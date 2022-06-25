<?php

namespace testTask\Components\WinningSumCalculators;

use testTask\Aggregates\Auction\Buyer;

class SecondPlaceWinningSumCalculator implements WinningSumCalculatorInterface
{
    private int $defaultWinningSum;

    public function __construct(int $defaultWinningSum)
    {
        $this->defaultWinningSum = $defaultWinningSum;
    }

    /**
     * @param Buyer[] $buyers
     */
    public function calculate(array $buyers): int
    {
        array_shift($buyers);
        $secondPlaceBuyer = array_shift($buyers);
        if (!$secondPlaceBuyer) {
            return $this->defaultWinningSum;
        }

        $secondPlaceBuyerMaxBid = $secondPlaceBuyer->getMaxBid();

        return $secondPlaceBuyerMaxBid ? $secondPlaceBuyerMaxBid->getSum() : $this->defaultWinningSum;
    }
}