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

//5.3.4 配列の先頭／末尾に要素を追加／削除する  array_push／array_pop／array_shift／array_unshift関数
$data=['高江','青木','片渕'];
print array_push($data,'山田','土井');//結果：5（要素数）
// array_push = 末尾に追加
print '<br/>';
print_r($data);//結果：Array([0]=>高江[1]=>青木[2]=>片渕[3]=>山田[4]=>土井)
print '<br/>';
print array_pop($data);//結果：土井
// array_pop = 末尾から除去
print '<br/>';
print_r($data);//結果：Array([0]=>高江[1]=>青木[2]=>片渕[3]=>山田)
print '<br/>';
print array_shift($data);//結果：高江
// array_shift = 先頭から除去
print '<br/>';
print_r($data);//結果：Array ( [0] => 青木 [1] => 片渕 [2] => 山田 )
print '<br/>';
print array_unshift($data, '宮中');//結果：4(要素数)
// array_unshift = 先頭に追加
print '<br/>';
print_r($data);//結果：Array ( [0] => 宮中 [1] => 青木 [2] => 片渕 [3] => 山田 )
print '<br/>';
//5.3.5 スタックとキュー
/*
スタック（Stack）は、後入れ先出し（LIFO：LastInFirstOut）または先入れ後出し（FILO：FirstInLastOut）とも呼ばれる構造のことです。
たとえばアプリでよくあるUndo機能では、操作を履歴に保存し、最後に行った操作から順に取り出しますが、このような操作に使われるのがスタックです。
あるいは、キャリアカー（乗用車を運搬するためのトラック）をイメージしてみるとよいかもしれません。
この場合、順番に積み込んだ乗用車は、最後に積み込んだものからしか降ろすことはできません。

このようなスタック構造は、array_push関数（またはブラケット構文）とarray_pop関数によって表現できます。
array_push関数でキャリアカーに車を載せ、array_pop関数で車を降ろすのです。
*/
$data = [];
array_push($data, 10);
array_push($data, 15);
array_push($data, 30);

print_r($data);//結果 Array ( [0] => 10 [1] => 15 [2] => 30 )
print '<br/>';
print(array_pop($data));//結果 30
print '<br/>';
print_r($data);//結果 Array ( [0] => 10 [1] => 15 )

print '<br/>';
/*
キュー（Queue）は、（LIFO／FILOに対して）先入れ先出し（FIFO：FirstInFirstOut）とも呼ばれる構造のことです。
待ち行列と呼ばれることもあります。
イメージとしては、スーパーのレジに並ぶ人を思い浮かべればよいでしょう。この場合、レジに先に並んだ人が最初に精算を終え、出ていくことができます。

このようなキュー構造を表現するには、array_push関数（またはブラケット構文）とarray_shift関数の組み合わせを利用します。
*/
$data = [];
array_push($data, 10);
array_push($data, 15);
array_push($data, 30);

print_r($data);//結果 Array ( [0] => 10 [1] => 15 [2] => 30 )
print '<br/>';
print_r(array_shift($data));//結果 10
print '<br/>';
print_r($data);//結果 Array ( [0] => 15 [1] => 30 )

print '<br/>';
//5.3.6 配列に複数要素を追加/置換/削除する array_splice関数
$data = ['高江','青木','片渕','和田','花田','佐藤'];
print_r(array_splice($data, 2, 3, ['日尾','掛谷','薄井']));//結果 Array ( [0] => 片渕 [1] => 和田 [2] => 花田 )
print '<br/>';
print_r($data);//結果 Array ( [0] => 高江 [1] => 青木 [2] => 日尾 [3] => 掛谷 [4] => 薄井 [5] => 佐藤 )
print '<br/>';
print_r(array_splice($data, -3, -2, ['長田','杉谷']));//結果 Array ( [0] => 掛谷 )
print '<br/>';
print_r($data);//結果 Array ( [0] => 高江 [1] => 青木 [2] => 日尾 [3] => 長田 [4] => 杉谷 [5] => 薄井 [6] => 佐藤 )
print '<br/>';
print_r(array_splice($data, 3));//結果 Array ( [0] => 長田 [1] => 杉谷 [2] => 薄井 [3] => 佐藤 )
print '<br/>';
print_r($data);//結果 Array ( [0] => 高江 [1] => 青木 [2] => 日尾 )
print '<br/>';
print_r(array_splice($data, 1, 0, ['山田', '矢吹']));//結果 Array ( )
print '<br/>';
print_r($data);//結果 Array ( [0] => 高江 [1] => 山田 [2] => 矢吹 [3] => 青木 [4] => 日尾 )
print '<br/>';

//5.3.7 配列から特定範囲の要素を取得する array_slice関数
$data = ['高江','青木','片渕','和田','花田','佐藤'];
print_r(array_slice($data, 2, 3));//結果 Array ( [0] => 片渕 [1] => 和田 [2] => 花田 )
print '<br/>';
print_r(array_slice($data, 2, 3, true));//Array ( [2] => 片渕 [3] => 和田 [4] => 花田 )
print '<br/>';
print_r(array_slice($data, 4));//結果 Array ( [0] => 花田 [1] => 佐藤 )
print '<br/>';
print_r(array_slice($data, -4, -3));//結果 Array ( [0] => 片渕 )
print '<br/>';

//5.3.8 配列の内容を検索する array_search関数
$data = ['PHP','JavaScript','PHP','Java','C#','15'];
$data2 = ['X' => 10, 'Y' => 20, 'Z' => 30];
var_dump(array_search('JavaScript', $data));//結果 int(1)
print '<br/>';
var_dump(array_search('PHP', $data));//結果 int(0)
print '<br/>';
var_dump(array_search('JAVA', $data));//結果 bool(false)
print '<br/>';
var_dump(array_search(15, $data));//結果 int(5)
print '<br/>';
var_dump(array_search(15, $data, true));//結果 bool(false)
print '<br/>';
var_dump(array_search(10, $data2));//結果 string(1) "X"
print '<br/>';

//5.3.9 配列に特定の要素が存在するか確認する in_array関数
$data = ['PHP','JavaScript','PHP','Java','C#','15'];
if(!array_search('PHP',$data)){
    print '見つかりませんでした';//結果 見つかりませんでした
}
/*
このコードの結果は、（目的の要素が存在するにもかかわらず）「見つかりませんでした」となります。これは戻り値の0が暗黙的にfalseとみなされるために生じる現象です。
この問題を回避するために、array_search関数の戻り値は「===」演算子で判定すべきである。
*/
if(array_search('PHP',$data)===false){
    print '見つかりませんでした';//結果 何も表示されない
}
/*
しかし真偽値を「===」演算子で判定するようなコードは冗長なので、できれば避けたい。
単に、特定の要素の有無を判定したいならば、専用のin_array関数を利用するのが望ましい。
*/
if(!in_array('PHP', $data)){
    print '見つかりませんでした';//結果 何も表示されない
}