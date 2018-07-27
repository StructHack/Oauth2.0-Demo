<!DOCTYPE html>
<html>
<head>
	<title>Authorization Server</title>
</head>
<body>

<?php
	###########For all grant type###################################################
	#
	$scope = "username,email,friends_list";
	$state = "CSRF_XXXXXX";	
	$client_id = "ID_XXXXXX";
	$redirect_uri = urlencode("http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
	$client_password = "STHA_XXXXXX";
	$response_type;
	#
	################################################################################
	############Type Check##########################################################
	#
	$ac = false;
	$im = false;
	$ro = false;
	$cc = false;
	#
	#################################################################################
	if(isset($_POST['grant_type'])){

		$grant_type = trim($_POST['grant_type']);
		switch ($grant_type) {
			case 'authorization code':
				$ac = true;
				break;
			case 'implicit';
				$im = true;
				break;
			case 'resource owner password credentials';
				$ro = true;
				break;
			case 'client credentials';
				$cc = true;
				break;
			default:
			    die('Woot? o.O');
				break;
		}
###############Authorization Grant Type#####################################################
		if($ac){
			$response_type = "code";
			header("Location: authserver.php?response_type=${response_type}&client_id=${client_id}&client_secret=${client_password}&redirect_uri=${redirect_uri}&scope=${scope}&state=${state}");	
		}
	}

	if(isset($_GET['code']) && isset($_GET['state'])){
		if($state === $_GET['state']){
			$code = $_GET['code'];
			$grant_type = "authorization_code";
			$request = ["code"=>htmlentities($_GET['code']), "state"=>htmlentities($_GET['state'])];
			echo "<h3>Parameters and values(<span style='color:green'>Authorization Response)</span></h3><pre>".json_encode($request, JSON_PRETTY_PRINT)."</pre>";
			echo "<p style='color:green'><b>After authorization, <i>authorization code</i> is sent back to client which can be later used to retrieve access token. Click on continue to retrieve <i>access token</i> from authorization server.</b></p>
				<form action='' method='POST'>
					<input type='hidden' name='auth'>
					<input type='submit' value='Continue'>
				</form>
			";
			if(isset($_POST['auth'])){
				header("Location: authserver.php?grant_type=${grant_type}&code=${code}&redirect_uri=${redirect_uri}&client_id=${client_id}&client_secret=${client_password}");
			}
		}
	}

	if(isset($_GET['access_token']) && isset($_GET['token_type']) && isset($_GET['expires_in']) && isset($_GET['refresh_token']) && isset($_GET['example_parameter'])){
		$request = 	[	"access_token"=>htmlentities($_GET['access_token']),
						"token_type"=>htmlentities($_GET['token_type']),
						"expires_in"=>htmlentities($_GET['expires_in']),
						"refresh_token"=>htmlentities($_GET['refresh_token']),
						"example_parameter"=>htmlentities($_GET['example_parameter'])
					];
		echo "<h3>Parameters and values(<span style='color:green'>Access Token Response</span>)</h3><pre>".json_encode($request, JSON_PRETTY_PRINT)."</pre>";
		echo "
				<form action='' method='POST'>
					<input type='hidden' name='auth'>
					<input type='submit' value='Make a request to resource server with the access token'>
				</form>
			";
			if(isset($_POST['auth'])){
				header("Location: resource.php?access_token=".$_GET['access_token']);
			}
	}	
	
################################################################################################
######################Implicit Grant Type#######################################################

if($im){
	$response_type = "token";
	header("Location: authserver.php?response_type=${response_type}&client_id=${client_id}&client_secret=${client_password}&redirect_uri=${redirect_uri}&scope=${scope}&state=${state}");
}

if(isset($_GET['implicit'])){
	
	echo "

		<script>
			var hash_arr = location.hash.substr(1).split('&');
			var access_token = hash_arr[0].split('=')[1];
			var token_type = hash_arr[1].split('=')[1];
			var expires_in = hash_arr[2].split('=')[1];
			var scope = hash_arr[3].split('=')[1];
			var state = hash_arr[4].split('=')[1];

			function request(){
				var xhttp = new XMLHttpRequest();
				xhttp.open('GET','resource.php?access_token='+access_token,true);
				xhttp.onreadystatechange = function () {
				  if(xhttp.readyState === 4 && xhttp.status === 200) {
				    document.querySelector('#demo').innerHTML = xhttp.responseText;
				  }
				};
				xhttp.send();
			}
			request();
		</script>";

	
}	

?>
<p id='demo'></p>
</body>
</html>