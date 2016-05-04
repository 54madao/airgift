<head>
  <script type='text/javascript'>
    window.onAmazonLoginReady = function() {
      amazon.Login.setClientId('amzn1.application-oa2-client.2950611bb1f048b9861c7c230dd2b142');
    };
  </script>

  <script type='text/javascript' 
    src='https://static-na.payments-amazon.com/OffAmazonPayments/us/sandbox/js/Widgets.js'>
  </script>
</head>
<body>
<div id="AmazonPayButton">
</div>
 
<script type="text/javascript">
  var authRequest; 
  OffAmazonPayments.Button("AmazonPayButton", "AKIAI7WJBK4DCIEJSQHA", { 
    type:  "PwA", 
    color: "LightGray", 
    size:  "medium", 

    authorization: function() { 
      loginOptions = {scope: "profile payments:widget payments:shipping_address", popup: true}; 
      authRequest = amazon.Login.authorize (loginOptions, "https://airgiftit.techcliks.com/login"); 
    }, 

    onError: function(error) { 
      // your error handling code.
      // alert("The following error occurred: " 
      //        + error.getErrorCode() 
      //        + ' - ' + error.getErrorMessage());
    } 
  }); 
   </script>
</body>