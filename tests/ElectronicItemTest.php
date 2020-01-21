<?php

use App\ElectronicItem;
use PHPUnit\Framework\TestCase;


class ElectronicItemTest extends TestCase
{
    /**
     * @var ElectronicItem
     */
    private $electronicItem;

    protected function setUp(): void
    {
        parent::setUp();

        $this->electronicItem = new ElectronicItem();
        $this->electronicItem->setPrice(20);
        $this->electronicItem->setType(ElectronicItem::ELECTRONIC_ITEM_CONSOLE);
        $this->electronicItem->setWired(20);
    }


    public function testGetWired(): void
    {
        $this->assertEquals(20, $this->electronicItem->getPrice());
    }

    public function testGetType(): void
    {
        $this->assertEquals(ElectronicItem::ELECTRONIC_ITEM_CONSOLE, $this->electronicItem->getType());
    }

    public function testGetPrice(): void
    {
        $this->assertEquals(20, $this->electronicItem->getWired());
    }
}
