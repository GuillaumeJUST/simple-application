<?php

use App\ItemMicrowave;
use App\ItemController;
use PHPUnit\Framework\TestCase;

class ItemMicrowaveTest extends TestCase
{
    private const ITEM_PRICE = 15;
    private const ITEM_EXTRA_1_PRICE = 20;

    /**
     * @var ItemMicrowave
     */
    private $itemMicrowave;

    public function testGetType(): void
    {
        $this->assertEquals('microwave', $this->itemMicrowave->getType());
    }

    public function testMaxExtras(): void
    {
        $this->assertEquals(0, $this->itemMicrowave->maxExtras());
    }

    public function testAddOneExtraIsError(): void
    {
        $itemController = new ItemController();
        $itemController->setPrice(self::ITEM_EXTRA_1_PRICE);
        $isAdded = $this->itemMicrowave->addExtra($itemController);
        $this->assertFalse($isAdded);
    }

    public function testTryToAddOneExtra(): void
    {
        $itemController = new ItemController();
        $itemController->setPrice(self::ITEM_EXTRA_1_PRICE);
        $this->itemMicrowave->addExtra($itemController);
        $this->assertCount(0, $this->itemMicrowave->getExtras());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->itemMicrowave = new ItemMicrowave();
        $this->itemMicrowave->setPrice(self::ITEM_PRICE);
    }
}
