<?php

use Http\Http as Http;
use Http\HttpHeader as HttpHeader;
use Http\HttpRequest as HttpRequest;
use Http\HttpMessage as HttpMessage;
use Http\SigningRequest as SigningRequest;
use Http\SigningKey as SigningKey;


class SquareModule extends Module {

  public function __construct() {

    parent:: __construct();
    
    $this->name = "square";
    
    $this->routes = array(
      "create-customer" => array(
        "callback" => "CreateSquareCustomer"
      ),
      "customer" => array(
        "callback" => "GetSquareCustomerInfo"
      ),
      "payments" => array(
        "callback" => "GetPayments"
      )
    );

    $this->files = array(
      "Customer.php",
      "SquareCustomer.php",
      "Order.php",
      "ShoppingCart.php"
    );
  }

  public function squareModRoutes(){
		$cybersourceModRoutes = array(
				"transaction" => array(
						"callback" => "getTransaction",
						"content-type" => "application/json", 
						"files" => array()
				),
				"payment" => array(
					"callback" => "processPayment",
					"content-type" => "application/json"
				),
				""
		);
		return $squareModRoutes;
	}

  public function GetPayments(){
    $request = new HttpRequest("https://connect.squareupsandbox.com/v2/payments/" ."vjyG0eVaNRL9WdFeFvAXdJNe2VcZY");

    //$request->addParameter("total", "25");
    //$request->addParameter("card_brand", "VISA");

    $version = new HttpHeader("Square-Version" , "2020-03-25");
    $authorization = new HttpHeader("Authorization" , "Bearer " .API_KEY);

    $request->addHeader($version);
    $request->addHeader($authorization);

    //print "<pre>" .print_r($request->getHeaders(), true) ."</pre>";

    $config = array(
      // "cainfo" => null,
			// "verbose" => false,
			// "stderr" => null,
			// "encoding" => '',
			"returntransfer" => true,
			// "httpheader" => null,
			"useragent" => "Mozilla/5.0",
			// "header" => 1,
			// "header_out" => true,
			"followlocation" => true,
			"ssl_verifyhost" => false,
			"ssl_verifypeer" => false
    );
    
    $http = new Http($config);
    $response = $http->send($request);

   // print "<pre>" .print_r($http->GetSessionLog(), true) ."</pre>";

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

//Parameter will be a customer object
public function GetSquareCustomerInfo($squareCustomerId){

  $getCustRequest = new HttpRequest("https://connect.squareupsandbox.com/v2/customers/" . $squareCustomerId);

  $version = new HttpHeader("Square-Version" , "2020-04-22");
  $authorization = new HttpHeader("Authorization" , "Bearer " .API_KEY);

  $getCustRequest->addHeader($version);
  $getCustRequest->addHeader($authorization);

  $config = array(
    // "cainfo" => null,
			// "verbose" => false,
			// "stderr" => null,
			// "encoding" => '',
			"returntransfer" => true,
			// "httpheader" => null,
			"useragent" => "Mozilla/5.0",
			// "header" => 1,
			// "header_out" => true,
			"followlocation" => true,
			"ssl_verifyhost" => false,
			"ssl_verifypeer" => false
  );
  
  $http = new Http($config);
  $response = $http->send($getCustRequest);

  var_dump($getCustRequest);
  var_dump($response);


  return $customer;
}

//Accepts Customer object
public function CreateSquareCustomer(/* $customer */){
  //Customer for testing
  $customer = new SquareCustomer("Foo","Foob");

  $custJson = json_encode($customer);

  $createCustRequest = new HttpRequest("https://connect.squareupsandbox.com/v2/customers/");

  $createCustRequest->setPost();
  $createCustRequest->setBody($custJson);

  $version = new HttpHeader("Square-Version" , "2020-04-22");
  $authorization = new HttpHeader("Authorization" , "Bearer " .API_KEY); 

  $createCustRequest->addHeader($version);
  $createCustRequest->addHeader($authorization);

  $config = array(
    // "cainfo" => null,
			// "verbose" => false,
			// "stderr" => null,
			// "encoding" => '',
			"returntransfer" => true,
			// "httpheader" => null,
			"useragent" => "Mozilla/5.0",
			// "header" => 1,
			// "header_out" => true,
			"followlocation" => true,
			"ssl_verifyhost" => false,
			"ssl_verifypeer" => false
  );
  
  $http = new Http($config);
  $response = $http->send($createCustRequest);

  var_dump($createCustRequest);
  var_dump($response);

  exit;
}

}
