<?php
//2.4.1 配列の基本
/* 
スカラー型の変数が値を1つしか扱えないのに対して、配列には複数の値を収めることができます。
配列は、仕切りのある入れ物だと考えてもよいでしょう。
配列はスカラー型に対して複合型と呼ばれる。
*/
$data = ['山田','掛谷','日尾','本多','矢吹'];
print $data[3];//結果：本多

print '<br/>';
//ブランケット構文を利用することで配列の個々の要素に値を設定することもできる。
$data[0] = '山田';
$data[1] = '掛谷';
$data[2] = '日尾';
$data[3] = '本多';//配列$dataを新規作成
$data[1] = '臼井';//一番目の要素書き換え
$data[] = '矢吹';//末尾に要素を追加
print $data[4];//結果 矢吹

print '<br/>';
//2.4.2 配列の内容を確認する
/*
作成した配列の内容を手っ取り早く確認したい場合には、print_r関数を利用すると便利。
print_r関数は配列をはじめ、後述するオブジェクトなどの複合型の変数を見やすい形で出力する。
*/
print_r($data);//結果 Array ( [0] => 山田 [1] => 臼井 [2] => 日尾 [3] => 本多 [4] => 矢吹 [5] => 矢吹 )

//2.4.3 連想配列の基本
/*
値を参照するのに使えるのが数字だけでは不便。
そこで連想配列を使うことによって文字列キーを使って要素を管理する。
*/
print '<br/>';
//通常の配列
$names = ['山田太郎','掛谷翔太','日尾有宏','本多のぞみ','矢吹久美子'];
$addresses = ['千葉県府中市東町111','広島県福岡市北町222','群馬県三次市南町333','埼玉県豊田市西町444','愛知県岡山市本町555'];

//連想配列
//連想配列では「キー名=>値」の形式でキーと値との対応関係を表している。記号「=>」は、キー名を値に対応させなさい、という意味です。
$members = [
    '山田太郎' =>'千葉県府中市東町111',
    '掛谷翔太' =>'広島県福岡市北町222',
    '日尾有宏' =>'群馬県三次市南町333',
    '本多のぞみ' => '埼玉県豊田市西町444',
    '矢吹久美子' =>'愛知県岡山市本町555'
];
print $members['山田太郎'];//結果 千葉県府中市東町111

print '<br/>';
//多次元配列
$dimension1 = [
    ['X1','X2','X3'],
    ['Y1','Y2','Y3'],
    ['Z1','Z2','Z3'],
];

print $dimension1[1][0];//結果：Y1

print '<br/>';
//配列の中に連想配列を含めることもできる
$dimension2=[
    ['name'=>'山田太郎','age'=>35,'sex'=>'男',],
    ['name'=>'鈴木二郎','age'=>30,'sex'=>'男',],
    ['name'=>'佐藤花子','age'=>25,'sex'=>'女',],
];
print $dimension2[1]['name'];//結果：鈴木二郎