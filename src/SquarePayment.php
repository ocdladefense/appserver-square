<?php

class SquarePayment extends ClickpdxStore\Payment {

    private $money;
    private $idempotencyKey;

    public function __construct($sourceId) {
        parent::__construct($sourceId);

        $this->idempotencyKey = uniqid();
    }
    public function setNonce($sourceId) {        
        $this->token = $sourceId;
    }
    public function getNonce() {        
        return $this->$token;
    }

    public function setMoney($shoppingCart) {
        $array = array(
            "amount" => $shoppingCart->calculateTotal(),
            "currency"  => "USD"
        ); 

        $this->money = $array;
    } 
    public function toJson(){
        $info = array(
            /* "status"            => $this->status,
            "lastFour"          => $this->lastFour,
            "cardType"          => $this->cardType, */
            "source_id"          => $this->token,
            "amount_money"       => $this->money,
            "idempotency_key"    => $this->idempotencyKey
        );

        $error = array(
            "status"    => "Server returned a " . $this->status . "status code.",
            "body"          => "Response Body: <pre>" . print_r($this->respBody,true) . "</pre>",
            "curlInfo"      => "Curl Info: <pre>" . print_r($this->log,true) . "</pre>"
        );

        return json_encode($this->hasError ? $error : $info);
    }
   
    
}