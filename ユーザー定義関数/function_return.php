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

print '<br/>';
//6.4.3 可変関数
/*
可変関数とは、「$変数名()」の形式で呼び出せる関数のことです。
これによって、変数名に応じて対応する関数を検索＆実行できます。
*/
function getTriangleArea(float$base,float$height):float{
    return $base * $height / 2;
}
$name = 'getTriangleArea';
$area = $name(8,10);
print"三角形の面積は{$area}です。";//結果：三角形の面積は40です。

print '<br/>';
//高階関数の実装
/*
高階関数とは、関数そのものを引数として渡したり、あるいは戻り値として返したりするための関数です。
*/
//高階関数myArrayWalkを定義
function myArrayWalk(array $array,callable $func):void{
    //配列$arrayの内容を順に処理
    foreach($array as $key => $value){
        $func($value,$key);//$funcで指定された関数を呼び出し
    }
}
//配列を処理するためのユーザー定義関数
function showItem(mixed $value,int|string $key):void{
    print "{$key}:{$value}<br/>";
}
$data = ['杉山','長田','杉沼','和田','土井'];
myArrayWalk($data,'showItem');//結果 0:杉山 1:長田 2:杉沼 3:和田 4:土井
/*
可変関数の機能を利用することで、このように引数を経由して実行する関数を決めることができる。
*/

//myArrayWalk関数を使って、配列に含まれる値の合計値を求める
function myArrayWalk_1(array $array,callable $func):void{
    //配列$arrayの内容を順に処理
    foreach($array as $key => $value){
        $func($value,$key);//$funcで指定された関数を呼び出し
    }
}
$result = 0;
function total(float $value, int $key){
    global $result;
    $result += $value; 
}
$data = [100, 50, 10, 5];
myArrayWalk_1($data, 'total');
print "合計値:{$result}";//結果 合計値:165

print '<br/>';
//6.4.4 無名関数(クロージャー)
/*
高階関数に渡すことを目的としたこれらの関数は、多くの場合、その場限りでしか利用しません。
そのような（いわゆる）使い捨ての関数のために名前を付けるのは無駄なので、できればなくしてしまいたいところです。
そこで登場するのが、無名関数（匿名関数）という名前を持たない関数です。クロージャーとも呼ばれます。
名前は不要で、特定の機能だけを定義したいという場合には、無名関数を利用することでスクリプトがより読みやすくなります。
*/
function myArrayWalk_4(array $array,callable $func):void{
    //配列$arrayの内容を順に処理
    foreach($array as $key => $value){
        $func($value,$key);//$funcで指定された関数を呼び出し
    }
}
//上記を無名関数に書き換えると
$data = ['杉山','長田','杉沼','和田','土井'];
myArrayWalk_4($data,
    function($value,$key){
        print"{$key}:{$value}<br/>";
    }
);//結果 0:杉山 1:長田 2:杉沼 3:和田 4:土井