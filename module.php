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
        "callback" => "CreateOrUpdateSquareCustomer"
      ),
      "create-customer-form" => array(
        "callback" => "CreateCustomerForm"
      ),
      "customer" => array(
        "callback" => "GetSquareCustomerInfo"
      ),
      "payment-form" => array(
        "callback" => "SubmitPaymentForm"
      ),
      "process-payment" => array(
        "callback" => "ProcessPayment"
      ),
      "payments" => array(
        "callback" => "GetPayments"
      )
    );

    $this->files = array(
      "Customer.php",
      "SquareCustomer.php",
      "Order.php",
      "ShoppingCart.php",
      "SquarePayment.php"
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
  public function ProcessPayment(){
    $body = $this->request->getBody();

    var_dump($body);

    $cardNonce = $body->nonce;

    $processPaymentrequest = new HttpRequest("https://connect.squareupsandbox.com/v2/payments");

    //Shopping cart with 1 item for testing
    $cart = new ShoppingCart;
    $cart->setTotal(1.00);
    $cart->setCurrency("USD");


    $payment = new SquarePayment($cardNonce);
    var_dump($payment);
    $payment->setMoney($cart);

    $processPaymentrequest->setPost();
    $processPaymentrequest->setBody($payment->toJson());

    $version = new HttpHeader("Square-Version" , "2020-03-25");
    $authorization = new HttpHeader("Authorization" , "Bearer " .API_KEY);
    $contentType = new HttpHeader("Content-Type" , "application/json");


    $processPaymentrequest->addHeader($version);
    $processPaymentrequest->addHeader($authorization);
    $processPaymentrequest->addHeader($contentType);


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
    
    var_dump($processPaymentrequest->getBody());

    $response = $http->send($processPaymentrequest);

   // print "<pre>" .print_r($http->GetSessionLog(), true) ."</pre>";

    var_dump($processPaymentrequest);
    var_dump($response);

    exit;
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

  public function SubmitPaymentForm(){
    print __DIR__;
    // dotenv is used to read from the '.env' file created for credentials
    $dotenv = Dotenv\Dotenv::create(__DIR__);
    $dotenv->load();
 
    Template::addPath(__DIR__ . "/templates");
    $template = Template::loadTemplate("webconsole");
    $paymentForm = Template::renderTemplate("payment-form", array("create" => array()));
  
  
    // ... and custom styles.
    $css = array(
      "active" => true,
      "href" => "/modules/square/css/sq-payment-form.css",
    );

    $template->addStyle($css);
  
    // include all js files
    $js = array(
      array(
        "src" => "/modules/square/js/sq-payment-form.js"
      )
    );
  
    $template->addScripts($js);
  
    return $template->render(array(
      "defaultStageClass" => "not-home", 
      "content" => $paymentForm,
      "doInit" => false
    ));


    
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

public function CreateCustomerForm(){
  Template::addPath(__DIR__ . "/templates");
  $template = Template::loadTemplate("webconsole");
  $createCustomerForm = Template::renderTemplate("create-customer", array("create" => array()));


  // ... and custom styles.
  $css = array(
    "active" => true,
    "href" => "/modules/square/css/styles.css",
  );

  $template->addStyle($css);

  // include all js files
  $js = array(
    array(
      "src" => "/modules/square/js/validation.js"
    )
  );

  $template->addScripts($js);

  return $template->render(array(
    "defaultStageClass" => "not-home", 
    "content" => $createCustomerForm,
    "doInit" => false
  ));


}

public function CreateOrUpdateSquareCustomer(){
  $body = $this->request->getBody();

  var_dump(($_SESSION["customer"]));

  $cust = $_SESSION["customer"];

  var_dump($cust);
  var_dump($body);

  //If _SESSION contains a customer object, set to PUT and change endpoint
  if(isset($_SESSION["customer"]) && $cust->getProcessorId() != null ){
     $createCustRequest = new HttpRequest("https://connect.squareupsandbox.com/v2/customers/" .$cust->getProcessorId());
     $createCustRequest->setPut();
   }
  else{
    $createCustRequest = new HttpRequest("https://connect.squareupsandbox.com/v2/customers"); 
    $createCustRequest->setPost();
  }
  
  var_dump($createCustRequest);

  $customer = new SquareCustomer($body->fname,$body->lname);
  $customer->setEmail($body->email);
  //$custJson = $customer->jsonSerialize();

  $custJson = json_encode($customer->jsonSerialize());

  $createCustRequest->setBody($custJson);

  $version = new HttpHeader("Square-Version" , "2020-04-22");
  $authorization = new HttpHeader("Authorization" , "Bearer " .API_KEY); 
  $contentType = new HttpHeader("Content-Type" , "application/json"); 

  $createCustRequest->addHeader($version);
  $createCustRequest->addHeader($authorization);
  $createCustRequest->addHeader($contentType);

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
  print("<pre>" .print_r($http->getSessionLog(), true). "</pre>");
  var_dump($response->getHeaders());

  $customerJson = json_decode($response->getBody());
  var_dump($response->getBody());
  var_dump($customerJson);


  //Static call
  $_SESSION["customer"] = SquareCustomer::fromJson($customerJson); 
  //var_dump($customerJson);
  //var_dump($createCustRequest);
  //var_dump($response);
  var_dump($_SESSION);


  exit;
}
}
