<?php
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
	
	function Lacolacolaco($tmhOAuth,$data)
	{
		$text = $data->{"text"};
		$id = $data->{"id_str"};
		$target_text = 'らこらこらこ';
		$post_text = 'らこらこらこ〜ｗ';
		if ((strpos($text, $target_text)) !== false) {
			$res = self::UpdateStatus($tmhOAuth,$post_text);
			self::Create_Favorite($tmhOAuth,$id);
			while($res == 403){
				$post_text .= 'w';
				$res = self::UpdateStatus($tmhOAuth,$post_text);
			}
		}
	}
	
	function Create_Favorite($tmhOAuth,$id)
	{
		$tmhOAuth->request('POST', $tmhOAuth->url('1.1/favorites/create'), array(
		'id' => $id
		));
	}
	
	function Tweet_Watch($tmhOAuth,$data){
		@$screen_name = $data->{"user"}->{"screen_name"};
		@$text = $data->{"text"};
		print "@$screen_name - $text \n";
	}
}
