<?php

//Customer represents an abstract customer type 
abstract class Customer implements \JsonSerializable {

    private $address;
    private $birthday;
    private $email;
    //userID is the reference ID square will use to find the customer, not the SquareID
    //ID for customer's user in php appserver
    private $userId;
    //ID for customer's contact record in CRM
    private $CRMId;
    //ID for remote processor system
    private $processorId;
    protected $firstName;
    protected $lastName;

    //New unique ID created when a customer is made
    public function __construct($firstName, $lastName) {
        $this->userId = uniqid();
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function setAddress($address){
        $this->address = $address;
    }

    public function setProcessorId($processorId){
        $this->processorId = $processorId;
    }

    public function getName() {
        return $firstName . $lastName;
    }

    public function getEmail() {
        return $email;
    }
    
    public function getBirthday(){
        return $birthday;
    }

    public function getUserId(){
        return $userId;
    }
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}