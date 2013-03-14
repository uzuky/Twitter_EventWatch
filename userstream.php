<?php
  require './lib/tmhOAuth/tmhOAuth.php';
  require './oauth.php';
  require './action.php';
  
  $tmhOAuth = new tmhOAuth(
	  array(
	  "consumer_key" => $consumer_key,
	  "consumer_secret" => $consumer_secret,
	  "user_token" => $user_token,
	  "user_secret" => $user_secret)
  );
  
  
  
  //Tweet受信にfilter_callback関数を呼び出す
  $method = "https://userstream.twitter.com/2/user.json";
  $params = array();
  $tmhOAuth->streaming_request('POST', $method, $params, 'filter_callback', true);
  
  function filter_callback($data, $length, $metrics) {
  	global $tmhOAuth;
	  @$res = json_decode($data);
	  
	  //各アクションを実行
	  Action::Event_Watch($tmhOAuth,$res);
	  Action::Tweet_Watch($tmhOAuth,$res);
  }
  
  /***
   * [メモ]エラー時のレスポンス
   * 
   * [response][error] = connect() timed out!
   * [response][errno] = 28
   */
 
 /***
  * 流れてくる情報は以下のURLを参照
  * 
  * https://gist.github.com/mizofumi0411/4426842
  */ 