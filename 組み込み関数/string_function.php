<?php

//文字列関数は、文字列の加工や整形、部分文字列の検索／取得など、文字列の操作に広くかかわる機能を提供します。

//5.2.1 文字列の長さを取得する mb-strlen関数
/*
$string：対象の文字列 $encoding：使用する文字エンコーディング
引数 $encoding は、文字列を処理する際に利用する文字エンコーディング名です。

mb_strlen(string $string[,?string$encoding]):int
*/
$str = 'WINGSプロジェクト';
print mb_strlen($str);//結果：11

print '<br/>';
/*
よく似た関数としてstrlen関数がありますが、こちらはマルチバイト文字（日本語）には対応していないので注意してください。
英数字（半角文字）であれば1文字は1バイトで表されるので、問題はありません。
しかし、日本語（マルチバイト文字）の1文字が何バイトで表されるかは、利用している文字エンコーディングによって異なります。
*/
print strlen($str);//結果23