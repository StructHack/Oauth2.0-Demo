<?php

	$access_token = "ACK_XXXXXX";

	if(isset($_GET['access_token'])){
		if($_GET['access_token'] === $access_token){
		$data = 	[
						"username"=>"0xdipendra",
						"email"=>"0xdipendra@gmail.com",
						"friend_list"=>['Ronnie Dashboard', 'Abdhulla Khanpur', 'Ahmed Water Melon', 'JohnCena Garcia']
					];
		echo "<h3><span style='color:green'>Resource Owner's Data</span></h3><pre>".json_encode($data, JSON_PRETTY_PRINT)."</pre>";
	}else{
		echo "<p style='color:red'><b>Wrong Access Token.</b></p>";
	}
}


?>