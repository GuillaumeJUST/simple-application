<?php
/**
 * Created by PhpStorm.
 * User: gjust
 * Date: 2020-01-21
 * Time: 13:54
 */

namespace App;


class ItemMicrowave extends ElectronicItem
{
    public static $counter = 0;

    public function __construct()
    {
        self::$counter++;
        $this->currentCounter = self::$counter;
    }

    public function getType(): string
    {
        return 'microwave';
    }

    public function maxExtras(): ?int
    {
        return 0;
    }
}
