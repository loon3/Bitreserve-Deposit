<?php

function GetJsonFeed($json_url)
{
    $feed = file_get_contents($json_url);
    return json_decode($feed, true);
};

$buy = GetJsonFeed("https://api.coinbase.com/v1/prices/buy");


$brticker = GetJsonFeed("https://api.bitreserve.org/v0/ticker");
foreach ($brticker as $tick) {
	if ($tick['currency'] == "USD" && $tick['pair'] == "BTCUSD"){
		$brusd = round((($tick['ask'] + $tick['bid'])/2)-(0.0045*(($tick['ask'] + $tick['bid'])/2)),2);
	}
	if ($tick['currency'] == "USD" && $tick['pair'] == "EURUSD"){
		$breur = round((($tick['ask'] + $tick['bid'])/2)-(0.0095*(($tick['ask'] + $tick['bid'])/2)),4);		
	}
	if ($tick['currency'] == "CNY" && $tick['pair'] == "USDCNY"){
		$brcny = (($tick['ask'] + $tick['bid'])/2)-(0.02*(($tick['ask'] + $tick['bid'])/2));		
	}
	if ($tick['currency'] == "USD" && $tick['pair'] == "XAUUSD"){
		$brgold = round((($tick['ask'] + $tick['bid'])/2)-(0.024*(($tick['ask'] + $tick['bid'])/2)),4);		
	}
	
	
}
$pctcost['buy'] = $buy['total']['amount'];
$pctcost['sell'] = $brusd;

$pctcost['eur'] = $breur;

$pctcost['cny'] = round((1/$brcny),4);

$pctcost['gold'] = $brgold;

echo json_encode($pctcost);

?>
