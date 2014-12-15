<?php


include_once "cbinit.php";



$usdamt = $_POST["usdamt"];
$brusd = $_POST["brusd"];
$pin = $_POST["pin"];

$brcny = $_POST["brcny"];
$breur = $_POST["breur"];
$brgold = $_POST["brgold"];

$assettype = $_POST["assettype"];

if (isset($usdamt) && $pin == $pin_secret){

	$buy = $coinbase->getBuyPrice();
	$buyamt = round((($usdamt-0.15)/$buy),8);

	$user = $coinbase->buy($buyamt);


	// buy BTC from Coinbase with USD
	// ---	

	echo "Buying ".$buyamt." BTC from Coinbase with Bank account...";
	echo "<br>Success... ";
	echo $user->success ? 'true' : 'false';
	//echo "<br>Status... ";
	//echo $user->transfer->status;
	echo "<br>Total... $";
	echo $user->transfer->total->amount;
	echo "<br>";
	echo "--";
	echo "<br>";


	// send BTC to Bitreserve card
	// ---
	
	$received = (round(($buyamt * $brusd),2))-.01;
	
	if ($assettype == "USD"){
		$br_addr = $br_usd_addr;
	}
	if ($assettype == "CNY"){
		$assetamount = $received / $brcny;
		$br_addr = $br_cny_addr;
	} 
	if ($assettype == "EUR"){
		$assetamount = $received / $breur;
		$br_addr = $br_eur_addr;
	} 
	if ($assettype == "Gold"){
		$assetamount = $received / $brgold;
		$br_addr = $br_gold_addr;
	} 
	
	
	echo "Sending ".$buyamt." BTC to Bitreserve ".$assettype." card...";
	echo "<br>Success... ";
	$response = $coinbase->sendMoney($br_addr, $buyamt, "to bitreserve");
	echo $response->success ? 'true' : 'false';
	//echo "<br>Status... ";
	//echo $response->transaction->status;
	echo "<br>";
	echo "--";


	// show summary of USD spent and received
	// ---

	$spent = $user->transfer->total->amount;
	

    echo "<br>Sent from Bank Account... $".$spent."<br>";
    
	if ($assettype == "USD") {
		echo "Received at Bitreserve... $".$received;
	} else {
		echo "Received at Bitreserve... ~".round($assetamount,2)." ".$assettype." ($".$received.")";	
	}
    
	echo "<br>";
	echo "--";
	echo "<br>Total Fee... $".round(($spent-$received),2);



}else {
	echo "An Error has Occurred";
}
?>
