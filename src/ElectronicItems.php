<?php

namespace App;

class ElectronicItems
{
    /**
     * @var ElectronicItem[]
     */
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Returns the items depending on the sorting type requested
     *
     * @param bool $itemTotalPrice
     *
     * @return ElectronicItem[]
     */
    public function getSortedItems(bool $itemTotalPrice = true): array
    {
        $sortedItem = array_values($this->items);
        usort($sortedItem, function (ElectronicItem $itemA, ElectronicItem $itemB) use ($itemTotalPrice) {
            $priceA = $itemTotalPrice ? $itemA->getTotalPrice() : $itemA->getPrice();
            $priceB = $itemTotalPrice ? $itemB->getTotalPrice() : $itemB->getPrice();

            return $priceA > $priceB;
        });

        return $sortedItem;
    }

    /**
     * @param string $type
     *
     * @return ElectronicItem[]
     */
    public function getItemsByType(string $type): array
    {
        $callback = function (ElectronicItem $item) use ($type) {
            return $item instanceof $type;
        };

        return array_filter($this->items, $callback);
    }

    public function getTotalPrice(): float
    {
        $totalPrice = 0;
        foreach ($this->items as $item) {
            $totalPrice += $item->getTotalPrice();
        }

        return $totalPrice;
    }
}
