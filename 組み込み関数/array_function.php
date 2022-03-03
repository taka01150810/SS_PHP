<?php
/* 5.3 配列関数
配列関数は、配列に対して要素を追加／削除したり、配列要素を並べ替えたりと、配列に対する操作全般を担う関数です。
*/

//5.3.1 配列の要素数を取得する count関数
$data = ['山田','掛谷','日尾','本多','矢吹'];
print count($data);//結果：5

print '<br/>';
$data = [
    ['X1','X2','X3'],
    ['Y1','Y2','Y3'],
    ['Z1','Z2','Z3']
];
print count($data);//結果 3

print '<br/>';
//入れ子になった配列までカウントしたい場合
print count($data, COUNT_RECURSIVE);//結果:12

print '<br/>';
//要素の登場回数をカウントする
/*
array_count_values関数の戻り値は、「要素値=>登場回数」形式の連想配列です。
ただし、カウントできるのは文字列／数値のみです。
*/
$data=['い','ろ','は','に','ほ','へ','と','い','ろ'];
print_r(array_count_values($data));//結果 Array ( [い] => 2 [ろ] => 2 [は] => 1 [に] => 1 [ほ] => 1 [へ] => 1 [と] => 1 )

print '<br/>';
//5.3.2 配列の内容を連結する array_merge関数
$ary1 = [1,3,5];
$ary2 = [2,3,6];
$result = array_merge($ary1, $ary2);
print_r($result);//結果 Array ( [0] => 1 [1] => 3 [2] => 5 [3] => 2 [4] => 3 [5] => 6 )

print '<br/>';
$assoc1 = ['Apple' => 'Red', 'Orange' => 'Yellow', 'Melon' => 'Green'];
$assoc2 = ['Grape' => 'Purple', 'Apple' => 'Green', 'Strawberry' => 'Red'];
$result = array_merge($assoc1, $assoc2);
print_r($result);//結果 Array ( [Apple] => Green [Orange] => Yellow [Melon] => Green [Grape] => Purple [Strawberry] => Red )

print '<br/>';
//結果 配列のキーが重複した場合は（上書きするのではなく）入れ子の配列を生成するarray_merge_recursive関数を使う
$result = array_merge_recursive($assoc1, $assoc2);
print_r($result);//結果 Array ( [Apple] => Array ( [0] => Red [1] => Green ) [Orange] => Yellow [Melon] => Green [Grape] => Purple [Strawberry] => Red )

print '<br/>';
//5.3.3 配列の各要素を結合する implode関数
$data = ['PHP','Perl','Ruby','Python','JavaScript'];
print implode(',',$data);//結果 PHP,Perl,Ruby,Python,JavaScript