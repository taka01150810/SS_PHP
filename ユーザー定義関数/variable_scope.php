<?php
/*
スコープとは、スクリプトの中での変数の有効範囲のことです。
PHPのスコープは、スクリプト全体から参照できるグローバルスコープと、定義された関数の中でのみ参照できるローカルスコープとに分類できます。
*/

//6.2.1 グローバル変数とローカル変数
/*
グローバルスコープを持つ変数のことをグローバル変数、ローカルスコープを持つ変数のことをローカル変数と言います。
変数がグローバル変数／ローカル変数のいずれであるかは、基本的に変数を定義している場所による、と考えておけばよいでしょう。
*/
$x = 10;
function checkScope():int{
    return ++$x;
}
print checkScope();//結果 1
print $x;//結果：10
/*
グローバル変数とローカル変数、スコープの異なる変数は、名前が同一であっても違う変数とみなされる。
*/

print '<br/>';
//6.2.2 関数内でグローバル変数を利用する global変数
$x = 10;
function checkScope_2():int{
    global $x;
    return ++$x;
}
print checkScope_2();//結果 11
print $x;//結果 11
/*
これによって、関数内の$xがグローバル変数とみなされます。
*/