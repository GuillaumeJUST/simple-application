<?php

namespace App;

class ElectronicItem
{
    /** * @var float */
    private $price;

    /** * @var string */
    private $type;

    private $wired;

    public const ELECTRONIC_ITEM_TELEVISION = 'television';
    public const ELECTRONIC_ITEM_CONSOLE = 'console';
    public const ELECTRONIC_ITEM_MICROWAVE = 'microwave';

    public static $types = [self::ELECTRONIC_ITEM_CONSOLE, self::ELECTRONIC_ITEM_MICROWAVE, self::ELECTRONIC_ITEM_TELEVISION];

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getWired()
    {
        return $this->wired;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setWired($wired): void
    {
        $this->wired = $wired;
    }
}
