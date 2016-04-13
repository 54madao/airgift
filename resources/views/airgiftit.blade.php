<!DOCTYPE html>
<html>
<head>
	<title>AirGiftIt</title>
</head>
<body>
	<div id="amazon-root"></div>
	<script type="text/javascript">

	  window.onAmazonLoginReady = function() {
	    amazon.Login.setClientId('amzn1.application-oa2-client.2950611bb1f048b9861c7c230dd2b142');
	  };
	  (function(d) {
	    var a = d.createElement('script'); a.type = 'text/javascript';
	    a.async = true; a.id = 'amazon-login-sdk';
	    a.src = 'https://api-cdn.amazon.com/sdk/login1.js';
	    d.getElementById('amazon-root').appendChild(a);
	  })(document);

	</script>
	<a href="#" id="LoginWithAmazon">
	  <img border="0" alt="Login with Amazon"
	    src="https://images-na.ssl-images-amazon.com/images/G/01/lwa/btnLWA_gold_156x32.png"
	    width="156" height="32" />
	</a>
	<script type="text/javascript">

	  document.getElementById('LoginWithAmazon').onclick = function() {
	    options = { scope : 'profile' };
	    amazon.Login.authorize(options, 'https://airgiftit.techcliks.com/handle_login.php');
	    return false;
	  };

	  // document.getElementById('LoginWithAmazon').onclick = function() {
   //          setTimeout(window.doLogin, 1);
   //          return false;
   //          //amazon.Login.authorize(options, 'https://airgiftit.techcliks.com/handle_login.php');
   //    };
   //    window.doLogin = function() {
   //        options = {};
   //        options.scope = 'profile';
   //        amazon.Login.authorize(options, function(response) {
   //          if ( response.error ) {
   //              alert('oauth error ' + response.error);
   //              return;
   //          }
   //          amazon.Login.retrieveProfile(response.access_token, function(response) {
   //            alert(response);
   //          });
   //       });
   //    };

	</script>
	<a id="Logout">Logout</a>
	<script type="text/javascript">
	  document.getElementById('Logout').onclick = function() {
	    amazon.Login.logout();
	};
	</script>
</body>
</html>