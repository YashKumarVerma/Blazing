<!DOCTYPE html>
<html>
<head>
	<title>Blazer Demo </title>
	<!-- load css files  -->
	<?php blazer::css("home.css"); ?>

	<!-- load js files -->
	<?php blazer::script("error.js"); ?>

	<!-- to autoload entire plugin link bootstrap-->
	<?php blazer::plugin("bootstrap/autoload.json"); ?>

</head>
<body>

<!-- show a variable -->
<h1> Hello <?= $user ?> </h1>


<!-- escape and show variable  -->
hello escaped  <?php echo htmlspecialchars($user); ?> !

<!-- show system variable -->
<p>Welcome to <?php echo $GLOBALS["protected"]["app"]["url"] ?> </p>
</body>
</html>