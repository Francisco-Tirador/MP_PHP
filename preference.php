<?php 
require './vendor/autoload.php';
MercadoPago\SDK::setAccessToken("TEST-5815584323800259-111015-b284fbb9b207b88c1260342d84b5d5d6-1377005579");


$preference = new MercadoPago\Preference();
$item = new MercadoPago\Item();
$item->id = "45";
$item->title="test";
$item->quantity = 1;
$item->unit_price="54545";
$item->currency_id= 'MXN';
$preference->items = array($item);

$preference->back_urls=array(
    'success'=>'https://trackjc.com/sasammr/controller/mercadoPago.php?orden=',
    'failure'=>'https://trackjc.com/sasammr/controller/mercadoPago.php?orden='
    ) ;

$preference->auto_return = "approved";

$preference->payment_methods = array(
    "default_payment_type_id" => "credit_card",

    "excluded_payment_methods" => array(
        array("id" => "atm")
      ),

    "excluded_payment_types" => array(
        
        array("id" => "ticket"), 
        array("id" => "bank_transfer"), 
        array("id" => "atm"), 
    ),
    "installments" => 12 
);


$preference->save();


?>