<?php
//3.6 その他の演算子
//3.6.1 文字列演算子
/*
文字列演算子（.）は、左式／右式の文字列を連結します
*/
$x = 'こんにちは';
$y = '世界 ! ';
print $x.$y;//結果 こんにちは世界 !

print '<br/>';
$x = 0xFF;
$y = 1.5E2;
print $x.$y;//結果 255150
/*
結果が「0xFF1.5E2」でない理由は16進数表現や指数表現も、文字列化されるときには
標準的な10進数／小数表現となるからである。（ここではそれぞれ255と150）。
もし「0xFF1.5E2」のような結果を得たいなら、次のように最初から文字列リテラルとして値を指定する必要がある。
*/
print '<br/>';
$x_1 = '0xFF';
$y_1 = '1.5E2';
print $x_1.$y_1;//結果 0xFF1.5E2

print '<br/>';
//3.6.2 実行演算子
/*
実行演算子（`）は、バッククォートで囲んだブロックを、シェルコマンドとして実行します。
*/
$result = `ls`;//ls コマンドを実行
print $result;//結果 compare.php operator.php other_operator.php ref.php shortcut.php

print '<br/>';
//3.6.3 エラー制御演算子
/*
エラー制御演算子（@）は特定の式の先頭に付加することで、その命令で発生したエラーメッセージを抑制します（表示しないようにします）。
エラー制御演算子（@）はできるだけ使うべきではありません。
なぜなら、@演算子によってエラーが隠蔽されてしまうので、コードに問題があった場合に原因の特定が困難になるからです。
*/
$data = ['apple'=>'りんご'];
print $data['orange'];//結果：Notice: Undefined index: orange in /Applications/MAMP/htdocs/独習PHP/演算子/other_operator.php on line 36
print @$data['orange'];//結果：（表示されない）