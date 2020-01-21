<?php

namespace App;

abstract class ElectronicItem
{
    protected $currentCounter = 0;
    /**
     * @var float
     */
    private $price = 0;
    /**
     * @var ElectronicItem[]
     */
    private $extras = [];

    public function getName(): string
    {
        return ucfirst($this->getType()).' '.$this->currentCounter;
    }

    abstract public function getType(): string;

    /**
     * @return ElectronicItem[]
     */
    public function getExtras(): array
    {
        return $this->extras;
    }

    public function addExtra(ElectronicItem $electronicItem): bool
    {
        if ($this->hasReachMaxExtras()) {
            return false;
        }

        $this->extras[] = $electronicItem;

        return true;
    }

    public function hasReachMaxExtras(): bool
    {
        return $this->maxExtras() !== null && \count($this->extras) >= $this->maxExtras();
    }

    abstract public function maxExtras(): ?int;

    public function getTotalPrice(): float
    {
        $totalPrice = $this->price;
        foreach ($this->extras as $extra) {
            $totalPrice += $extra->getTotalPrice();
        }

        return $totalPrice;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
}
