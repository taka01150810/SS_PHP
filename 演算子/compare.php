<?php
//3.3.1 文字列混在の比較
/*
等価演算子「==」は、数値と文字列を比較するときに、文字列を数値に変換した上で比較しようとします。
また、文字列同士の比較であっても、数値形式の文字列である場合には、同じく数値に変換したものを比較しようとします。
*/
var_dump('3.14' == 3.14000);//結果 bool(true)
var_dump('3.14E2' == 314);//結果 bool(true)
var_dump('0x10' == 16);//結果 bool(false)
var_dump('010' == 8);//結果 bool(false)
var_dump('13xyz' == 13);//結果 bool(true)
var_dump('X' == 0);//結果 bool(true)
var_dump('3.14' == '3.14000');//結果 bool(true)
var_dump('3.14E2' == '314');//結果 bool(true)
var_dump('13xyz' == '13');//結果 bool(false)

print '<br/>';
//3.3.2 厳格な等価演算子( === )
/*
「===」演算子は「厳密な等価演算子」とも呼ばれ、値を比較する際に値とデータ型が厳密に一致するかどうかを判定します。
*/
var_dump('3.14E2' === 314);//結果 bool(false)
var_dump('X' === 0);//結果 bool(false)
var_dump('1' === 1);//結果 bool(false)

//3.3.3 浮動小数点の比較
/*
定数EPSILONは、誤差の許容範囲を表します（❶）。計算機イプシロン、丸め単位などとも呼ばれます。
浮動小数点数同士の差を求め（absは絶対値を求める関数です）、その値がイプシロン未満であれば、保証した桁数までは等しいということになる。
*/
const EPSILON = 0.000001;
$x = 0.123456;
$y = 0.123455;

var_dump(abs($x - $y) < EPSILON );//結果 bool(true)

print '<br/>';
//3.3.4 配列の比較
/*
配列の比較は、次の順序で行われます（図3.8）。
1．要素数で比較（要素数の少ない配列がより小さい）
2．要素数が等しい場合、同じキーを持つ要素同士で値の大小を比較（より大きい要素／より小さい要素が見つかったところで判定を終了）
3．1.、2.の比較がすべて等しい場合、両者は等しいとみなされる。
*/
$data01 = [1, 2, 3];
$data02 = [1, 5];
var_dump($data01 < $data02);//結果 bool(false)

$data11 = [1, 2, 3];
$data12 = [1, 5, 1];
var_dump($data11 < $data12);//結果 bool(true)

$data21 = [1, 2, 3];
$data22 = [1, 2, '3'];
var_dump($data21 == $data22);//結果 bool(true)
var_dump($data21 === $data22);//結果 bool(false)

$data31 = ['A' => 'a', 'B' => 'b', 'C' => 'c'];
$data32 = ['A' => 'a', 'C' => 'c', 'B' => 'b'];
var_dump($data31 == $data32);//結果 bool(true)
var_dump($data31 === $data32);//結果 bool(true)

print '<br/>';
//3.3.5 条件演算子
/*
条件演算子は、指定された条件式の真偽に応じて、対応する式の値を出力します。
*/
$score = 75;
print $score >= 70 ? '合格' : '不合格';//結果 合格

//条件演算子の省略構文
//(1)式1 ?: 式2
// 式1がtrueに変換できる場合には式1を、そうでない場合には式2を返します
$message = '';
print $message ?: '空です';//結果 空です。

//(2)式1 ?? 式2
//式1がnullでない（値が設定されている）場合には式1を、さもなければ式2を返します。
print $message_2 ?? 'ノーコメント';//結果 ノーコメント

//非省略構文で書き換えた場合
print isset($message_2) ? $message_2 : 'ノーコメント';//結果 ノーコメント
//isset関数は、与えられた変数に値がセットされているか（＝nullでないか）を判定します。

//条件演算子を列記する場合の注意
/*
コードを読む人に誤解を与えないという意味で、条件演算子を複数列記する場合には、常にカッコでくくるべきである。
*/
print (true ? 1 : false) ? 'OK' : 'NG';//結果 OK
print true ? 1 : (false ? 'OK' : 'NG');//結果 1