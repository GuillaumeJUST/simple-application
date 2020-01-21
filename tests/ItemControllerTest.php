<?php
/**
 * Created by PhpStorm.
 * User: gjust
 * Date: 2020-01-21
 * Time: 14:44
 */

use App\ItemController;
use PHPUnit\Framework\TestCase;


class ItemControllerTest extends TestCase
{
    private const ITEM_PRICE = 15;

    /**
     * @var ItemController
     */
    private $itemController;

    protected function setUp(): void
    {
        parent::setUp();

        $this->itemController = new ItemController();
        $this->itemController->setPrice(self::ITEM_PRICE);
    }

    public function testGetType(): void
    {
        $this->assertEquals('wired controller', $this->itemController->getType());
    }

    public function testMaxExtras(): void
    {
        $this->assertEquals(0, $this->itemController->maxExtras());
    }

    public function testInitWithWrongType(): void
    {
        $itemController = new ItemController('foo');
        $itemController->setPrice(self::ITEM_PRICE);
        $this->assertEquals('wired controller', $itemController->getType());
    }
}
