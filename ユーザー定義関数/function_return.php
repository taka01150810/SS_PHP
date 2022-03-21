<?php
//6.4 関数の呼び出しと戻り値
//6.4.1 複数の戻り値
/*
関数から複数の値を返したいというケースがあるかもしれません。しかし、return命令で「return1,2;」のように複数の値を返すことはできません。
この場合は、配列やオブジェクト（後述）として値を1つにまとめた上で戻り値を返す必要があります。
*/
function max_min(float...$args):array{
    return [max($args), min($args)];//最大値、最小値の順で配列を生成
}

$result = max_min(10, -2, -5, 3, 78);
print_r($result);//結果 Array ( [0] => 78 [1] => -5 )
[$max, $min] = max_min(10, 2, -5, 3, 78);
print "最大値:{$max}, 最小値:{$min}";//結果 最大値:78, 最小値:-5

print '<br/>';
//6.4.2 再帰関数
/*
再帰関数（RecursiveFunction）とは、ある関数が自分自身を呼び出すこと、または、そのような関数のことです。
再帰関数を利用することで、（たとえば）階乗計算のように同種の手続きを繰り返し呼び出すような処理を、短いコードで表現できます。
階乗とは、自然数nに対する1～nの総積のことです（数学的には「n!」と表記します）
*/
function factorial(int $num):int{
    if($num !== 0){
        return $num * factorial($num - 1);
    }
    return 1;
 }
print factorial(5);//結果：120