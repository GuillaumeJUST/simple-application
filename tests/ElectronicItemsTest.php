<?php

use App\ElectronicItem;
use App\ElectronicItems;
use PHPUnit\Framework\TestCase;


class ElectronicItemsTest extends TestCase
{
    /**
     * @var ElectronicItems
     */
    private $electronicItems;

    protected function setUp(): void
    {
        parent::setUp();

        $electronicItem = new ElectronicItem();
        $electronicItem->setPrice(20);
        $electronicItem->setType(ElectronicItem::ELECTRONIC_ITEM_CONSOLE);
        $electronicItem->setWired(20);
        $electronicItems[] = $electronicItem;

        $electronicItem = new ElectronicItem();
        $electronicItem->setPrice(30);
        $electronicItem->setType(ElectronicItem::ELECTRONIC_ITEM_TELEVISION);
        $electronicItem->setWired(20);
        $electronicItems[] = $electronicItem;

        $electronicItem = new ElectronicItem();
        $electronicItem->setPrice(10.2);
        $electronicItem->setType(ElectronicItem::ELECTRONIC_ITEM_TELEVISION);
        $electronicItem->setWired(20);
        $electronicItems[] = $electronicItem;

        $electronicItem = new ElectronicItem();
        $electronicItem->setPrice(10);
        $electronicItem->setType(ElectronicItem::ELECTRONIC_ITEM_TELEVISION);
        $electronicItem->setWired(20);
        $electronicItems[] = $electronicItem;

        $this->electronicItems = new ElectronicItems($electronicItems);
    }

    public function testFirstTypeSortedItems(): void
    {
        $sortedElectronicItems = $this->electronicItems->getSortedItems();
        /** @var ElectronicItem $sortedElectronicItem */
        $sortedElectronicItem = array_shift($sortedElectronicItems);
        $this->assertEquals(ElectronicItem::ELECTRONIC_ITEM_TELEVISION, $sortedElectronicItem->getType());
    }

    public function testFirstPriceSortedItems(): void
    {
        $sortedElectronicItems = $this->electronicItems->getSortedItems();
        /** @var ElectronicItem $sortedElectronicItem */
        $sortedElectronicItem = array_shift($sortedElectronicItems);
        $this->assertEquals(10, $sortedElectronicItem->getPrice());
    }

    public function testLastTypeSortedItems(): void
    {
        $sortedElectronicItems = $this->electronicItems->getSortedItems();
        /** @var ElectronicItem $sortedElectronicItem */
        $sortedElectronicItem = array_pop($sortedElectronicItems);
        $this->assertEquals(ElectronicItem::ELECTRONIC_ITEM_TELEVISION, $sortedElectronicItem->getType());
    }

    public function testLastPriceSortedItems(): void
    {
        $sortedElectronicItems = $this->electronicItems->getSortedItems();
        /** @var ElectronicItem $sortedElectronicItem */
        $sortedElectronicItem = array_pop($sortedElectronicItems);
        $this->assertEquals(30, $sortedElectronicItem->getPrice());
    }

    public function testItemByTypeWithResultTelevision(): void
    {
        $ElectronicTelevisionItems = $this->electronicItems->getItemsByType(ElectronicItem::ELECTRONIC_ITEM_TELEVISION);
        $this->assertCount(3, $ElectronicTelevisionItems);
    }

    public function testItemByTypeWithoutResult(): void
    {
        $ElectronicTelevisionItems = $this->electronicItems->getItemsByType(ElectronicItem::ELECTRONIC_ITEM_MICROWAVE);
        $this->assertCount(0, $ElectronicTelevisionItems);
    }
}
