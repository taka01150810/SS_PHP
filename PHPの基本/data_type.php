<?php
//2.5 型の相互変換
//2.5.1 暗黙的な変換
/*
PHPでは、そのときどきの状況に応じて値を適切なデータ型へ変換することで、
「それぞれの文脈に応じてできるだけなんらかの処理をしよう」とします。
これを型の暗黙的な変換と言います。
*/

//2.5.2 明示的な変換
/*
厳密な比較や演算をしたい場合、暗黙的な変換に頼るのは必ずしも好ましくありません。
そのような場合には、キャストという仕組みを利用することで、値を特定の型に強制的に変換できます。
具体的にはvar_dumpは、変数（値）の情報を出力する関数です。
print_r関数に似ていますが、データ型も加味した情報を出力してくれるので、型も含めて値を確認したい場合に便利です。
*/
/*
浮動小数点数リテラルを整数型にキャストする例です。
この場合、値は（四捨五入ではなく）ゼロの方向に丸められます。
*/
var_dump((int)1530.95);//結果 int(1530)
var_dump((int)-1530.95);//結果 int(-1530)

print '<br/>';
/*
論理リテラルを数値や文字列にキャストしています。
この場合、trueは1に変換され、falseは0または空文字列に変換されます。
*/
var_dump((int)true);//結果 int(1)
var_dump((string)true);//結果 string(1) "1"
var_dump((int)false);//結果 int(0)

print '<br/>';
/*
スカラー型から配列型への変換です。
この場合、数値／文字列／論理型のいずれであっても、要素を1つだけ持つ配列ができあがります。
*/
var_dump((array)108);//結果 array(1) { [0]=> int(108) }

print '<br/>';
/*
数値を文字列に変換する特殊な方法として、変数をダブルクォートでくくる方法がある。
*/
$x=1;
var_dump("$x");//結果：string(1)"1"
?>