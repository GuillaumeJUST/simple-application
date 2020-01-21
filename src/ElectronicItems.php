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
     * @return ElectronicItem[]
     */
    public function getSortedItems(): array
    {
        $sortedItem = array_values($this->items);
        usort($sortedItem, function (ElectronicItem $itemA, ElectronicItem $itemB) {
            return $itemA->getPrice() * 100 > $itemB->getPrice() * 100;
        });

        return $sortedItem;
    }

    /**
     * @param string $type
     * @return ElectronicItem[]
     */
    public function getItemsByType(string $type): array
    {
        $items = [];
        if (\in_array($type, ElectronicItem::$types, true)) {
            $callback = function (ElectronicItem $item) use ($type) {
                return $item->getType() === $type;
            };
            $items = array_filter($this->items, $callback);
        }

        return $items;
    }
}
