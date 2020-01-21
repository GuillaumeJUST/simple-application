<?php
/**
 * Created by PhpStorm.
 * User: gjust
 * Date: 2020-01-21
 * Time: 14:44
 */

use App\ItemConsole;
use App\ItemController;
use PHPUnit\Framework\TestCase;


class ItemConsoleTest extends TestCase
{
    private const ITEM_PRICE = 15;

    /**
     * @var ItemConsole
     */
    private $itemConsole;

    public function testMaxExtras(): void
    {
        $this->assertEquals(4, $this->itemConsole->maxExtras());
    }

    public function testGetType(): void
    {
        $this->assertEquals('console', $this->itemConsole->getType());
    }

    public function testAddLimitExtra(): void
    {
        $this->addAnExtraController(10);
        $this->addAnExtraController(20);
        $this->addAnExtraController(30);
        $isAdded = $this->addAnExtraController(50);
        $this->assertTrue($isAdded);
    }

    public function testTryToAddToMuchExtra(): void
    {
        $this->addAnExtraController(10);
        $this->addAnExtraController(20);
        $this->addAnExtraController(30);
        $this->addAnExtraController(40);
        $isAdded = $this->addAnExtraController(50);
        $this->assertFalse($isAdded);
    }

    public function testHasReachMaxExtraNo(): void
    {
        $this->addAnExtraController(10);
        $this->addAnExtraController(20);
        $this->addAnExtraController(30);
        $this->assertFalse($this->itemConsole->hasReachMaxExtras());
    }

    public function testHasReachMaxExtraYes(): void
    {
        $this->addAnExtraController(10);
        $this->addAnExtraController(20);
        $this->addAnExtraController(30);
        $this->addAnExtraController(40);
        $this->assertTrue($this->itemConsole->hasReachMaxExtras());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->itemConsole = new ItemConsole();
        $this->itemConsole->setPrice(self::ITEM_PRICE);
    }

    private function addAnExtraController(float $price): bool
    {
        $itemController = new ItemController();
        $itemController->setPrice($price);

        return $this->itemConsole->addExtra($itemController);
    }
}
