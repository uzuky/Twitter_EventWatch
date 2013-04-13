<?php
  require dirname(__FILE__).'/'.'./lib/tmhOAuth/tmhOAuth.php';
  require dirname(__FILE__).'/'.'./oauth.php';
  require dirname(__FILE__).'/'.'./action.php';
  
  $tmhOAuth = new tmhOAuth(
	  array(
	  "consumer_key" => $consumer_key,
	  "consumer_secret" => $consumer_secret,
	  "user_token" => $user_token,
	  "user_secret" => $user_secret)
  );
  
  
  
  //Tweet受信にfilter_callback関数を呼び出す
  $method = "https://userstream.twitter.com/1.1/user.json";
  $params = array();
  $tmhOAuth->streaming_request('POST', $method, $params, 'filter_callback', true);
  
  function filter_callback($data, $length, $metrics) {
  	global $tmhOAuth;
	  @$res = json_decode($data);
	  
	  //各アクションを実行 必要ないものはコメントアウトしましょ
	  
	  /** えんくんのアレ **/
	  Action::Event_Watch($tmhOAuth,$res);
	  
	  /** スクリーンネームとつぶやきを見る**/
	  Action::Tweet_Watch($tmhOAuth,$res);
	  
	  /** らこらこらこ～ｗ **/
	  Action::Lacolacolaco($tmhOAuth,$res,@$your_screen_name);
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
