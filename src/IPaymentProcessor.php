<?php

//IPaymentProcessor represents abstract interactions between module and payment processor
interface IPaymentProcessor {
    public function sendPayment();

    public function getCustomer();

    public function saveCustomer();

    public function getPaymentMethod();

    public function savePaymentMethod();

    public function getTransaction();

}



