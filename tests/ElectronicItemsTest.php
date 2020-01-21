<?php

use App\ItemMicrowave;
use App\ItemTelevision;
use App\ItemController;
use App\ElectronicItems;
use App\ElectronicItem;
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

        $electronicItems = $this->generateElectronicItems();
        shuffle($electronicItems);
        $this->electronicItems = new ElectronicItems($electronicItems);
    }

    private function generateElectronicItems(): array
    {
        $electronicItems = [];

        $electronicItem = new ItemTelevision();
        $electronicItem->setPrice(50);
        $electronicItems[] = $electronicItem;

        $electronicItem = new ItemTelevision();
        $electronicItem->setPrice(10);
        $electronicItems[] = $electronicItem;

        $electronicItem = new ItemTelevision();
        $electronicItem->setPrice(40);
        $electronicItems[] = $electronicItem;

        $electronicItem = new ItemMicrowave();
        $electronicItem->setPrice(5);
        $electronicItems[] = $electronicItem;

        $electronicItem = new ItemMicrowave();
        $electronicItem->setPrice(35);
        $electronicItems[] = $electronicItem;

        return $electronicItems;
    }

    public function testFirstTypeSortedItems(): void
    {
        $sortedElectronicItems = $this->electronicItems->getSortedItems();
        /** @var ElectronicItem $sortedElectronicItem */
        $sortedElectronicItem = array_shift($sortedElectronicItems);
        $this->assertInstanceOf(ItemMicrowave::Class, $sortedElectronicItem);
    }

    public function testFirstPriceSortedItems(): void
    {
        $sortedElectronicItems = $this->electronicItems->getSortedItems();
        /** @var ElectronicItem $sortedElectronicItem */
        $sortedElectronicItem = array_shift($sortedElectronicItems);
        $this->assertEquals(5, $sortedElectronicItem->getTotalPrice());
    }

    public function testLastTypeSortedItems(): void
    {
        $sortedElectronicItems = $this->electronicItems->getSortedItems();
        /** @var ElectronicItem $sortedElectronicItem */
        $sortedElectronicItem = array_pop($sortedElectronicItems);
        $this->assertInstanceOf(ItemTelevision::Class, $sortedElectronicItem);
    }

    public function testLastPriceSortedItems(): void
    {
        $sortedElectronicItems = $this->electronicItems->getSortedItems();
        /** @var ElectronicItem $sortedElectronicItem */
        $sortedElectronicItem = array_pop($sortedElectronicItems);
        $this->assertEquals(50, $sortedElectronicItem->getTotalPrice());
    }

    public function testItemByTypeWithResultTelevision(): void
    {
        $ElectronicTelevisionItems = $this->electronicItems->getItemsByType(ItemTelevision::Class);
        $this->assertCount(3, $ElectronicTelevisionItems);
    }

    public function testItemByTypeWithoutResult(): void
    {
        $ElectronicTelevisionItems = $this->electronicItems->getItemsByType(ItemController::Class);
        $this->assertCount(0, $ElectronicTelevisionItems);
    }

    public function testTotalPrice(): void
    {
        $this->assertEquals(140, $this->electronicItems->getTotalPrice());
    }

    public function testFirstPriceSortedItemsWithController(): void
    {
        $electronicItems = $this->generateElectronicItems();

        $itemTelevision = new ItemTelevision();
        $itemTelevision->setPrice(20);

        $electronicItem = new ItemController();
        $electronicItem->setPrice(10);
        $itemTelevision->addExtra($electronicItem);

        $electronicItem = new ItemController();
        $electronicItem->setPrice(40);
        $itemTelevision->addExtra($electronicItem);
        $electronicItems[] = $itemTelevision;

        shuffle($electronicItems);
        $this->electronicItems = new ElectronicItems($electronicItems);

        $sortedElectronicItems = $this->electronicItems->getSortedItems();
        /** @var ElectronicItem $sortedElectronicItem */
        $sortedElectronicItem = array_pop($sortedElectronicItems);
        $this->assertEquals(70, $sortedElectronicItem->getTotalPrice());
    }
}
