<?php

namespace testTask\Components\WinningSumCalculators;

use testTask\Aggregates\Auction\Buyer;

interface WinningSumCalculatorInterface
{
    /**
     * @param Buyer[] $buyers
     */
    public function calculate(array $buyers): int;
}