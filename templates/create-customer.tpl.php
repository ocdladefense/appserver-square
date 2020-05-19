<!doctype HTML>
<html>
	<head>
		<meta charset="utf-8" />
    <title>Create Customer Form</title>
    
    <!-- link to the SqPaymentForm library -->
    <script type="text/javascript" src="https://js.squareupsandbox.com/v2/paymentform"></script>

    <!-- link to the local custom styles for SqPaymentForm -->
    <link rel="stylesheet" type="text/css" href="mysqpaymentform.css">
    
  </head>
  <body>  
    <form action="create-customer" method="post">
      <h2>Register an Account</h2>
      <label for="fname">First name:</label><br />
      <input type="text" id="fname" name="fname" value="<!--<?php $_SESSION["customer"]->getFirstName() ?> --->" /><br />

      <label for="lname">Last name:</label><br />
      <input type="text" id="lname" name="lname" /><br /><br />
      
      <input type="submit" value="Submit" />

    </form>

    <?php var_dump($_POST); ?>

  </body
</html>

