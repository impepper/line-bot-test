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

$chUser = curl_init("https://api.line.me/v2/bot/profile/".$sourceUserID);
curl_setopt($chUser, CURLOPT_HTTPHEADER, array(
	//'"Authorization: Bearer ' . $accessToken . '"'
	"Authorization: Bearer " . $accessToken 
	//"Authorization: Bearer FOEEtX4oeGnLbqAMWXQuv+WFCtvBtYUC312zQNFH80BFUcMrjO2nJ5z4ZsAsuz0rwgNbfj+XypPfHuE76plAFmzVLnp8OZbCd0bMB9B5+Nb8MxOS+xLo1BllVRQnNu9mc/SMTOxbnCb2hN265hyj7QdB04t89/1O/w1cDnyilFU="
    ));
curl_setopt($chUser, CURLOPT_RETURNTRANSFER, true);
$resultUser = curl_exec($chUser);
curl_close($chUser);

$jsonObj2 = json_decode($resultUser);
$sourceUserName = $jsonObj2 ->{"displayName"};

//メッセージ以外のときは何も返さず終了
if($type != "text"){
	exit;
}

//返信データ作成
if ($text == 'はい') {
  $response_format_text = [
    "type" => "template",
    "altText" => "こちらの〇〇はいかがですか？",
    "template" => [
      "type" => "buttons",
      "thumbnailImageUrl" => "https://" . $_SERVER['SERVER_NAME'] . "/img1.jpg",
      "title" => "××レストラン",
      "text" => "お探しのレストランはこれですね",
      "actions" => [
          [
            "type" => "postback",
            "label" => "予約する",
            "data" => "action=buy&itemid=123"
          ],
          [
            "type" => "postback",
            "label" => "電話する",
            "data" => "action=pcall&itemid=123"
          ],
          [
            "type" => "uri",
            "label" => "詳しく見る",
            "uri" => "https://" . $_SERVER['SERVER_NAME'] . "/"
          ],
          [
            "type" => "message",
            "label" => "違うやつ",
            "text" => "違うやつお願い"
          ]
      ]
    ]
  ];
} else if ($text == 'いいえ') {
  exit;
} else if ($text == '違うやつお願い') {
  $response_format_text = [
    "type" => "template",
    "altText" => "候補を３つご案内しています。",
    "template" => [
      "type" => "carousel",
      "columns" => [
          [
            "thumbnailImageUrl" => "https://" . $_SERVER['SERVER_NAME'] . "/img2-1.jpg",
            "title" => "●●レストラン",
            "text" => "こちらにしますか？",
            "actions" => [
              [
                  "type" => "postback",
                  "label" => "予約する",
                  "data" => "action=rsv&itemid=111"
              ],
              [
                  "type" => "postback",
                  "label" => "電話する",
                  "data" => "action=pcall&itemid=111"
              ],
              [
                  "type" => "uri",
                  "label" => "詳しく見る（ブラウザ起動）",
                  "uri" => "https://" . $_SERVER['SERVER_NAME'] . "/"
              ]
            ]
          ],
          [
            "thumbnailImageUrl" => "https://" . $_SERVER['SERVER_NAME'] . "/img2-2.jpg",
            "title" => "▲▲レストラン",
            "text" => "それともこちら？（２つ目）",
            "actions" => [
              [
                  "type" => "postback",
                  "label" => "予約する",
                  "data" => "action=rsv&itemid=222"
              ],
              [
                  "type" => "postback",
                  "label" => "電話する",
                  "data" => "action=pcall&itemid=222"
              ],
              [
                  "type" => "uri",
                  "label" => "詳しく見る（ブラウザ起動）",
                  "uri" => "https://" . $_SERVER['SERVER_NAME'] . "/"
              ]
            ]
          ],
          [
            "thumbnailImageUrl" => "https://" . $_SERVER['SERVER_NAME'] . "/img2-3.jpg",
            "title" => "■■レストラン",
            "text" => "はたまたこちら？（３つ目）",
            "actions" => [
              [
                  "type" => "postback",
                  "label" => "予約する",
                  "data" => "action=rsv&itemid=333"
              ],
              [
                  "type" => "postback",
                  "label" => "電話する",
                  "data" => "action=pcall&itemid=333"
              ],
              [
                  "type" => "uri",
                  "label" => "詳しく見る（ブラウザ起動）",
                  "uri" => "https://" . $_SERVER['SERVER_NAME'] . "/"
              ]
            ]
          ]
      ]
    ]
  ];
} else {
  $response_format_text = [
    "type" => "template",
    "altText" => "こ1んにちわ 何かご用ですか？（はい／いいえ）\n\n" . $sourceUserID . "\n\n Name:" . $sourceUserName,
    "template" => [
        "type" => "confirm",
        "text" => "こ2んにちわ 何かご用ですか？ \n\n Name:" . $sourceUserName . "\n UserID:" . $sourceUserID,
        "actions" => [
            [
              "type" => "message",
              "label" => "はい",
              "text" => "はい"
            ],
            [
              "type" => "message",
              "label" => "いいえ",
              "text" => "いいえ"
            ]
        ]
    ]
  ];
}

$post_data = [
	"replyToken" => $replyToken,
	"messages" => [$response_format_text]
	];

$ch = curl_init("https://api.line.me/v2/bot/message/reply");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json; charser=UTF-8',
    'Authorization: Bearer ' . $accessToken
    ));
$result = curl_exec($ch);
curl_close($ch);
$post_data_admin = [
	'to' => 'U1caf201451c3425c1fd1576ad7ab8c48',
	'messages' => [[
		'type'=>'text',
		'text' => 'こ2んにちわ 何かご用ですか？ \n\n Name:' . $sourceUserName . '\n UserID:' . $sourceUserID
	],]
];

$ch_admin = curl_init();
curl_setopt($ch_admin,CURLOPT_URL,"https://api.line.me/v2/bot/message/push");
curl_setopt($ch_admin, CURLOPT_POST, true);
curl_setopt($ch_admin, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch_admin, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array('to'=>'U1caf201451c3425c1fd1576ad7ab8c48','messages'=>[['type'=>'text','text'=>'hello world'],])));
curl_setopt($ch_admin, CURLOPT_POSTFIELDS, json_encode($post_data_admin));
  curl_setopt($ch_admin, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/json; charser=UTF-8",
    "Authorization: Bearer N48DY/N89s/hQfZZTy0hnx4HSEC1yvpfJubFiQfLWcgk+M56cMNgUHz/c4RdqipD986zTvXWYBFU3wdCHauRRkRdmlOB1auzWe0sz9PGMWDGMGJ1ah0ApLAipNyACy5EwAIiWZt6pU/Yxk6h8HhVpAdB04t89/1O/w1cDnyilFU="
    ));
$result2 = curl_exec($ch_admin);
curl_close($ch_admin); 
