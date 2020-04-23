<?php

use Http\Http as Http;
use Http\HttpHeader as HttpHeader;
use Http\HttpRequest as HttpRequest;
use Http\HttpMessage as HttpMessage;
use Http\SigningRequest as SigningRequest;
use Http\SigningKey as SigningKey;


class SquareModule extends Module {

  public function __construct() {
    
    $this->name = "square";
    
    $this->routes = array(
      "square" => array(
        "callback" => "getPayments"
      )
    );

    $this->files = array(
      "Customer.php",
      "Order.php",
      "ShoppingCart.php"
    );
  }

  public function GetPayments(){
    $request = new HttpRequest("https://connect.squareupsandbox.com/v2/payments");

    $version = new HttpHeader("Square-Version" , "2020-03-25");
    $authorization = new HttpHeader("Authorization" , "Bearer " .API_KEY);

    $request->addHeader($version);
    $request->addHeader($authorization);

    $config = array(
      // "cainfo" => BASE_PATH . "/vendor/cybersource/rest-client-php/lib/ssl/cacert.pem",
      "verbose" => true,
      // "encoding" => '',
      "returntransfer" => true,
      "useragent"	=> "Mozilla/5.0"
    );
    
    $http = new Http($config);
    $response = $http->send($request);

    var_dump($request);
    var_dump($response);


    exit;
  }

// SQUARE API ENDPOINTS NEEDED
/*
  Create Customer
  Retrieve Customer
  Update Customer
  Add Customer Card
  Delete Customer Card

  Create Payment

  ---------- CONTEXT OBJECTS ----------

  Current Customer: Currently logged in customer

  Shopping Cart: Contains 0 or more products at the price that was available when the customer added the product to their cart

    $cart = new ShoppingCart();

                (Need a refresh method)
                refresh() {
                  // evaluate all items in customer cart
                  // alert customer 

                  // compare price in customers cart with most current price
                }

  Order: Must fufill every line item in order (Square API createPayment(order))


  Start with a template file with hardcoded API info and submit button

*/

//AddParameter(), RemoveParameter()

}
