<<!DOCTYPE html>
<html>
<head>
	<title>AirGiftIt</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<style>
		.main {
			padding: 51px;
		}
	</style>
</head>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular.min.js"></script>
<body ng-app="Main">
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
	          <li><a href="/signin">Signin</a></li>
	        </ul>
	      </div><!-- /.nav-collapse -->
	    </div><!-- /.container -->
	  </nav>
	<div class="container main" ng-controller="Sender">
		<div class="col-md-offset-8 col-md-4">
			<form>
				<div class="form-group">
			    	<textarea class="form-control" rows="5" placeholder="Amazon Product Link" ng-model="url" ng-change="parseUrl()"></textarea>
					<p ng-bind="asin"></p>
			  	</div>
				<div class="form-group">
				    <label for="exampleInputEmail1">Email address</label>
				    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
				</div>
				<button type="submit" class="btn btn-default">Send</button>
			</form>
		</div>
	</div>
</body>

<script type="text/javascript">
	var app = angular.module('Main', []);
	app.controller('Sender', function($scope){
		$scope.parseUrl = function() {
        	var url = $scope.url;
			console.log(url);
			var regex = RegExp("http://www.amazon.com/([\\w-]+/)?(dp|gp/product)/(\\w+/)?(\\w{10})");
			if(url != undefined){
				m = url.match(regex);
				if (m) { 
		    		$scope.asin = "ASIN=" + m[4];
				}
			}
      	};
	});
</script>
</html>