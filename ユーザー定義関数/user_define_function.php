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
print '<br/>';
//6.1.6 複合的な型宣言
//null許容型
/*
型名の先頭に「?」を付与することで、nullを許容する型を表現できる
*/
function hoge(?int $value) : void {
    var_dump($value);
}
hoge(100);//結果 int(100)
hoge(null);//結果 NULL
// hoge();//結果 エラー

print '<br/>';
//Union型
/*
PHP8以降であれば、「|」区切りで「int|bool」（int、boolいずれか）のような型を表すことも可能です。このような型をUnion型と呼びます。
PHP8ではmixed型（なんでもあり）も利用できるようにはなっていますが、安易にmixed型に頼るのではなく（その場合、型宣言をそもそも利用しなければよいからです）
まずはUnion型で取りうる（返しうる）型の候補を列挙することをお勧めします。
*/
function getTriangleArea_6(string|float $base, string|float $height):float{
    return $base * $height / 2;
}
$area_1 = getTriangleArea_6(8, 10);
print "三角形の面積は{$area_1}です。";//結果 三角形の面積は40です。
/*
以下のような重複はエラーです。
● 名前の重複（int|bool|INTなど）
● object型とクラス型（6.1.5項）の重複（object|Personなど）
● iterable型とarray／Traversableの重複
● bool型とfalse擬似型（後述）の重複
*/

//false擬似型
/*
false擬似型は、Union型でのみ利用できる型で、「int|false」のように表します。
たとえばmb_strpos関数は、指定の文字列が見つかった位置をint値で、見つからなかった場合にはfalseを返します。
*/
// function mb_strpos(string $haystack, string $needle, int $offset = 0, string $encoding = mb_internal_encoding()):int|false{

// }

//void型の戻り値
/*
void（なにも返さない）は、戻り値としてのみ利用できる型です。
「なにも返さない」なので、たとえばnullであっても値を返すのは不可です。
*/
// function hoge():void{
//     return null;
// }
//結果 エラー

print '<br/>';
//6.1.7 スクリプトの外部化
/*
外部ファイル（.phpファイル）を現在のスクリプトにインクルードするには、require、include、require_once、include_once命令を利用します。
require命令とinclude命令との違いは、指定したファイルが見つからなかった場合の挙動にあります。
require命令はFatalError（致命的なエラー）を発生させ、その場でスクリプトを中断しますが、
include命令はWarning（警告）を発するだけで、スクリプトの処理は継続されます。
require_once／include_once命令は、require／include命令の「一度きり」版です。
指定されたファイルがすでに読み込み済みである場合、require_once／include_once命令はスクリプトを読み込まず、処理をスキップします。
意図的に同じファイルを読み込みたいという場合を除き、できるだけrequire_once／include_once命令を利用してください。
そうすることで、循環呼び出しのような不具合を未然に防ぐことができます。
循環呼び出しとは、呼び出し元と呼び出し先とで互いをインクルードし合うことを言います。
*/
require_once 'user_define_function.php';
$area = getTriangleArea(8, 10);
print "三角形の面積は{$area}です。";

/* 外部ファイルは絶対パスを利用する
require／include系の命令を利用する際に、原則、相対パスの利用は避けるべきです。

(例)my_app/main.php(require_once('./lib/func1.php'))
my_app/lib/func1.php(require_once('./func2.php'))
my_app/lib/func1.php
main.php（起動スクリプト）→func1.php→func2.phpのように呼び出すことを想定しています。
しかし、func1.phpのrequire_once命令で「Failed opening required'./func2.php'」のようなエラーとなります。
一見すると正しいパスのようですが、相対パスは起動スクリプトが基点となるというルールがあるのが理由です。

よって、func1.phpのrequire呼び出しは/my_app/func2.phpを探しに行ってしまうのです。
なので避けるために
my_app/lib/func1.php(require_once('./lib/func2.php'))
のように書き換えることも可能であるが、、unc1.phpをたとえば/my_app/sub/app.phpのような異なる起動スクリプトから呼び出した場合には、
同じく呼び出しに失敗してします。
そこで一般的には、require／include命令は、絶対パスで指定することをお勧めします。
require_once __DIR__.'/func2.php';
*/