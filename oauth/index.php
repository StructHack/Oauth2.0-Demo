<!DOCTYPE html>
<html>
<head>
	<title>Oauth2.0 Flow</title>
	<link rel="stylesheet" href="main.css">
</head>
<body>
	<h1>Oauth2.0 Grant Types</h1>
	<div id="green">
		<p><b>This is a demo application just to show the flow of different grant types in Oauth2.0. In every step you have to click continue to go to next step. It's not done to make things tedious rather to make things more clearer for the ones who want to learn Oauth2.0 in depth.</b></p>
	</div>
	<main>
		<nav>
			<ul>
				<li><a>Authorization Code</a></li>
				<li><a>Implicit</a></li>
				<li><a>Resource owner password Credentials</a></li>
				<li><a>Client Credentials</a></li>
			</ul>
			<br><br><br>
			<form action="client.php" method="POST">
				<input type="hidden" id="granttype" name="grant_type" value="authorization code">
				<input type="submit" id="sub" value="Authorization Code">
			</form>
		</nav>
	</main>
	<script src="main.js"></script>
</body>
</html>