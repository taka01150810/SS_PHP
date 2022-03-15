<?php
/*
標準的な関数ではカバーされていないような、定型的な処理については、アプリ開発者が自分で定義することもできます。このような関数をユーザー定義関数と言います。
*/

//6.1.1 ユーザー定義関数とは?
$base = 8;
$height = 10;
$area = $base * $height / 2;
print "三角形の面積は{$area}です。";//結果：三角形の面積は40です。

//三角形の面積をコード内の複数の場所で求めたくなった場合、面倒だし、冗長。
//ユーザー定義関数とは、まさに重複したコードを一箇所にまとめるための仕組みである
function getTriangleArea($base, $height){
    return $base * $height / 2;
}
$area = getTriangleArea(8, 10);
print "三角形の面積は{$area}です。";

print '<br/>';
//6.1.2 関数名
/*
識別子の命名規則に従うのは、変数の場合と同じgetTriangleArea、updateInfoのようなcamelCase記法で表します。
具体的には、addElementのように「動詞＋名詞」の形式で命名することをお勧めします。
checkUpdateDataのような、複数動詞の連結も一般的には避けるべきです。
*/
