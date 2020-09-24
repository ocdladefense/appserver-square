<?php

$oauth_config = array(
    "oauth_url" => SALESFORCE_LOGIN_URL,
    "client_id" => SALESFORCE_CLIENT_ID,
    "client_secret" => SALESFORCE_CLIENT_SECRET,
    "username" => SALESFORCE_USERNAME,
    "password" => SALESFORCE_PASSWORD,
    "security_token" => SALESFORCE_SECURITY_TOKEN,
    "redirect_uri" => SALESFORCE_REDIRECT_URI
    );
$instance_url = "https://business-innovation-5996-dev-ed.cs69.my.salesforce.com";
$access_token = "foobar";
    
        $salesforce = new Salesforce($oauth_config);
        //add more constants in config.php in class constructor
        //$salesforce->authorizeToSalesforce();
        //var_dump($salesforce->CreateQuery("select Id from Contact",$instance_url,$access_token));
        var_dump($salesforce->createQueryFromSession("select Id from Contact"));


    
