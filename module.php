<?php

use Http\Http as Http;
use Http\HttpHeader as HttpHeader;
use Http\HttpRequest as HttpRequest;
use Http\HttpMessage as HttpMessage;
use Http\SigningRequest as SigningRequest;
use Http\SigningKey as SigningKey;
use \Html\HtmlLink;
use function \Html\createElement as createElement;

define("DOM_SECTION_BREAK","<p>&nbsp;</p>");

define("DOM_COMMA",",");

define("DOM_LINE_BREAK","<br />");

define("DOM_SPACE"," ");


$instance_url = "https://business-innovation-5996-dev-ed.cs69.my.salesforce.com";
$access_token = "foobar";

// SQUARE API ENDPOINTS NEEDED
/*
	Create Customer
	Retrieve Customer
	Update Customer
	Add Customer Card
	Delete Customer Card

	Create Payment
*/
class SquareModule extends Module {
  private $oauth_config = array(
		"oauth_url" => SALESFORCE_LOGIN_URL,
		"client_id" => SALESFORCE_CLIENT_ID,
		"client_secret" => SALESFORCE_CLIENT_SECRET,
		"username" => SALESFORCE_USERNAME,
		"password" => SALESFORCE_PASSWORD,
		"security_token" => SALESFORCE_SECURITY_TOKEN,
		"redirect_uri" => SALESFORCE_REDIRECT_URI
		);

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
  
  
  
  public function ProcessPayment() {
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
    $authorization = new HttpHeader("Authorization" , "Bearer " .SQUARE_API_KEY);
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

	public function CheckoutReview(){
		$tpl = new CartTemplate($_SESSION["cart_id"]);
		$tpl->addPath(__DIR__ . "/templates");


		//a couple of accs
		//producs
		//new opportunity with line items
		//
		//$tpl->bind("opportunity",$this->GetOpportunity());
		//$tpl->bind("card",$this->GetSalesforceCards());
		return $tpl;
	}

	public function GetOpportunity($oppId){
		$salesforce = new Salesforce($this->oauth_config);
		$json = array(
			'OppInfo' => $salesforce->createQueryFromSession("select Id, Amount, Name, StageName, Description,AccountId from Opportunity where Id = '".$oppId."'"), 
			'OppLineItems' => $salesforce->createQueryFromSession("select Id,Description,ListPrice,Product2Id,ProductCode,Quantity,UnitPrice,TotalPrice from OpportunityLineItem where OpportunityId = '".$oppId."'")
		);
		return($json);
		//return $salesforce->createQueryFromSession("select Id, Amount, Name, StageName, Description,AccountId from Opportunity where Id = '".$oppId."'");
	}

	public function OrderPreview($orderId){
		$tpl = new OrderTemplate();
		if($orderId == null){
			$tpl = new OrderTemplate($orderId);
		}
		//$tpl = new OrderTemplate();
		return $tpl;
	}

	public function GetSalesforceCards(){
		$salesforce = new Salesforce($this->oauth_config);
		return $salesforce->createQueryFromSession("select Id, AccountId, AutoCardType, CardBin, CardCategory, CardHolderFirstName, ".
					"CardHolderLastName, CardHolderName, CardLastFour, CardType, Comments, CreatedDate, DisplayCardNumber, ExpiryMonth, ExpiryYear, ".
					"InputCardNumber, NickName, PaymentMethodAddress, Phone, ProcessingMode, Email, Status from CardPaymentMethod");
	}

	public function CreateOrUpdateCustomerForm(){

		//$tpl = new CartTemplate();
		//($_SESSION["customer"]);
		//$tpl->addPath(__DIR__ . "/templates");

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

	public function CreateOrUpdateSquareCustomer() {


		$body = $this->request->getBody();

		// var_dump(($_SESSION["customer"]));

		$cust = $_SESSION["customer"];

		// var_dump($cust);
		// var_dump($body);
	
	
		$version = new HttpHeader("Square-Version" , "2020-04-22");
		$authorization = new HttpHeader("Authorization" , "Bearer " .SQUARE_API_KEY); 
		$contentType = new HttpHeader("Content-Type" , "application/json"); 
	
	

		// If SESSION contains a customer object, set to PUT and modify endpoint.
		if(isset($_SESSION["customer"]) && $cust->getProcessorId() != null ) {
			 $req = new HttpRequest("https://connect.squareupsandbox.com/v2/customers/" .$cust->getProcessorId());
			 $req->setPut();
		} else {
			$req = new HttpRequest("https://connect.squareupsandbox.com/v2/customers"); 
			$req->setPost();
		}
	


		$customer = new SquareCustomer($body->fname,$body->lname);
		$customer->setEmail($body->email);

		$req->setBody($customer->toJson());


		// DEBUG
		print "<h2>Square API Request</h2>";
		var_dump($req);





		// Configure the HTTP service.
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


		$req->addHeader($version);
		$req->addHeader($authorization);
		$req->addHeader($contentType);
		
		$resp = $http->send($req);
		
		
		// DEBUG
		print "<h2>HTTP Sending... log</h2>";
		print("<pre>" .print_r($http->getSessionLog(), true). "</pre>");
		
		// DEBUG
		print "<h2>Response body... </h2>";
		var_dump(json_decode($resp->getBody()));
		
		// DEBUG
		print "<h2>Response... </h2>";
		var_dump($resp);
		
		print "<h2>Response headers... </h2>";
		var_dump($resp->getHeaders());

		
		
		
		
		exit;
		
		
		var_dump($customerJson);


		// Static call
		$_SESSION["customer"] = SquareCustomer::fromJson($customerJson); 
		var_dump($_SESSION);


		exit;
	}
}
