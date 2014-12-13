<?php

include_once "cbinit.php";

$maxbtc = $coinbase->getBalance();
$cbusd = $coinbase->getBuyPrice();

$pctcost['max'] = round(($maxbtc * $cbusd),2);

echo json_encode($pctcost);

?>
