<!DOCTYPE html>
<html>
<head>
	<title>AirGiftIt</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<style type="text/css">
	.container{
		padding-top: 100px;
	}
	</style>
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

	<div class="container">
			<div class="row">
				<div class="col-md-offset-5 col-md-2">
					<a href="#" id="LoginWithAmazon">
					  	<img border="0" alt="Login with Amazon"
					    src="https://images-na.ssl-images-amazon.com/images/G/01/lwa/btnLWA_gold_156x32.png"
					    width="156" height="32" />
					</a>
					<script type="text/javascript">

					  document.getElementById('LoginWithAmazon').onclick = function() {
					    options = { scope : 'profile', popup : true };
					    amazon.Login.authorize(options, 'https://airgiftit.techcliks.com/login');
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
				</div>
			</div>
			<div class="row">
				<div class="col-md-offset-4 col-md-4">
					<ul>
	  					<li>Login with your Amazon or Endless.com credentials</li>
		  			</ul>
		  			<ul>
		  				<li>Login with your Amazon or Endless.com credentials</li>
		  			</ul>
		  			<ul>
		  				<li>Login with your Amazon or Endless.com credentials</li>
		  			</ul>
				</div>
	  		</div>
	</div>


	  



<!-- 	<a id="Logout" href="#">Logout</a> -->
	<script type="text/javascript">
	//   document.getElementById('Logout').onclick = function() {
	//     amazon.Login.logout();
	// };
	</script>
</body>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</html>