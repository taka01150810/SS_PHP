<?php
/*
3.1 代数演算子
→ 四則演算をはじめ、日常的な数字を利用する演算子。
*/

//3.1.1 文字列混在の演算
print '108' + '15';//結果 123
print '<br/>';
print '108' + '1.5XYZ';//結果 警告文 + 109.5
print '<br/>';
print '108' + 'XYZ10';//結果 警告文 + 108
print '<br/>';
print '108' + '1.5XYZ10';//結果 警告文 + 109.5
print '<br/>';
print '108' + '1.5E1';//結果 123
print '<br/>';
print '108' + '0b11';//結果 警告文 + 108
print '<br/>';
print '108' + '010';//結果 118
print '<br/>';
print '108' + '0x1A';//結果 警告文 + 108

print '<br/>';
//3.1.2 加算子(++)/演算子(--)
/*
前置演算を行った場合、加算子は変数$xへの加算を行ったあとで$yへの代入を行います。
y = ++ x の後に x = y
*/
$x = 10;
$y = ++ $x;
print $x;//結果 11
print '<br/>';
print $y;//結果 11
print '<br/>';
/*
後置演算では、加算子は変数$jへの代入を行ったあと、$iへの加算処理を行います。
j = i の後に a++;
*/
$i = 10;
$j = $i ++;
print $i;//結果 11
print '<br/>';
print $j;//結果 10
print '<br/>';

//マジカルインクリメント
/*
アルファベットと数値が混在した文字列に対して加算子を適用すると、
末尾がアルファベットであれば次の文字へ、数値であれば1を加算するという特殊な処理が行われる
*/
$i = 'Z';
print ++ $i;//結果：AA
print '<br/>';
print ++ $i;//結果：AB
print '<br/>';

$j = 'T8';
print ++ $j;//結果：T9
print '<br/>';
print ++ $j;//結果：U0
print '<br/>';

//3.1.4 浮動小数点数の演算子に注意
print floor(( 0.1 + 0.7 ) * 10 );//結果：7
print '<br/>';
/*
なぜ 7 になるのか?
→ 浮動小数点数が、内部的には2進数で演算されるために発生する誤差である。
10進数ではごく単純に表せる0.1という値ですら、2進数の世界では0.0001100110011…という無限循環小数となる。
結果として（0.1＋0.7）×10も、内部的には7.999999999999999となる。

このような問題を避けるには、任意精度数学関数を利用してください
任意精度数学関数では、bcadd（加算）、bcsub（減算）、bcmul（乗算）、bcdiv（除算）、bccomp（比較）のような関数があります。
*/
$add = bcadd( 0.1, 0.7, 1 );//0.1＋0.7を小数点以下1桁まで計算する
$mul = bcmul( $add, 10, 1 );
print floor( $mul );//結果：8

print '<br/>';
//3.1.5 配列の結合
/*
左の配列に存在しないキーの要素を右の配列から取り出し、左の配列に追加される。
つまり、右の配列に左の配列と同じキーがあった場合、その値は無視されます。
*/
$assoc1 = [
    'Apple' => 'Red',
    'Orange' => 'Yellow',
    'Melon' => 'Green',
];
$assoc2 = [
    'Grape' => 'Purple',
    'Apple' => 'Green',
    'Strawberry' => 'Red',
];
$result = $assoc1 + $assoc2;
print_r($result);//結果 Array ( [Apple] => Red [Orange] => Yellow [Melon] => Green [Grape] => Purple [Strawberry] => Red )

print '<br/>';
$ary1 = [1,3,5];
$ary2 = [2,3,6];
$result = $ary1 + $ary2;
print_r($result);//結果 Array ( [0] => 1 [1] => 3 [2] => 5 )