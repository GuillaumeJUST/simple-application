<?php

use App\ItemTelevision;
use App\ItemController;
use PHPUnit\Framework\TestCase;


class ItemTelevisionTest extends TestCase
{

    private const ITEM_PRICE = 15;
    private const ITEM_EXTRA_1_PRICE = 20;
    private const ITEM_EXTRA_2_PRICE = 5;

    /**
     * @var ItemTelevision
     */
    private $itemTelevision;

    public function testMaxExtras(): void
    {
        $this->assertNull($this->itemTelevision->maxExtras());
    }

    public function testGetPrice(): void
    {
        $this->assertEquals(self::ITEM_PRICE, $this->itemTelevision->getPrice());
    }

    public function testGetType(): void
    {
        $this->assertEquals('television', $this->itemTelevision->getType());
    }

    public function testGetName(): void
    {
        $this->assertEquals('Television '.ItemTelevision::$counter, $this->itemTelevision->getName());
    }

    public function testGetNoExtra(): void
    {
        $this->assertCount(0, $this->itemTelevision->getExtras());
    }

    public function testAddOneExtraIsAdded(): void
    {
        $isAdded = $this->addAnExtraController(self::ITEM_EXTRA_1_PRICE);
        $this->assertTrue($isAdded);
    }

    public function testAddOneExtra(): void
    {
        $this->addAnExtraController(self::ITEM_EXTRA_1_PRICE);
        $this->assertCount(1, $this->itemTelevision->getExtras());
    }

    public function testAddTwoExtra(): void
    {
        $this->addAnExtraController(self::ITEM_EXTRA_1_PRICE);
        $this->addAnExtraController(self::ITEM_EXTRA_2_PRICE);
        $this->assertCount(2, $this->itemTelevision->getExtras());
    }

    public function testAddTwoExtraTotalPrice(): void
    {
        $this->addAnExtraController(self::ITEM_EXTRA_1_PRICE);
        $this->addAnExtraController(self::ITEM_EXTRA_2_PRICE);
        $totalPrice = self::ITEM_PRICE + self::ITEM_EXTRA_1_PRICE + self::ITEM_EXTRA_2_PRICE;
        $this->assertEquals($totalPrice, $this->itemTelevision->getTotalPrice());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->itemTelevision = new ItemTelevision();
        $this->itemTelevision->setPrice(self::ITEM_PRICE);
    }

    private function addAnExtraController(float $price): bool
    {
        $itemController = new ItemController();
        $itemController->setPrice($price);

        return $this->itemTelevision->addExtra($itemController);
    }
}
