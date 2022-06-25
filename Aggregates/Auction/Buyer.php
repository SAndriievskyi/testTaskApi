<?php

namespace testTask\Aggregates\Auction;

class Buyer
{
    private string $name;
    /** @var Bid[]  */
    private array $bids = []; //todo to collection

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): Buyer
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Bid[]
     */
    public function getBids(): array
    {
        return $this->bids;
    }

    /**
     * @param Bid[] $bids
     */
    public function setBids(array $bids): Buyer
    {
        $this->bids = $bids;

        return $this;
    }

    public function addBid(int $bidSum): Buyer
    {
        $this->bids[] = (new Bid())->setSum($bidSum);

        return $this;
    }

    public function getMaxBid(): ?Bid
    {
        $bids = $this->bids;
        if (!$bids) {
            return null;
        }

        usort($bids, static fn(Bid $a, Bid $b) => $b <=> $a);

        return reset($bids);
    }

    public function __toString()
    {
        return $this->getName();
    }
}