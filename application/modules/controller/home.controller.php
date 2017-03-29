<?php

model::load('blazer');
model::load('handler_file');

// declare new function
function cover()
{
	// render::view('home.cover');
	// OR
	$view = new blazer();
	$view->render('home.cover.php',$data=NULL,FALSE);
	// set last parameter TRUE to enable turbo mode
}

function blazer()
{
	// plugin('bootstrap/autoload.json');
	$view = new blazer();
	$data['user'] = "Yash Kumar Verma";
	$view->render('home.blazer.html',$data,FALSE);
	// set last parameter TRUE to enable turbo mode
}

function workspaceMail()
{
	echo "hello !";

	$mail = new PHPMailer;	

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'user@example.com';                 // SMTP username
	$mail->Password = 'secret';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to

	$mail->setFrom('from@example.com', 'Mailer');
	$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
	$mail->addAddress('ellen@example.com');               // Name is optional
	$mail->addReplyTo('info@example.com', 'Information');
	$mail->addCC('cc@example.com');
	$mail->addBCC('bcc@example.com');

	$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'Here is the subject';
	$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) 
	{
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} 
	else 
	{
	    echo 'Message has been sent';
	}
}

function form(){
	echo "<form method='post'> <select name='select[]' multiple>".
	"<option val='1'>Some Option</option>".
	"<option val='2'>Some other Option</option>".
	"</select><input type='submit' /> </form>";
}

function post(){
	console($_POST);
	console(io::post('select'));
}