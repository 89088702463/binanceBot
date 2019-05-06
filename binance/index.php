<?php

//require 'vendor/autoload.php';
//use baitercel/binance-api-php dev-master;
require 'BinanceClass.php';
$api = new Binance("q8HCV6SKp0oR3lovTooM55BGvtXFG2pa8luJRYBcjFH6zGmtHo4dxBVnlcpyQwsF","u4UYokjkSN7I0tOoT3YRYakeaMOYyA12Pc9iSxYPBYlqEcLdsTy2Mixe6fEnAqbu");

$ticker = $api->prices();
print_r($ticker); // List prices of all symbols
echo "Price of BNB: {$ticker['BNBBTC']} BTC.\n";

$balances = $api->balances($ticker);
print_r($balances);
echo "BTC owned: ".$balances['BTC']['available']."\n";
echo "ETH owned: ".$balances['ETH']['available']."\n";
echo "Estimated Value: ".$api->btc_value." BTC\n";

?>