<?php

// Do not edit this if you are not familiar with php
error_reporting (E_ALL ^ E_NOTICE);
$post = (!empty($_POST)) ? true : false;

$replyto='info@sintrave.com';
$subject = 'Formulario Contacto';

if($post)
	{
	function ValidateEmail($email)
	{

$regex = "([a-z0-9_\.\-]+)". # name

"@". # at

"([a-z0-9\.\-]+){2,255}". # domain & possibly subdomains

"\.". # period

"([a-z]+){2,10}"; # domain extension 

$eregi = eregi_replace($regex, '', $email);

return empty($eregi) ? true : false;
}

$name = stripslashes($_POST['name']);
$email = trim($_POST['email']);

$message = stripslashes($_POST['message']);
$company = stripslashes($_POST['company']);
$answer = trim($_POST['answer']);
$verificationanswer="10"; // plz change edit your human answer
$from=$email;
$to=$replyto;
$error = '';
$headers= "From: $name <" . $email . "> \n";
$headers.= "Reply-to:" . $email . "\n";
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers = "Content-Type: text/html; charset=utf-8\n".$headers;

// Checks Name Field

if(!$name || !$email || $email && !ValidateEmail($email) || $answer <> $verificationanswer || !$message || strlen($message) < 1)
{
$error .= 'Rellena los campos correctamente.<br />';
}

if(!$error)
	{
$messages.="Name: $name <br>";
$messages.="Email: $email <br>";
$messages.="Empresa: $company <br>";
$messages.="Message: $message <br>";

	$mail = mail($to,$subject,$messages,$headers);	

if($mail)
	{
	echo 'OK';
if($autorespond == "yes")
{
	include("autoresponde.php");
}
	}

	}
	else
	{
	echo '<div class="error">'.$error.'</div>';
	}

}
?>