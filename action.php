<?php
class Action{
	public function Event_Watch($tmhOAuth,$data)
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
	
	public function UpdateStatus($tmhOAuth,$text,$InReplyTo = null)
	{
		return $tmhOAuth->request('POST', $tmhOAuth->url('1.1/statuses/update'), array(
		'status' => $text
		));
	}
	
	public function Lacolacolaco($tmhOAuth,$data,$your_screen_name)
	{
		@$text = $data->{"text"};
		@$id = $data->{"id_str"};
		//$source_user_id = $data->{"user"}->{"id_str"};
		@$source_screen_name = $data->{"user"}->{"screen_name"};
		$target_text = 'らこらこらこ';
		$wait_time = 300; //300秒待機
		$post_text = 'らこらこらこ〜ｗ';
		
		if( (@$post_time === null) || (@$post_text > time())){
			if( $source_screen_name !== $your_screen_name ){
				if ((strpos($text, $target_text)) !== false) {
					$res = self::UpdateStatus($tmhOAuth,$post_text);
					if($res !== 403){
						$post_time = time() + $wait_time;
					}
					self::Create_Favorite($tmhOAuth,$id);
					while($res == 403){
						// 投稿失敗時、ｗが4以下だったららこらこする
						if( (substr_count($post_text, 'ｗ')) < 4){
							$post_text .= 'ｗ';
							$res = self::UpdateStatus($tmhOAuth,$post_text);
							$post_time = time() + $wait_time;
						}
					}
				}
			}
		}
	}
	
	public function Create_Favorite($tmhOAuth,$id)
	{
		$tmhOAuth->request('POST', $tmhOAuth->url('1.1/favorites/create'), array(
		'id' => $id
		));
	}
	
	public function Tweet_Watch($tmhOAuth,$data){
		@$screen_name = $data->{"user"}->{"screen_name"};
		@$text = $data->{"text"};
		print "@$screen_name - $text \n";
	}
}
