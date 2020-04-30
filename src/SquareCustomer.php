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

}




