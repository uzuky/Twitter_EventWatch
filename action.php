<?php
require './oauth.php';
  
class Action{
	function Event_Watch($tmhOAuth,$data)
	{
		@$event = $data->event;
		@$screen_name = $data->{"source"}->{"screen_name"};
		@$user_id = $data->{"source"}->{"user"}->{"id_str"};
		switch ($event) {
			//出力
			case 'favorite':
				$text = "@$screen_name"."のふぁぼを見た"."\n";
				break;
			case 'unfavorite':
				$text = "@$screen_name"."のあんふぁぼを見た"."\n";
				break;
			case 'follow';
				$text = "@$screen_name"."のふぉろーを見た"."\n";
				break;
		}
		switch ($event) {
			case 'favorite':
			case 'unfavorite':
			case 'follow':
				print $text;
				self::UpdateStatus($tmhOAuth,$text,$user_id);
				break;
		}	
	}
	
	function UpdateStatus($tmhOAuth,$text,$InReplyTo)
	{
		$tmhOAuth->request('POST', $tmhOAuth->url('1/statuses/update'), array(
		'status' => $text
		));
	}
	
	public function Tweet_Watch($tmhOAuth,$data){
		@$screen_name = $data->{"user"}->{"screen_name"};
		@$text = $data->{"text"};
		print "@$screen_name - $text \n";
	}
}
