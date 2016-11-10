<!DOCTYPE html>
<html>
<head>
<title>こちらはLINE Messaging APIのデモサイトです。</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
こちらはLINE Messaging APIのデモサイトです。

  <?php
$chUser = curl_init();
curl_setopt($chUser,CURLOPT_URL,"https://api.line.me/v2/bot/profile/U1caf201451c3425c1fd1576ad7ab8c48");
//curl_setopt($chUser, CURLOPT_HTTPHEADER, "Authorization: Bearer FOEEtX4oeGnLbqAMWXQuv+WFCtvBtYUC312zQNFH80BFUcMrjO2nJ5z4ZsAsuz0rwgNbfj+XypPfHuE76plAFmzVLnp8OZbCd0bMB9B5+Nb8MxOS+xLo1BllVRQnNu9mc/SMTOxbnCb2hN265hyj7QdB04t89/1O/w1cDnyilFU=");
curl_setopt($chUser, CURLOPT_HTTPHEADER,array(
    'Content-Type: application/json; charser=UTF-8',
    'Authorization: Bearer FOEEtX4oeGnLbqAMWXQuv+WFCtvBtYUC312zQNFH80BFUcMrjO2nJ5z4ZsAsuz0rwgNbfj+XypPfHuE76plAFmzVLnp8OZbCd0bMB9B5+Nb8MxOS+xLo1BllVRQnNu9mc/SMTOxbnCb2hN265hyj7QdB04t89/1O/w1cDnyilFU='
    ));
  
  
curl_setopt($chUser, CURLOPT_RETURNTRANSFER, true);
$resultUser = curl_exec($chUser);
curl_close($chUser);

$jsonObj2 = json_decode($resultUser);
$sourceUserName = $jsonObj2 ->{"displayName"};
echo $resultUser;
 echo $sourceUserName;
?>
</body>
</html>
