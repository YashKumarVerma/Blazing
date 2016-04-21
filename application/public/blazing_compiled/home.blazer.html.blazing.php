<!DOCTYPE html>
<html>
<head>
	<title>Blazer Demo </title>
	<?php css("home.css"); ?>
	<?php script("error.js"); ?>
</head>
<body>

<h1> Hello <?= $user ?> </h1>	
<p>Welcome to <?php echo $GLOBALS["protected"]["app"]["url"] ?> </p>
</body>
</html>