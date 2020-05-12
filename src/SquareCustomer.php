<?php

class SquareCustomer extends Customer{

    public function __construct($firstName, $lastName){
        parent::__construct($firstName, $lastName);
    }

    public function jsonSerialize()
    {
        return array(
            "given_name" => $this->firstName,
            "family_name" => $this->lastName
        );
    }
    public static function fromJson($obj){
        $firstName = $obj->given_name;
        $lastName = $obj->family_name;
        $processorId = $obj->id;

        $cust = new SquareCustomer($firstName, $lastName);

        $cust->setProcessorId($processorId);

        return $cust;
    }

}




