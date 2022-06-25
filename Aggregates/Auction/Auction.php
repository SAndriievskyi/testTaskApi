<?php

namespace testTask\Aggregates\Auction;

use testTask\Exceptions\ValidateException;
use testTask\Validators\GreaterThen;
use testTask\Validators\GreaterThenOrEqual;
use testTask\Validators\ValidateResult;
use testTask\Validators\ValidatorFactory;

class Auction
{
    private int $objectPrice;
    private array $buyers = [];

    public function __construct(int $objectPrice) {
        $this->objectPrice = $objectPrice;
    }

    public function addBuyer(string $name): Auction
    {
        if (!isset($this->buyers[$name])) {
            $this->buyers[$name] = (new Buyer())->setName($name);
        }

        return $this;
    }

    public function getBuyer(string $name): ?Buyer
    {
        return $this->buyers[$name] ?? null;
    }

    public function getBuyers(): array
    {
        return $this->buyers;
    }

    public function addBid(Buyer $buyer, int $bidSum): Auction
    {
        $validateResult = $this->validateBid($bidSum);
        if (!$validateResult->isValidated()) {
            throw new ValidateException($validateResult->getErrorMessage());
        }
        $buyer->addBid($bidSum);
        $buyerName = $buyer->getName();
        if (!isset($this->buyers[$buyerName])) {
            $this->buyers[$buyerName] = $buyer;
        }

        return $this;
    }

    private function validateBid(int $bidSum): ValidateResult
    {
        $maxBid = $this->getMaxBidSum();
        if ($maxBid) {
            $constraint = new GreaterThen($maxBid);
        } else {
            $constraint = new GreaterThenOrEqual($this->objectPrice);
        }

        return (new ValidatorFactory())
            ->getInstance($constraint)
            ->validate($bidSum, $constraint);
    }

    private function getMaxBidSum(): ?int //todo make some cache
    {
        $bids = [];
        foreach ($this->buyers as $buyer) {
            $bids[] = array_map(static fn(Bid $bid) => $bid->getSum(), $buyer->getBids());
        }
        if (!$bids) {
            return null;
        }
        $bids = array_merge(...$bids);

        return $bids ? max($bids) : null;
    }
}