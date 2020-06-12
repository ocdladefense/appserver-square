<?php

//Customer represents an abstract customer type 
abstract class Customer implements \JsonSerializable {

    protected $address;
    protected $birthday;
    protected $email;
    //ID for customer's user in php appserver
    protected $userId;
    //ID for customer's contact record in CRM
    protected $CRMId;
    //ID for remote processor system
    protected $processorId;
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

    public function getProcessorId(){
        return $this->processorId;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getName() {
        return $firstName . $lastName;
    }

    public function getFirstName(){
        return $firstName;
    }

    public function getLastName(){
        return $lastName;
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