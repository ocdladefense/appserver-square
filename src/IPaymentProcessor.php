<?php

interface IPaymentProcessor {
    public function sendPayment();

    public function getCustomer();

    public function saveCustomer();

    public function getPaymentMethod();

    public function savePaymentMethod();

    public function getTransaction();

}