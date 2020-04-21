<?php

use Http\Http as Http;
use Http\HttpHeader as HttpHeader;
use Http\HttpRequest as HttpRequest;
use Http\HttpMessage as HttpMessage;
use Http\SigningRequest as SigningRequest;
use Http\SigningKey as SigningKey;


class SquareModule extends Module {


  public function __construct() {
    $this->routes = array(
        "square" => array(
            "callback" => "getPayments"
            )
        );
}

public function GetPayments(){
  $request = new HttpRequest("https://connect.squareupsandbox.com/v2/payments?total=25&begin_time=452452&end_time=2452&
  sort_order=4142&cursor=dfsdfg&location_id=42&last_4=452&card_brand=bvzdfg");

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

//AddParameter(), RemoveParameter()

}
