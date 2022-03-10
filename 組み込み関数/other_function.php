<?php
//5.6 その他の関数
//5.6.1 数学関数
print abs(-100);//結果 100 abs = 絶対値
print '<br/>';
print base_convert(100, 2, 10);//結果 4 base_convert = $from -> $to進数への変換
print '<br/>';
print ceil(1234.56);//結果 1235 ceil = 小数点以下の切り下げ
print '<br/>';
print floor(1234.56);//結果 1234 floor = 小数点以下の切り上げ
print '<br/>';
print intdiv(10, 3);//結果 3 intdiv = $num1 / $num2 の整数商
print '<br/>';
print fmod(10.5, 5);//結果 0.5 fmod = $x / $y の余剰余
print '<br/>';
print max(1, 5, 3);//結果 5 max = 最大値
print '<br/>';
print min(1, 5, 3);//結果 1 min =  最小値
print '<br/>';
print rand(123.456, 2);//結果 ランダム $rand = $min〜$maxの乱数
print '<br/>';
print pow(2, 4);//結果 16 pow = $baseの$exp乗
print '<br/>';
print round(123.456, 2);//結果 123.46 round = 小数点以下$prec桁で数値を丸め
print '<br/>';
print sqrt(10000);//結果 100 sqrt = 平行根
print '<br/>';
print cos(deg2rad(60));//結果 0.5 cos = コサイン
print '<br/>';
print sin(deg2rad(30));//結果 0.5 sin = サイン
print '<br/>';
print tan(deg2rad(45));//結果 1 tan = タンジェント
print '<br/>';
print deg2rad(180);//結果 3.1415926535898 deg2rad() = 度->ラジアンに変換
print '<br/>';
print exp(1);//結果 2.718281828459 exp = eの($num)乗
print '<br/>';
print log10(100);//結果 2 底10の対数
print '<br/>';
print log(125, 5);//結果 3 対数

//5.6.2 変数を破棄する unset関数
/* 構文
unset($var, $vars)

$var、$vars：破棄対象の変数
*/
$str;
var_dump($str);//結果 NULL
print '<br/>';
$str = '代入';
var_dump($str);//結果 string(6) "代入"
print '<br/>';
unset($str);
var_dump($str);//結果 NULL

print '<br/>';
//5.6.3 変数のデータ型を判定する is_xxxxx関数
/*
これまで繰り返し述べてきたように、PHPはデータ型に寛容な言語です。
しかし、スクリプトを記述していく上で、型を完全に無視することはできません。特に値の演算や比較では、型を意識せざるを得ません。
そこで登場するのが、is_xxxxx関数です。
is_xxxxx関数を利用することで、変数／リテラルのデータ型を判定し、その結果をtrue／falseで得ることができます
*/
var_dump(is_int(101));//結果 bool(true)
print '<br/>';
var_dump(is_int('101'));//結果 bool(false)
print '<br/>';
var_dump(is_numeric('101'));//結果 bool(true)
print '<br/>';
var_dump(is_float(1.5E8));//結果 bool(true)
print '<br/>';
var_dump(is_resource(fopen('access.log', 'r')));//結果 bool(true)
print '<br/>';
var_dump(is_null(''));//結果 bool(false)
print '<br/>';
/*
is_numeric関数を除いては、データ型を厳密に判定する点に注意してください。
たとえばフォームから入力される数値は内部的には文字列型として扱われます。そのため、is_int関数やis_float関数は常にfalseを返します。
その場合は、数値形式の文字列も認識できるis_numeric関数を利用する必要があります。
*/