<?php
//6.3 引数の様々な記法

//6.3.1 引数の既定値
function getTriangleArea(float $base = 5, float $height = 1):float {
    return $base * $height / 2;
}
$area = getTriangleArea();
print "三角形の面積は{$area}です。<br/>";//結果 三角形の面積は2.5です。
$area = getTriangleArea(10);
print "三角形の面積は{$area}です。<br/>";//結果 三角形の面積は5です。
$area = getTriangleArea(10, 5);
print "三角形の面積は{$area}です。<br/>";//結果 三角形の面積は25です。
/*
既定値とは、その引数を省略した場合に既定で設定される値のことです。既定値を持つ引数は、すなわち「省略可能である」と考えてもよいでしょう
*/

//既定値を設定した引数の後ろに必須の引数を置いてはいけない
/*
function getTriangleArea_1( float $base=5, float $height):float{
    return $base * $height/2;
}
$area = getTriangleArea(10); //結果 エラー
*/

//6.3.2 引数の参照渡し
//引数は値渡しされるのが基本
function increment(int $num):int {
    $num++;
    return $num;
}
$value = 10;
print increment($value);//結果 11
print $value;//結果 10

//引数の参照渡し
function increment_1(int &$num):int {
    $num++;
    return $num;
}
$value = 10;
print increment_1($value);//結果 11
print $value;//結果 11

print '<br/>';
//6.3.3名前付き引数
/*
名前付き引数とは、次のように呼び出し時に名前を明示的に指定できる引数のことです。
*/
function getTriangleArea_3(float $base = 5, float $height = 1):float {
    return $base * $height / 2;
}
$area = getTriangleArea_3(height: 10);//前方の引数だけを省略
print "三角形の面積は{$area}です。<br/>";//結果 三角形の面積は25です。
$area = getTriangleArea_3(height: 10, base: 50);//引数の順番を入れ替えた
print "三角形の面積は{$area}です。<br/>";//結果 三角形の面積は250です。
/*
名前付き引数を利用することで、以下のようなメリットがあります。
1.引数が多くなっても、意味を把握しやすい
2.必要な引数だけをスマートに表現できる（順番にかかわらず、どれを省略してもよい）
3.引数の順序を自由に変更できる
*/

//6.3.4 可変長引数の関数
/*
可変長引数の関数とは、引数の個数があらかじめ決まっていない関数のことです。
これらの関数では、呼び出し元が引数の数を自由に決められるのでした。
定義時に引数の数を決められない関数、と言ってもよいかもしれません。
可変長引数の関数では、仮引数の直前に「...」（ピリオド3個）を付与します。これによって、渡された任意個数の引数を配列としてまとめて取得できます。
*/
function total(float ...$args): float {
    $result = 0;
    foreach($args as $arg){
        $result += $arg;
    }
    return $result;
}
print total(7, -3, 10);//結果 14
print total(11, -5, 4, 88);//結果 98

//6.3.5 可変長引数と通常の引数の混在
function replaceContents(string $path,string... $args):string{
    //指定されたパスからファイルを読み込み
    $data = file_get_contents($path);//可変長引数を順番に処理し、{0}、{1}、……と置き換え
    for($i = 0;$i < count($args); $i++){
        $data = str_replace('{'.($i).'}',$args[$i],$data);
    }
    return $data;
}//data.dat（リスト6.27）を読み込み＆出力
print replaceContents('data.dat','鈴木太郎','2021年5月1日');
/* 結果
WINGSニュース2021年5月1日号をお届けします。
本日は、鈴木太郎様にお勧めの書籍を紹介致します。
*/

/*
可変長引数と、通常の引数を同居させる場合、注意すべき点は
可変長関数は引数リストの末尾に置かなければならないということです。
さもないと、すべての引数が可変長引数に吸収されてしまう。
*/