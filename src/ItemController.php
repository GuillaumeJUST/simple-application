<?php
/**
 * Created by PhpStorm.
 * User: gjust
 * Date: 2020-01-21
 * Time: 13:54
 */

namespace App;


use http\Exception\RuntimeException;

class ItemController extends ElectronicItem
{
    public static $counter = 0;

    public const TYPE_REMOTE = 'remote';
    public const TYPE_WIRED = 'wired';
    public const TYPE_DEFAULT = self::TYPE_WIRED;

    private const TYPES_ALLOWED = [self::TYPE_REMOTE, self::TYPE_WIRED];

    private $type;

    public function __construct($type = self::TYPE_DEFAULT)
    {
        self::$counter++;
        $this->currentCounter = self::$counter;

        if (\in_array($type, self::TYPES_ALLOWED, true)) {
            $this->type = $type;
        } else {
            $this->type = self::TYPE_DEFAULT;
        }
    }

    public function getType(): string
    {
        return $this->type . ' controller';
    }

    public function maxExtras(): ?int
    {
        return 0;
    }
}
