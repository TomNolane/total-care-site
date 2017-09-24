<?php
$res;
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if(empty($_POST['g-recaptcha-response']))
	{
		exit('Emty captcha');
	}
	
	$url = 'https://www.google.com/recaptcha/api/siteverify';
	
	$secret = '*******'; //secret from g-recaptcha
	$recaptcha = $_POST['g-recaptcha-response'];
	$ip = $_SERVER['REMOTE_ADDR'];
	
	$url_data = $url.'?secret='.$secret.'&response='.$recaptcha.'&remoteip='.$ip;
	
	$curl = curl_init();
	curl_setopt($curl,CURLOPT_URL,$url_data);
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);
	$res = curl_exec($curl);
	curl_close($curl);
	
	$res = json_decode($res); 

if($res->success)
{
	if (isset($_POST['secondaymit'])) { 
$to      = 'medvedev.alexandr88@yandex.ru';
$subject = 'Письмо с сайта total-care';
$message .= "Имя: ".$_POST["name"]."\r\n"; 
$message .= "Email: ".$_POST["email"]."\r\n"; 
$message .= "Контактный телефон:".$_POST['secondayject']."\r\n\r\n";  
$message .= "Текст обращения:\r\n".nl2br($_POST["message"])."";
$headers = 'From: info@total-care.ru' . "\r\n" . 
    'X-Mailer: PHP/' . phpversion();



if(mail($to, $subject, $message, $headers))
{
	$_POST['tt'] = 'Письмо было успешно отправлено !';
	echo "<script>alert('Письмо было успешно отправлено !!');</script>";
	echo '<meta http-equiv="refresh" content="0;URL=http://total-care.ru/">';
	//header('Location: http://total-care.ru/ ');
      
}	
else
{
	echo "<script>alert('Письмо не отправлено, поробуйте снова!');</script>";
}

	  }
}	
}





