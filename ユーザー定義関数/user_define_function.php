<?php
/*
標準的な関数ではカバーされていないような、定型的な処理については、アプリ開発者が自分で定義することもできます。このような関数をユーザー定義関数と言います。
*/

//6.1.1 ユーザー定義関数とは?
$base = 8;
$height = 10;
$area = $base * $height / 2;
print "三角形の面積は{$area}です。";//結果：三角形の面積は40です。

//三角形の面積をコード内の複数の場所で求めたくなった場合、面倒だし、冗長。
//ユーザー定義関数とは、まさに重複したコードを一箇所にまとめるための仕組みである
function getTriangleArea($base, $height){
    return $base * $height / 2;
}
$area = getTriangleArea(8, 10);
print "三角形の面積は{$area}です。";

print '<br/>';
//6.1.2 関数名
/*
識別子の命名規則に従うのは、変数の場合と同じgetTriangleArea、updateInfoのようなcamelCase記法で表します。
具体的には、addElementのように「動詞＋名詞」の形式で命名することをお勧めします。
checkUpdateDataのような、複数動詞の連結も一般的には避けるべきです。
*/

//6.1.3 仮引数と実引数
/*
引数とは、メソッドの中で参照可能な変数のことです。関数を呼び出す際に、呼び出し側からメソッドに値を引き渡すために利用します。
より細かく、呼び出し元から渡される値のことを実引数、受け取り側の変数のことを仮引数と区別して呼ぶ場合もあります。
*/

/*
                         ↓仮引数  ↓仮引数
function getTriangleArea($base, $height){
    return $base * $height / 2;
}
                          ↓実引数
$area = getTriangleArea(8, 10);
print "三角形の面積は{$area}です。";
*/

//6.1.4 戻り値
/*
引数（仮引数）が関数の入り口であるとするならば、戻り値（返り値）は関数の出口──関数が処理した結果を表します。
return命令によって表します。
*/
/*
戻り値がない（＝呼び出し元に値を返さない）関数では、return命令は省略してもかまいません。
その場合も、関数は（なにも返さないわけではなく）nullという空値を返したとみなされます。
*/
function showMessage($name){
    print"こんにちは、{$name}さん！";//結果：こんにちは、山田さん！
}
var_dump(showMessage('山田'));//結果：NULL（returnがないので、戻り値はなし）

//return命令は、関数の処理を中断する場合にも利用できます。その場合は、ただ「return」とすることで、戻り値を返さず、ただ処理を終了しなさいという意味になります
function getTriangleArea_1($base,$height){//引数$base／$heightが0以下の場合は、関数を終了
    if($base <= 0||$height <= 0){
        return;
    }
    return $base * $height/2;
}

print '<br/>';
//6.1.5 引数/戻り値の型宣言
/*
関数の引数／戻り値には、明示的に型を指定することもできます。これを型宣言と言います。
型宣言を利用することで、関数に不正な型が渡されるのを未然に防げます。
*/
function getTriangleArea_5(float $base, float $height){//float = 浮動小数点数
    return $base * $height / 2;
}
$area_1 = getTriangleArea_5(8, 10);
print "三角形の面積は{$area_1}です。";//結果 三角形の面積は40です。
$area_2 = getTriangleArea_5(8,'10');//結果：40
print "三角形の面積は{$area_2}です。";//結果 三角形の面積は40です。
/*
$area_3 = getTriangleArea_5(8,'x');//結果：40
print "三角形の面積は{$area_3}です。";//結果  エラー
*/