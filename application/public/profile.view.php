<!DOCTYPE html>
<html>
<head>
	<title>Profile of <?php echo $username ?></title>
</head>
<body>
<h1> Hello I am <?= $username ?>. </h1> 
<form method="post">
	
	<div class='form-group'>
		<input type='text' name='name' class='form-control' placeholder='Name' >
	</div>
	<button type="submit">Submit</button>
	
</form>
</body>
</html>