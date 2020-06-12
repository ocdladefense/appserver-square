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
    <form name="customer-form" class="form form-not-validated" action="create-customer" method="post">

    <?php  
      if(isset($_SESSION["customer"])): 
      echo "<script type='text/javascript'> let needCreate = false</script>";
      echo "<h2>Update Your Account</h2>";
    elseif (!isset($_SESSION["customer"])):
      echo "<script type='text/javascript'> let needCreate = true</script>";
      echo "<h2>Register Account</h2>";
    else:
      echo "<h2>Please Fill Out Account Information</h2>";
    endif;
    ?>


      <div id="fname" class="form-item">
        <label for="fname">First name:</label><br />
        <input type="text" name="fname" value="<?php if(isset($_SESSION["_customer"])) :
                                                            echo $_SESSION["_customer"]["firstName"]; endif; ?>"/><br />
        <span class="error-message">This field is required</span>
      </div>

      <div id="lname" class="form-item">
        <label for="lname">Last name:</label><br />
        <input type="text" name="lname" /><br />
        <span class="error-message">This field is required</span>
      </div>
      
      <div id="address" class="form-item">
        <label for="address">Address:</label><br />
        <input type="text" name="address" value="" /><br />
      </div>

      <div id="birthday" class="form-item">
        <label for="birthday">Birthday:</label><br />
        <input type="date" name="birthday" value="" /><br />
      </div>

      <div id="email" class="form-item">
        <label for="email">Email:</label><br />
        <input type="email" name="email" value="" pattern=".+" placeholder="Jdoe@example.com"/><br />
      </div>

      <input type="submit" value="Submit" />

    </form>
    <script type="text/javascript"> addCreateValidation(needCreate) </script>

    <?php var_dump($_SESSION); ?>

  </body
</html>

