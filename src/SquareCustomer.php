<?php

class SquareCustomer extends Customer {

    public function __construct($firstName, $lastName) {
        parent::__construct($firstName, $lastName);
    }

    public function toJson()
    {
        $tmp = array(
            "given_name"    => $this->firstName,
            "family_name"   => $this->lastName,
            "address"       => $this->address,
            "email_address" => $this->email,
            "birthday"      => $this->birthday,
            "customer_id"   => $this->processorId
        );
        
        return json_encode($tmp);
    }
    
    public static function fromJson($obj){
        $firstName = $obj->customer->given_name;
        $lastName = $obj->customer->family_name;
        $processorId = $obj->customer->id;

        $cust = new SquareCustomer($firstName, $lastName);

        $cust->setProcessorId($processorId);

        return $cust;
    }

}




