<?php

function GetJsonFeed($json_url)
{
    $feed = file_get_contents($json_url);
    return json_decode($feed, true);
};

$buy = GetJsonFeed("https://api.coinbase.com/v1/prices/buy");
$cbusd = $buy['total']['amount'];

$brticker = GetJsonFeed("https://api.bitreserve.org/v0/ticker");
foreach ($brticker as $tick) {
	if ($tick['currency'] == "USD" && $tick['pair'] == "BTCUSD"){
		$brusd = round((($tick['ask'] + $tick['bid'])/2)-(0.0045*(($tick['ask'] + $tick['bid'])/2)),2);
	}
}

$pctcost['buy'] = $cbusd;
$pctcost['sell'] = $brusd;

echo json_encode($pctcost);

?>
