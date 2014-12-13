<?php


include_once "cbinit.php";



$usdamt = $_POST["usdamt"];
$brusd = $_POST["brusd"];
$pin = $_POST["pin"];

if (isset($usdamt) && $pin == $pin_secret){

	$buy = $coinbase->getBuyPrice();
	$buyamt = round((($usdamt-0.15)/$buy),8);

	$user = $coinbase->buy($buyamt);


	// buy BTC from Coinbase with USD
	// ---	

	echo "Buying ".$buyamt." BTC from Coinbase with Bank account...";
	echo "<br>Success... ";
	echo $user->success ? 'true' : 'false';
	echo "<br>Total... $";
	echo $user->transfer->total->amount;
	echo "<br>";
	echo "--";
	echo "<br>";


	// send BTC to Bitreserve USD card
	// ---
	
	echo "Sending ".$buyamt." BTC to Bitreserve USD card...";
	echo "<br>Success... ";
	$response = $coinbase->sendMoney($br_usd_addr, $buyamt, "to bitreserve");
	echo $response->success ? 'true' : 'false';
	echo "<br>";
	echo "--";


	// show summary of USD spent and received
	// ---

	$spent = $user->transfer->total->amount;
	$received = (round(($buyamt * $brusd),2))-.01;

  echo "<br>Sent from Bank Account... $".$spent;
  echo "<br>Received at Bitreserve... $".$received;    
	echo "<br>";
	echo "--";
	echo "<br>Total Fee... $".round(($spent-$received),2);

} else {
	echo "An Error has Occurred";
}
?>
