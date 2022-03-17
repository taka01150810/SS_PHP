<?php
//6.3 引数の様々な記法

//6.3.1 引数の既定値
function getTriangleArea(float $base = 5, float $height = 1):float {
    return $base * $height / 2;
}
$area = getTriangleArea();
print "三角形の面積は{$area}です。<br/>";//結果 三角形の面積は2.5です。
$area = getTriangleArea(10);
print "三角形の面積は{$area}です。<br/>";//結果 三角形の面積は5です。
$area = getTriangleArea(10, 5);
print "三角形の面積は{$area}です。<br/>";//結果 三角形の面積は25です。
/*
既定値とは、その引数を省略した場合に既定で設定される値のことです。既定値を持つ引数は、すなわち「省略可能である」と考えてもよいでしょう
*/

//既定値を設定した引数の後ろに必須の引数を置いてはいけない
/*
function getTriangleArea_1( float $base=5, float $height):float{
    return $base * $height/2;
}
$area = getTriangleArea(10); //結果 エラー
*/

//6.3.2 引数の参照渡し
//引数は値渡しされるのが基本
function increment(int $num):int {
    $num++;
    return $num;
}
$value = 10;
print increment($value);//結果 11
print $value;//結果 10

//引数の参照渡し
function increment_1(int &$num):int {
    $num++;
    return $num;
}
$value = 10;
print increment_1($value);//結果 11
print $value;//結果 11