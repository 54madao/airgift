<!DOCTYPE html>
<html>
<head>
	<title>AirGiftIt</title>
</head>
<body>
	<div id="amazon-root"></div>
	<script type="text/javascript">

	  window.onAmazonLoginReady = function() {
	    amazon.Login.setClientId('amzn1.application.4db3b6c0559b401ba16cd3e9aa9e2ffc');
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

	</script>
	<a id="Logout">Logout</a>
	<script type="text/javascript">
	  document.getElementById('Logout').onclick = function() {
	    amazon.Login.logout();
	};
	</script>
</body>
</html>