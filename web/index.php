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
    //'Content-Type: application/json; charser=UTF-8',
    "Authorization: Bearer FOEEtX4oeGnLbqAMWXQuv+WFCtvBtYUC312zQNFH80BFUcMrjO2nJ5z4ZsAsuz0rwgNbfj+XypPfHuE76plAFmzVLnp8OZbCd0bMB9B5+Nb8MxOS+xLo1BllVRQnNu9mc/SMTOxbnCb2hN265hyj7QdB04t89/1O/w1cDnyilFU="
    ));
curl_setopt($chUser, CURLOPT_RETURNTRANSFER, true);
$resultUser = curl_exec($chUser);
curl_close($chUser);

$jsonObj2 = json_decode($resultUser);
$sourceUserName = $jsonObj2 ->{"displayName"};
echo "/n Result- ".$resultUser."/n";
echo $sourceUserName;
  
//$post_data = [
//	"to" => "U1caf201451c3425c1fd1576ad7ab8c48",
//	"messages" => [{
//		"type":"text",
//		"text":"Hello, world1"
//	},
//	{
//		"type":"text",
//		"text":"Hello, world2"
//	}]
//];
//$ch = curl_init();
//curl_setopt($ch,CURLOPT_URL,"https://api.line.me/v2/bot/message/push");
//curl_setopt($ch, CURLOPT_POST, true);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
//curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//    "Content-Type: application/json; charser=UTF-8",
//    "Authorization: Bearer N48DY/N89s/hQfZZTy0hnx4HSEC1yvpfJubFiQfLWcgk+M56cMNgUHz/c4RdqipD986zTvXWYBFU3wdCHauRRkRdmlOB1auzWe0sz9PGMWDGMGJ1ah0ApLAipNyACy5EwAIiWZt6pU/Yxk6h8HhVpAdB04t89/1O/w1cDnyilFU="
//    ));
//$result2 = curl_exec($ch);
//curl_close($ch);  
  
?>
</body>
</html>
