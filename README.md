BitDeposit
==========
Transfer USD from your bank account to Bitreserve bitUSD (via Coinbase)

Requirements
------------

* Bitreserve account, bitcoin address from USD card (https://bitreserve.org/)
* Coinbase account, API key + secret (https://www.coinbase.com/docs/api/authentication)

Instructions
------------

Enter your Coinbase API key + secret and Bitreserve USD card bitcoin address in `user.php`

How it Works
------------

* Enter the USD amount you would like to transfer
* BitDeposit shows an estimated total transfer fee prior to initiating transaction which includes: Coinbase bank fee, Bitreserve transaction fee, BTC/USD rate difference between Coinbase and Bitreserve
* Click button to transfer.  This simultaneously purchases USD equivalent in bitcoin via your Coinbase account then transfers the same amout to your Bitreserve USD card.
* Your current Coinbase balance acts as the float to send bitcoin to Bitreserve until the purchased bitcoins are available in your Coinbase wallet.  For this reason, the maximum amount you can deposit via BitDeposit is limited by your Coinbase balance.

Demo
----

http://joelooney.org/bitdeposit/

Demo transfer password is 1234
