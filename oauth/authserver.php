<?php

############Client Credentials and stuff#######################
#
$client_id = "ID_XXXXXX";
$redirect_uri = "http://localhost/client.php";
$client_password = "STHA_XXXXXX";
$auth_code = "AUTH_CODE_XXXXXX";
$access_token = "ACK_XXXXXX";
$refresh_token = base64_encode("Dipendra Shrestha");
#
###############################################################
############Authorization Code grant###########################
if((isset($_GET['response_type']) && $_GET['response_type']==='code') && isset($_GET['client_id']) && isset($_GET['client_secret']) && isset($_GET['redirect_uri']) && isset($_GET['scope']) && isset($_GET['state'])){
	
	if($redirect_uri === $_GET['redirect_uri']){
		if($client_id === $_GET['client_id']){
			if($client_password === $_GET['client_secret']){
				$request=[	"response_type"=>htmlentities($_GET['response_type']),
				 			"client_id"=>htmlentities($_GET['client_secret']),
				 			"client_secret"=>htmlentities($_GET['client_secret']),
				 			"redirect_uri"=>htmlentities($_GET['redirect_uri']),
				 			"scope"=>htmlentities($_GET['scope']),
				 			"state"=>htmlentities($_GET['state'])];	
				echo "<h3>Parameters and values (<span style='color:green'>Authorization Request</span>)</h3><pre>".json_encode($request, JSON_PRETTY_PRINT)."</pre>";
				echo "<b>Click Authorize button to give client the authorization code. By clicking authorize you agree to share your <p>1. <i>username</i><br>2. <i>email</i><br>3. <i>friend_list</i></p>with the client web application.</b>";
				echo "	<br><br>
						<form action='' method='POST'>
							<input type='hidden' name='auth'>
							<input type='submit' value='Authorize'>
						</form>";
				
				if(isset($_POST['auth'])){
					header("Location: ".$redirect_uri."?code=${auth_code}&state=".$_GET['state']);
				}

			}else{
				echo "Client Password is not correct";
			}
		}else{
			echo "Client Id not found";
		}
	}else{
		echo "Incorrect Redirect URI";
	}
		


}
#################ACCESS TOKEN REQUEST#############################
if(isset($_GET['grant_type']) && isset($_GET['code']) && isset($_GET['redirect_uri']) && isset($_GET['client_id']) && isset($_GET['client_secret'])){
	if($_GET['grant_type'] === 'authorization_code'){
		if(trim($_GET['code']) === $auth_code){
			if($_GET['redirect_uri'] === $redirect_uri){
				if($_GET['client_id'] === $client_id){
					if($_GET['client_secret'] === $client_password){
						$request = 	[	"grant_type"=>htmlentities($_GET['grant_type']),
										"code"=>htmlentities($_GET['code']),
										"redirect_uri"=>htmlentities($_GET['redirect_uri']),
										"client_id"=>htmlentities($_GET['client_id']),
										"client_secret"=>htmlentities($_GET['client_secret'])
									];
						echo "<h3>Parameters and values(<span style='color:green'>Access Token Request</span>)</h3><pre>".json_encode($request, JSON_PRETTY_PRINT)."</pre>";
						echo "	<br>
						<p style='color:red'><b>Click on continue to retrieve an access_token</b></p>
						<form action='' method='POST'>
							<input type='hidden' name='auth'>
							<input type='submit' value='Continue'>
						</form>";
				
						if(isset($_POST['auth'])){
							header("Location: ".$redirect_uri."?access_token=${access_token}&token_type=example&expires_in=120000&refresh_token=${refresh_token}&example_parameter=example_value");
						}
					}else{
						die("Client Password is not correct");
					}
				}else{
					die("Client Id not found");
				}
			}else{
				die("Incorrect Redirect URI");
			}
		}else{
			die("Wrong auth code");
		}
	}else{
		die("huh?");
	}
}
###################################################################

if((isset($_GET['response_type']) && $_GET['response_type']==='token') && isset($_GET['client_id']) && isset($_GET['client_secret']) && isset($_GET['redirect_uri']) && isset($_GET['scope']) && isset($_GET['state'])){

	if($redirect_uri === $_GET['redirect_uri']){
		if($client_id === $_GET['client_id']){
				$request=[	"response_type"=>htmlentities($_GET['response_type']),
				 			"client_id"=>htmlentities($_GET['client_secret']),
				 			"client_secret"=>htmlentities($_GET['client_secret']),
				 			"redirect_uri"=>htmlentities($_GET['redirect_uri']),
				 			"scope"=>htmlentities($_GET['scope']),
				 			"state"=>htmlentities($_GET['state'])];	
				echo "<h3>Parameters and values (<span style='color:green'>Authorization Request</span>)</h3><pre>".json_encode($request, JSON_PRETTY_PRINT)."</pre>";
				echo "<b>Click Authorize button to give client the authorization code. By clicking authorize you agree to share your <p>1. <i>username</i><br>2. <i>email</i><br>3. <i>friend_list</i></p>with the client web application.</b>";
				echo "	<br><br>
						<form action='' method='POST'>
							<input type='hidden' name='auth'>
							<input type='submit' value='Authorize'>
						</form>";
				
				if(isset($_POST['auth'])){
					header("Location: ".$redirect_uri."?implicit=implicit#access_token=${access_token}&token_type=hmac&expires_in=12000&scope=".$_GET['scope']."&state=".$_GET['state']);
				}

			
		}else{
			echo "Client Id not found";
		}
	}else{
		echo "Incorrect Redirect URI";
	}

}



?>