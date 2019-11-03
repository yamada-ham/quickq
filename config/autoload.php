<?php

/*
MyApp
index.php controller
MyApp\Controller\Index
-> lib/Controller/Index.php
*/

//spl_autoload_register--オートローダーを登録するための関数
spl_autoload_register(function($class) {
  $prefix = 'MyApp\\';

  //strpos(文字列,探す文字)—文字列内の部分文字列が最初に現れる場所を見つける
  if (strpos($class, $prefix) === 0) {

    //'MyApp\'の以降の文字列を取得
    $className = substr($class, strlen($prefix));

    //ページ出力したページのリンクを作成
    //str_replace(置換される文字,置換後の文字,対象の文字) — 検索文字列に一致したすべての文字列を置換。置換後の文字列を返す
    $classFilePath = __DIR__ . '/../lib/' . str_replace('\\', '/', $className) . '.php';

    //そのページのファイルが存在していたら呼び出す
    if (file_exists($classFilePath)) {
      require $classFilePath;
    }
  }
});
