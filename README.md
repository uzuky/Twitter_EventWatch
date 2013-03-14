###なにこれ
@enkunkun氏の
>[![test](https://si0.twimg.com/profile_images/3363502251/fb0a154766e0a66b2e9898f307b02639_normal.png)](https://twitter.com/enkunkun/status/312291081276489728?lang=ja)
>@taiki45 |◞‸◟ ) あんふぁぼされた…

みたいなものをPHPで実装した。

###Install
```
$ git clone git://github.com/mizofumi0411/Twitter_EventWatch.git ~/TL_Watch
```

###使い方
まずは、~/TL_Wach の 中にある oauth.php にコンシューマキーやアクセストークンを設定してください。

```
<?php
$consumer_key = "";
$consumer_secret = "";
$user_token = "";
$user_secret = "";
```

あとは、userstream.phpを叩くだけ。

```
$ php userstream.php
```

そうするとターミナル上にTLが流れてくるはずです。

###動作確認環境
OS:Ubuntu 12.04  
PHP:5.4.6
