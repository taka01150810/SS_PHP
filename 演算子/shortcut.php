<?php

/*
論理演算子は、複数の条件式（または真偽値）を論理的に結合し、その結果をtrue／falseとして返します
*/

$x = true;
$y = false;
var_dump($x && $y);//結果 bool(false)
var_dump($x and $y);//結果 bool(false)
var_dump($x || $y);//結果 bool(true)
var_dump($x or $y);//結果 bool(true)
var_dump($x xor $y);//結果 bool(true) //左右の式いずれかがtrueで、かつ、双方ともtrueではない場合にtrue
var_dump(!$x);//結果 bool(false)

print '<br/>';
//3.4.1 ショートカット演算(短絡演算)
/*
論理演算子では、「ある条件の下では、左式だけが評価されて右式が評価されない」場合があります。
このような演算のことをショートカット演算あるいは短絡演算と言います。
①と②は同じ意味(条件式「$x===2」がfalseである（$xが2でない）場合にのみ、右式のprint命令が実行されます。)である。
*/
$x = 1;
if( $x !== 2 ){
    print'実行されました。';
}//結果：実行されました。───❶

print '<br/>';
$x === 2 or print '実行されました。';//結果：実行されました。───❷