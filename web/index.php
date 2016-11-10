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
$accessToken = getenv('LINE_CHANNEL_ACCESS_TOKEN');


//ユーザーからのメッセージ取得
$json_string = file_get_contents('php://input');
$jsonObj = json_decode($json_string);

$type = $jsonObj->{"events"}[0]->{"message"}->{"type"};
//メッセージ取得
$text = $jsonObj->{"events"}[0]->{"message"}->{"text"};
//ReplyToken取得
$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};

$sourceUserID = $jsonObj->{"events"}[0]->{"source"}->{"userId"};
//

$chUser = curl_init("https://api.line.me/v2/bot/profile/U1caf201451c3425c1fd1576ad7ab8c48");
curl_setopt($chUser, CURLOPT_HTTPHEADER, 
	    'Authorization: Bearer ' . $accessToken
    );
curl_setopt($chUser, CURLOPT_RETURNTRANSFER, true);
$resultUser = curl_exec($chUser);
curl_close($chUser);

$jsonObj2 = json_decode($resultUser);
$sourceUserName = $jsonObj2 ->{"displayName"};
echo $resultUser
  echo $sourceUserName
?>
</body>
</html>
