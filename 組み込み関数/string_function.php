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
print strlen($str);//結果 23

print '<br/>';
//5.2.2 文字列を大文字⇆小文字で変換する mb_convert_case関数
$data_1 = 'Wings project';
$data_2 = 'W I N G Sプロジェクト';
$data_3 = 'Fußball';//ドイツ語のß（エスツェット）は「ss」を表す

print mb_convert_case($data_1, MB_CASE_UPPER);//結果 WINGS PROJECT
print '<br/>';
print mb_convert_case($data_1, MB_CASE_LOWER);//結果 wings project
print '<br/>';
print mb_convert_case($data_1, MB_CASE_TITLE);//結果 Wings Project
print '<br/>';
print mb_convert_case($data_2, MB_CASE_LOWER);//結果 w i n g sプロジェクト
print '<br/>';
print mb_convert_case($data_2, MB_CASE_UPPER);//結果 W I N G Sプロジェクト
print '<br/>';
print mb_convert_case($data_3, MB_CASE_UPPER);//結果 FUSSBALL
print '<br/>';
print mb_convert_case($data_3, MB_CASE_UPPER_SIMPLE);//結果 FUßBALL
print '<br/>';

//5.2.3 部分文字列を取得する① mb_substr関数
$str = 'WINGSプロジェクト';
print mb_substr($str, 5, 2);//結果 プロ
print '<br/>';
print mb_substr($str, 5);//結果 プロジェクト
print '<br/>';
print mb_substr($str, 5, -4);//結果 プロ
print '<br/>';
print mb_substr($str, -6, 2);//結果 プロ
print '<br/>';

//5.2.4 部分文字列を取得する② mb_strstr関数
$str = 'WINGSプロジェクト';
print mb_strstr($str, 'S', true);//結果 WING
print '<br/>';
print mb_strstr($str, 'S');//結果 Sプロジェクト
print '<br/>';
print mb_strstr($str, 'M', false);//結果 false(何も表示されない)
print '<br/>';

//5.2.5 部分文字列を置換する str_replace関数
/*
構文
str_replace(string|array $search, string|array $replace,string|array $subject
[,int&$count]):string|array

$search：置き換える部分文字列
$replace：置き換え後の文字列
$subject：対象の文字列
&$count：置き換えた文字列の個数を格納する変数
*/
$str = 'にわにはにわにわとりがいる';
print str_replace('にわ', 'ニワ', $str, $cnt);//結果 ニワにはニワニワとりがいるd
print '<br/>';
print "{$cnt}個の置き換えをしました。";//結果 3個の置き換えをしました。

print '<br/>';
//引数$search、$replace、$subjectには、それぞれ配列を渡すこともできます
$str = ['PHPは良い言語です。','PHPは良いサーバー実行環境です。'];
$src = ['PHP','良い'];
$rep = ['PHP8','素晴らしい'];
print_r(str_replace($src, $rep, $str, $cnt));//結果 Array ( [0] => PHP8は素晴らしい言語です。 [1] => PHP8は素晴らしいサーバー実行環境です。 )
print '<br/>';
print "{$cnt}個の置き換えをしました。";//結果 4個の置き換えをしました。