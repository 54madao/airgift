<<!DOCTYPE html>
<html>
<head>
	<title>AirGiftIt</title>
	<meta name="viewport" content="width-device-width,initial-scale=1.0, maximum-scale=1.0"/>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<style>
		.main {
			padding: 51px;
		}
		#addressBookWidgetDiv{width: 400px; height: 228px;}
  		#walletWidgetDiv {width: 400px; height: 228px;}
	</style>

	<!-- setup environment -->
	<script type="text/javascript">
	  window.onAmazonLoginReady = function() {
	    amazon.Login.setClientId('amzn1.application-oa2-client.2950611bb1f048b9861c7c230dd2b142');
	    amazon.Login.setSandboxMode(true);
	    amazon.Login.setUseCookie(false);
	  };
	</script>
	<!--<script type='text/javascript' 
    	src='https://static-na.payments-amazon.com/OffAmazonPayments/us/js/Widgets.js'>
  	</script>-->
  	<script type="text/javascript" src='https://static-na.payments-amazon.com/OffAmazonPayments/us/sandbox/js/Widgets.js'></script>

</head>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular.min.js"></script>
<script src="https://cdn.jsdelivr.net/ngstorage/0.3.6/ngStorage.min.js"></script>
<body ng-app="Main">
	<!-- get user info -->
	<?php
		// function authorization(){
		// 	// $c = curl_init('https://api.amazon.com/auth/o2/tokeninfo?access_token=' . urlencode($_REQUEST['access_token']));
		// 	$c = curl_init('https://api.sandbox.amazon.com/auth/o2/tokeninfo?access_token=' . urlencode($_REQUEST['access_token'])); 
	 //        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
	         
	 //        $r = curl_exec($c);
	 //        curl_close($c);
	 //        $d = json_decode($r);
	         
	 //        if ($d->aud != 'amzn1.application-oa2-client.2950611bb1f048b9861c7c230dd2b142') {
	 //          // the access token does not belong to us
	 //          header('HTTP/1.1 404 Not Found');
	 //          echo 'Page not found';
	 //          exit;
	 //        }

	 //        // exchange the access token for user profile
	 //        // $c = curl_init('https://api.amazon.com/user/profile');
	 //        $c = curl_init('https://api.sandbox.amazon.com/user/profile');
	 //        curl_setopt($c, CURLOPT_HTTPHEADER, array('Authorization: bearer ' . $_REQUEST['access_token']));
	 //        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
	         
	 //        $r = curl_exec($c);
	 //        curl_close($c);
	 //        $d = json_decode($r);

	 //        // echo sprintf('%s %s %s', $d->name, $d->email, $d->user_id);

	 //        return $d;
		// }

		// $isSignedIn = false;
		// if(isset($_REQUEST['access_token'])){
		// 	$userInfo = authorization();
		// 	if(isset($userInfo)){
		// 		$isSignedIn = true;
		// 	}
		// }
	?>
		
	<div ng-controller="Sender">
	<nav class="navbar navbar-fixed-top navbar-inverse">
	    <div class="container">
	      <div class="navbar-header">
	        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	          <span class="sr-only">Toggle navigation</span>
	          <span class="icon-bar"></span>
	          <span class="icon-bar"></span>
	          <span class="icon-bar"></span>
	        </button>
	        <a class="navbar-brand" href="#">AirGiftIt</a>
	      </div>
	      <div id="navbar" class="collapse navbar-collapse">
	        <ul class="nav navbar-nav">
	          <li><a href="#">Home</a></li>
	          <li><a href="#about">About</a></li>
	          <li><a href="#contact">Contact</a></li>
	        </ul>
	        <ul class="nav navbar-nav navbar-right">
	          <li ng-if="data.isSignedIn"><a>Hi, {{data.userInfo.Name}}</a></li>
	          <li ng-if="data.isSignedIn"><a id="Logout" href="/" ng-click="logout()">Logout</a></li>
	          <li ng-if="!data.isSignedIn"><a href="#" id="LoginWithAmazon" ng-click="login()">Signin</a></li>
	        </ul>
	      </div><!-- /.nav-collapse -->
	    </div><!-- /.container -->
	  </nav>
	<div class="container main">
		<div class="row">
			<div class="col-md-7">
				<div ng-show="data.itemInfo !== {}">
					<a target="_blank" ng-href="{{data.itemInfo.detailPageUrl}}">
						<img src="{{data.itemInfo.primaryImage}}">
					</a>
					<h4>{{data.itemInfo.title}}<small> by {{data.itemInfo.brand}}</small></h4>
					<p>Price <strong>{{data.itemInfo.price}}</strong> & {{data.itemInfo.amount}} left</p>
					<ul ng-if="data.itemInfo.features">
						<li ng-repeat="feature in data.itemInfo.features">{{feature}}</li>
					</ul>
				</div>
			</div>
			<div class="col-md-offset-1 col-md-4">
				<form>
					<div ng-if="!$storage.isSelected">
						<div class="form-group">
					    	<textarea class="form-control" rows="5" placeholder="Amazon Product Link" ng-init="data.url = $storage.url" ng-model="data.url" ng-change="parseUrl()"></textarea>
							<input type="hidden" id="asin" name="asin" ng-init="data.asin = $storage.asin" ng-model="data.asin"/>
					  	</div>
					  	<div class="form-group">
					  		<div id="AmazonPayButton" ng-click="readyToPay()">
							</div>
							 
							<script type="text/javascript">
							  var authRequest; 
							  OffAmazonPayments.Button("AmazonPayButton", "A3U4WD211IW75F", { 
							    type:  "PwA", 
							    color: "LightGray", 
							    size:  "small", 

							    onError: function(error) { 
							      // your error handling code.
							      // alert("The following error occurred: " 
							      //        + error.getErrorCode() 
							      //        + ' - ' + error.getErrorMessage());
							    } 
							  }); 
							</script>
					  	</div>
					</div>
					<div ng-if="$storage.isSelected">
						<div class="form-group">
						    <label ng-bind="data.asin"></label>
						</div>
						<div class="form-group">
							<div id="addressBookWidgetDiv">
							</div> 
						</div>
						<div class="form-group">
							<div id="walletWidgetDiv">
							</div>
						</div>
						<div class="form-group">
						    <label for="exampleInputEmail1">Email address</label>
						    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-default" ng-click="confirm()">Air Gift It</button>
							<button class="btn btn-default" ng-click="cancel()">Cancel</button>		
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	</div>
</body> 

