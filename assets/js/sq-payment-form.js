/**
 * Define callback function for "sq-button"
 * @param {*} event
 */
function onGetCardNonce(this,event) {

    // Don't submit the form until SqPaymentForm returns with a nonce
    event.preventDefault();
    document.getElementById(this.id).disabled = true;
  
    // Request a nonce from the SqPaymentForm object
    paymentForm.requestCardNonce();
  }
  
  // Initializes the SqPaymentForm object by
  // initializing various configuration fields and providing implementation for callback functions.
  var paymentForm = new SqPaymentForm({
    // Initialize the payment form elements
    applicationId: "sandbox-sq0idb-MMFyCsOxdv0jl5Pcj0RO-g",
    locationID = "locationID",
    inputClass: 'sq-input',
    autoBuild: false,
  
    // Customize the CSS for SqPaymentForm iframe elements
    inputStyles: [{
      backgroundColor: 'transparent',
      color: '#333333',
      fontFamily: '"Helvetica Neue", "Helvetica", sans-serif',
      fontSize: '16px',
      fontWeight: '400',
      placeholderColor: '#8594A7',
      placeholderFontWeight: '400',
      padding: '16px',
      _webkitFontSmoothing: 'antialiased',
      _mozOsxFontSmoothing: 'grayscale'
    }],
  
    // Initialize Google Pay button ID
    googlePay: {
      elementId: 'sq-google-pay'
    },
  
    // Initialize Apple Pay placeholder ID
    applePay: {
      elementId: 'sq-apple-pay'
    },
  
    // Initialize Masterpass placeholder ID
    masterpass: {
      elementId: 'sq-masterpass'
    },
  
    // Initialize the credit card placeholders
    cardNumber: {
      elementId: 'sq-card-number',
      placeholder: '•••• •••• •••• ••••'
    },
    cvv: {
      elementId: 'sq-cvv',
      placeholder: 'CVV'
    },
    expirationDate: {
      elementId: 'sq-expiration-date',
      placeholder: 'MM/YY'
    },
    postalCode: {
      elementId: 'sq-postal-code'
    },
  
    // SqPaymentForm callback functions
    callbacks: {
  
      /*
       * callback function: methodsSupported
       * Triggered when: the page is loaded.
       */
      methodsSupported: function (methods) {
        if (!methods.masterpass && !methods.applePay && !methods.googlePay) {
          var walletBox = document.getElementById('sq-walletbox');
          walletBox.style.display = 'none';
        } else {
          var walletBox = document.getElementById('sq-walletbox');
          walletBox.style.display = 'block';
        }
  
        // Only show the button if Google Pay is enabled
        if (methods.googlePay === true) {
          var googlePayBtn = document.getElementById('sq-google-pay');
          googlePayBtn.style.display = 'inline-block';
        }
  
        // Only show the button if Apple Pay for Web is enabled
        if (methods.applePay === true) {
          var applePayBtn = document.getElementById('sq-apple-pay');
          applePayBtn.style.display = 'inline-block';
        }
  
        // Only show the button if Masterpass is enabled
        if (methods.masterpass === true) {
          var masterpassBtn = document.getElementById('sq-masterpass');
          masterpassBtn.style.display = 'inline-block';
        }
      },
  
      /*
       * callback function: createPaymentRequest
       * Triggered when: a digital wallet payment button is clicked.
       */
      createPaymentRequest: function () {
  
        cardNonceResponseReceived: function (errors, nonce, cardData) {
          if (errors) {
              // Log errors from nonce generation to the browser developer console.
              console.error('Encountered errors:');
              errors.forEach(function (error) {
                  console.error('  ' + error.message);
              });
              alert('Encountered errors, check browser developer console for more details');
               return;
          }
             alert(`The generated nonce is:\n${nonce}`);
          }
    }
  });