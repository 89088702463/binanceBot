<?php
/*
 * Bot Binance
 * Documentation https://github.com/binance-exchange/binance-official-api-docs/blob/master/rest-api.md
 */
include('API.php');
/**
 * Get server time
 * the server time must be obtained to sign the requests curl
 * Time is the variable used for requests
 */
$ServerTimeUrl='https://api.binance.com/api/v1/time'; 
$ClassServerTime = new APIREST($ServerTimeUrl);
$CallServerTime = $ClassServerTime->call(array());
$DecodeCallTime= json_decode($CallServerTime);
$Time = $DecodeCallTime->serverTime;
$ApiKey='q8HCV6SKp0oR3lovTooM55BGvtXFG2pa8luJRYBcjFH6zGmtHo4dxBVnlcpyQwsF';
$ApiSecret='u4UYokjkSN7I0tOoT3YRYakeaMOYyA12Pc9iSxYPBYlqEcLdsTy2Mixe6fEnAqbu';
$Timestamp = 'timestamp='.$Time; // build timestamp type url get
$Signature = hash_hmac('SHA256',$Timestamp ,$ApiSecret); 
// build firm with sha256
/**
 * Get balance
 * @var BalanceUrl is the url of the request
 * @var ClassBalance initializes the APIREST class
 * @var CallBalance request balance sheets, X-MBX-APIKEY is required by binance api
 */
$OpenOrders = getOpenOrder();
if(count($OpenOrders) > 0){
    echo count($OpenOrders);
    echo("<p>");
    print_r($OpenOrders[0]);
    echo("<p>");
    $Price = getPrice();
}else{
//если ордеров нет, то выставляем два ордера buy и sell
    $Price = getPrice();
    print_r($Price);
}

function getPrice(){
    global $Time,$ApiKey,$Signature;
    $BalanceUrl='https://api.binance.com/api/v3/avgPrice?signature='.$Signature;
    $ClassBalance = new APIREST($BalanceUrl);
    $OpenOrders= $ClassBalance->call(
    	array('X-MBX-APIKEY:'.$ApiKey)
    );
    $Price = json_decode($Price, true);
    return $Price;
}

function getOpenOrder(){
    global $Time,$ApiKey,$Signature;
    $BalanceUrl='https://api.binance.com/api/v3/openOrders?timestamp='.$Time.'&signature='.$Signature;
    $ClassBalance = new APIREST($BalanceUrl);
    $OpenOrders= $ClassBalance->call(
    	array('X-MBX-APIKEY:'.$ApiKey)
    );
    $OpenOrders = json_decode($OpenOrders, true);
    return $OpenOrders;
}

?>