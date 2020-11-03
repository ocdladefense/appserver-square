<?php

use \Http\IJson as IJson;
class ShoppingCart3 implements IJson{

    private $items;
    private $total;
    private $currency;



    public function __construct($currency = "USD") {
        $this->total = $total;
        $this->currency = $currency;
    }

    public function refresh() {
        return $this->items;
    }

    //Setters
    public function setTotal($total){
        $this->total = $total;
    }

    public function setCurrency($currency){
        $this->currency = $currency;
    }

    //Getters

    public function getItems() {
        //return $this->items;
        return array(
            array(
                "name" => "Fooby",
                "productId" => "00001",
                "productPrice" => 20.00,
                "quantity" => 400
            )
        );
    }

    public function getTotal(){
        return $this->total;
    }

    public function getCurrency(){
        return $this->currency;
    }
    public function calculateTotal(){
        $itemsArray = $this->getItems(); 
        $total;

        foreach($itemsArray as $item){
            $total += $item["productPrice"]; 
        }

        return $total;
    }


    /**
     * 
     */
    public static function fromParams($params){
		$cart = new ShoppingCart();
		$cart->setTotal($params->total);
		$cart->setCurrency($params->currency ?: "USD");

		return $cart;
    }
    // public static function newFromCustomerId($customerId){

	// 	$response = $salesforce->createRecordFromSession("Opportunity",json_encode($customerId));
	// 	$response = json_decode($response);
	// 	if($response->success){
	// 		$_SESSION["cartId"] = $response->id;
	// 		return $response->id;
	// 	}else{
	// 		//throw new Exception("");
	// 		return $response;
	// 	}
    // }

    public function toJson(){
        
    }

}