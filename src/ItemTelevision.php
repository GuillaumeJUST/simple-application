<?php
/**
 * Created by PhpStorm.
 * User: gjust
 * Date: 2020-01-21
 * Time: 13:54
 */

namespace App;


class ItemTelevision extends ElectronicItem
{
    public static $counter = 0;

    public function __construct()
    {
        self::$counter++;
        $this->currentCounter = self::$counter;
    }

    public function getType(): string
    {
        return 'television';
    }

    public function maxExtras(): ?int
    {
        return null;
    }
}
