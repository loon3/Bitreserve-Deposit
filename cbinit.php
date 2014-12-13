<?php

require_once(dirname(__FILE__) . '/lib/Coinbase.php');
include_once "user.php";

$coinbase = Coinbase::withApiKey($_API_KEY, $_API_SECRET);

?>