<script type="text/javascript">
	var app = angular.module('Main', ['ngStorage']);
	app.controller('Sender', function($scope, $http, $localStorage){
		$scope.data = {};
		$scope.data.userInfo = {};
		$scope.data.itemInfo = {};
		$scope.data.isSignedIn = false;
		$scope.$storage = $localStorage.$default({
		    isSelected: false,
		    asin: '',
		    url: ''
		});
		
		$scope.parseUrl = function() {
			var url = $scope.data.url;
			$scope.$storage.url = url;
			var regex = RegExp("http://www.amazon.com/([\\w-]+/)?(dp|gp/product)/(\\w+/)?(\\w{10})");
			$scope.$storage.asin = '';
			if(url != undefined){
				m = url.match(regex);
				if (m) { 
		    		$scope.$storage.asin = m[4];
		    		$http({
 						method: 'Get',
  						url: '/itemlookup' + '?ItemId=' + m[4]
					}).then(function successCallback(response) {
    					// this callback will be called asynchronously
    					// when the response is available
    					var result = angular.toJson(response.data);
    					// console.log(result);

    					$scope.data.itemInfo.detailPageUrl = response.data.Items.Item.DetailPageURL;
    					$scope.data.itemInfo.title = response.data.Items.Item.ItemAttributes.Title;
    					$scope.data.itemInfo.brand = response.data.Items.Item.ItemAttributes.Brand;

    					var len = response.data.Items.Item.ImageSets.ImageSet.length;
    					$scope.data.itemInfo.primaryImage = response.data.Items.Item.ImageSets.ImageSet[len - 1].LargeImage.URL;
    					$scope.data.itemInfo.amount = response.data.Items.Item.OfferSummary.LowestNewPrice.Amount;
    					$scope.data.itemInfo.price = response.data.Items.Item.OfferSummary.LowestNewPrice.FormattedPrice;

    					$scope.data.itemInfo.features = response.data.Items.Item.ItemAttributes.Feature;

  					}, function errorCallback(response) {
    					// called asynchronously if an error occurs
    					// or server returns response with an error status.
    					console.log("error");
    					console.log(response);
    					//alert(response.data);
  					});
		    		return true;
				}
				return false;
			}
			return false;
      	};
      	$scope.login = function() {
      		var loginOptions = {scope: "profile payments:widget payments:shipping_address", popup: true}; 
			var authRequest = amazon.Login.authorize (loginOptions, function(response) {
	            // this code is executed ASYNCHRONOUSLY

	            if ( response.error ) {
	                // USER NOT LOGGED IN
	                console.log("SESSION NOT ACTIVE - " + new Date());
	                $scope.data.isSignedIn = false;
	                $scope.$apply();
	            } else {
	                // USER IS LOGGED IN
	                console.log("SESSION ACTIVE - " + new Date());

	                // optionally, get the profile info
	                console.dir('access_token= ' + response.access_token);

	                amazon.Login.retrieveProfile(function (response) {
	                    // Display profile information.
	                    console.dir('CustomerId= ' + response.profile.CustomerId);
	                    console.dir('Name= ' + response.profile.Name);
	                    console.dir('PostalCode= ' + response.profile.PostalCode);
	                    console.dir('PrimaryEmail= ' + response.profile.PrimaryEmail);
	                    $scope.data.userInfo = response.profile;
	                    $scope.data.isSignedIn = true;
	                    $scope.$apply();
	                });
	            }
	        });
			console.log(authRequest);
      	}
      	$scope.verifyLoggedIn = function(){
      		var loginOptions = {scope: "profile payments:widget payments:shipping_address", 
      							popup: true, 
      							interactive: 'never'
      							};
      		var authRequest = amazon.Login.authorize (loginOptions, function(response) {
	            // this code is executed ASYNCHRONOUSLY

	            if ( response.error ) {
	                // USER NOT LOGGED IN
	                console.log("SESSION NOT ACTIVE - " + new Date());
	                $scope.data.isSignedIn = false;
	                $scope.$apply();
	            } else {
	                // USER IS LOGGED IN
	                console.log("SESSION ACTIVE - " + new Date());

	                // optionally, get the profile info
	                console.dir('access_token= ' + response.access_token);

	                amazon.Login.retrieveProfile(function (response) {
	                    // Display profile information.
	                    console.dir('CustomerId= ' + response.profile.CustomerId);
	                    console.dir('Name= ' + response.profile.Name);
	                    console.dir('PostalCode= ' + response.profile.PostalCode);
	                    console.dir('PrimaryEmail= ' + response.profile.PrimaryEmail);

	                    $scope.data.userInfo = response.profile;
	                    $scope.data.isSignedIn = true;
	                    $scope.$apply();
	                });         
	            }      
	        });
      	}
      	$scope.verifyLoggedIn();
      	$scope.readyToPay = function(){
      		if(!$scope.data.isSignedIn){
      			$scope.login();
      		}
      		if($scope.parseUrl()){
      			$scope.$storage.isSelected = true;
      			 new OffAmazonPayments.Widgets.AddressBook({
				    sellerId: 'A3U4WD211IW75F',
				    onOrderReferenceCreate: function(orderReference) {
				      // Here is where you can grab the Order Reference ID.
				      $http({
 						method: 'POST',
  						url: '/getDetails',
  						data: {
  							orderReferenceId: orderReference.getAmazonOrderReferenceId(),
  							amount: $scope.data.itemInfo.price.substring(1, $scope.data.itemInfo.price.length)
  						}
						}).then(function successCallback(response) {
	    					// this callback will be called asynchronously
	    					// when the response is available
	    					console.log(response);

	  					}, function errorCallback(response) {
	    					// called asynchronously if an error occurs
	    					// or server returns response with an error status.
	    					console.log("error");
	    					console.log(response);
	    					//alert(response.data);
	  					});
				    },
				    onAddressSelect: function(orderReference) {
				      // Replace the following code with the action that you want
				      // to perform after the address is selected. The 
				      // amazonOrderReferenceId can be used to retrieve the address 
				      // details by calling the GetOrderReferenceDetails operation. 

				      // If rendering the AddressBook and Wallet widgets
				      // on the same page, you do not have to provide any additional
				      // logic to load the Wallet widget after the AddressBook widget.

				      // The Wallet widget will re-render itself on all subsequent 
				      // onAddressSelect events, without any action from you. 
				      // It is not recommended that you explicitly refresh it.
				    },
				    design: {
				      designMode: 'responsive'
				    },
				    onReady: function(orderReference) {
				      // Enter code here you want to be executed 
				      // when the address widget has been rendered. 
				    },

				    onError: function(error) {
				      // Your error handling code.
				      // During development you can use the following
				      // code to view error messages:
				      // console.log(error.getErrorCode() + ': ' + error.getErrorMessage());
				      // See "Handling Errors" for more information.
				    }
				  }).bind("addressBookWidgetDiv");
				
				new OffAmazonPayments.Widgets.Wallet({
				    sellerId: 'A3U4WD211IW75F',
				    onPaymentSelect: function(orderReference) {
				      // Replace this code with the action that you want to perform
				      // after the payment method is selected.

				      // Ideally this would enable the next action for the buyer
				      // including either a "Continue" or "Place Order" button.
				    },
				    design: {
				      designMode: 'responsive'
				    },
				    
				    onError: function(error) {
				      // Your error handling code.
				      // During development you can use the following
				      // code to view error messages:
				      // console.log(error.getErrorCode() + ': ' + error.getErrorMessage());
				      // See "Handling Errors" for more information.
				    }
				  }).bind("walletWidgetDiv");

      		}
      	}
      	$scope.confirm = function(){
      		$http({
				method: 'get',
				url: '/authorizeAndCapture',
			}).then(function successCallback(response) {
				// this callback will be called asynchronously
				// when the response is available
				console.log(response);

				}, function errorCallback(response) {
				// called asynchronously if an error occurs
				// or server returns response with an error status.
				console.log("error");
				console.log(response);
				//alert(response.data);
			});
      	}
      	$scope.cancel = function(){
      		$localStorage.$reset({
    			isSelected: false,
		    	asin: '',
		    	url: ''
			});
      	}
      	$scope.logout = function() {
      		amazon.Login.logout();
      		$localStorage.$reset({
    			isSelected: false,
		    	asin: '',
		    	url: ''
			});
      	}
	});
</script>
</html>