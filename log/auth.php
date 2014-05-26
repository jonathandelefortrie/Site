<?php

session_start();

$client_id = '160862842860-fdmrkopgk8f9vtbmmofjo17auuelrf6k.apps.googleusercontent.com';
$client_secret = 'Mmt_TE-eaGiBI4hUWNoHuDH-';
$redirect_uri = 'https://www.dukegraphinc.com/log/auth.php';

$header  = 'https://accounts.google.com/o/oauth2/auth?';
$header .= 'client_id='.$client_id.'&'; 
$header .= 'redirect_uri='.$redirect_uri.'&';
$header .= 'scope=https://gdata.youtube.com&';
$header .= 'response_type=code&';
$header .= 'access_type=offline';

$date = time();

if(empty($_REQUEST['code']) && empty($_SESSION['date'])) {

	$_SESSION['date'] = $date;
	header('Location:' . $header);
}

$diff = $date - $_SESSION['date'];
$time = ($diff < 60) ? true : false;

if(isset($_REQUEST['code']) && $time) {
    
    $_SESSION['token'] = $_REQUEST['code'];
    $_SESSION['date'] = $date;
}

if(!$time) {
	session_destroy();
	header('Location:' . $redirect_uri);
}

$oauth2token_url = "https://accounts.google.com/o/oauth2/token";
$clienttoken_post = array(
                        "code" => $_SESSION['token'],
                        "client_id" => $client_id,
                        "client_secret" => $client_secret,
                        "redirect_uri" => $redirect_uri,
                        "grant_type" => "authorization_code"
                    );

$curl = curl_init($oauth2token_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $clienttoken_post);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$json_response = curl_exec($curl);

var_dump($json_response);

curl_close($curl);

?>