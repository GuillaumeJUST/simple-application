<?php

require_once 'vendor/autoload.php';

echo PHP_EOL;
displayTitle('Question 1');
echo PHP_EOL;

$currency = '$';

function displayTitle($title) {
    echo str_pad(' ' . $title . ' ', '40', '=', STR_PAD_BOTH) . PHP_EOL;
}

function getRandomPrice($max = 100000) {
    try {
        return random_int(0, $max) / 100;
    } catch (Exception $e) {
        throw new \http\Exception\RuntimeException($e);
    }
}

function addControllerToElectronicItem(\App\ElectronicItem $electronicItem, $type) {
    $itemController = new \App\ItemController($type);
    $itemController->setPrice(getRandomPrice(5000));
    $isAdded = $electronicItem->addExtra($itemController);
    if (!$isAdded) {
        echo 'Warning: unable to add a controller to ' . $electronicItem->getName() . PHP_EOL;
    }
}

function displayRowItemPrice(string $name, float $price) {
    global $currency;
    $priceFormatted = number_format($price, 2, ',', ' ');
    echo str_pad($name, 20, ' ', STR_PAD_RIGHT) .' ' . str_pad($priceFormatted.' ' . $currency, 10, ' ', STR_PAD_LEFT) . PHP_EOL;
}

$items = [];

$itemConsole = new \App\ItemConsole();
$itemConsole->setPrice(getRandomPrice());
addControllerToElectronicItem($itemConsole, \App\ItemController::TYPE_REMOTE);
addControllerToElectronicItem($itemConsole, \App\ItemController::TYPE_REMOTE);
addControllerToElectronicItem($itemConsole, \App\ItemController::TYPE_WIRED);
addControllerToElectronicItem($itemConsole, \App\ItemController::TYPE_WIRED);
$items[] = $itemConsole;

$itemTelevision = new \App\ItemTelevision();
$itemTelevision->setPrice(getRandomPrice());
addControllerToElectronicItem($itemTelevision, \App\ItemController::TYPE_REMOTE);
addControllerToElectronicItem($itemTelevision, \App\ItemController::TYPE_REMOTE);
$items[] = $itemTelevision;

$itemTelevision = new \App\ItemTelevision();
$itemTelevision->setPrice(getRandomPrice());
addControllerToElectronicItem($itemTelevision, \App\ItemController::TYPE_REMOTE);
$items[] = $itemTelevision;

$itemMicrowave = new \App\ItemMicrowave();
$itemMicrowave->setPrice(getRandomPrice());
$items[] = $itemMicrowave;

$electronicItems = new \App\ElectronicItems($items);
$itemsWithExtras = $items;
foreach ($electronicItems->getSortedItems() as $electronicItem) {
    displayRowItemPrice($electronicItem->getName(), $electronicItem->getTotalPrice());
    $itemsWithExtras = array_merge($itemsWithExtras, $electronicItem->getExtras());
}

displayTitle('Details');
$electronicItemsWithExtras = new \App\ElectronicItems($itemsWithExtras);
foreach ($electronicItemsWithExtras->getSortedItems(false) as $electronicItem) {
    displayRowItemPrice($electronicItem->getName(), $electronicItem->getPrice());
}
displayTitle('Total');
displayRowItemPrice('Total pricing is', $electronicItems->getTotalPrice());
