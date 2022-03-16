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
print '<br/>';
//6.2.3 静的変数 static命令
/*
ローカル変数の有効範囲は関数の中だけです。関数の処理が終了するタイミングでローカル変数は破棄されています。
したがって、下記のような関数はほとんど意味がありません。
*/
function checkStatic():int{
    $x = 0;
    return ++$x;
}
print checkStatic();//結果 1
print checkStatic();//結果 1

print '<br/>';
//関数の終了後もローカル変数を維持しておくにはどうすればいいか?
function checkStatic_2():int{
    static $x = 0;
    return ++$x;
}
print checkStatic_2();//結果 1
print checkStatic_2();//結果 2
/*
静的変数は、関数の初回呼び出し時にのみ初期化され、その後、関数の処理が終了しても維持されます。
checkStatic関数を繰り返し呼び出すと、確かに、ローカル変数$xがインクリメントされていることが確認できます。
*/

print '<br/>';
//6.2.4 インクルードファイルのスコープ
//インクルードファイルを、それぞれ関数の外から読み込むサンプル
// require_once 'scope_require.php';
// print $scope;//結果 アクセスできました。

//インクルードファイルを、それぞれ関数の中から読み込むサンプル
function checkScope_4():string {
    require_once 'scope_require.php';
    return $scope_2;
}
print checkScope_4();//結果 $scope_2アクセスできました。
print $scope_2;//結果 警告 + 表示されない

print '<br/>';
//6.2.5 unset関数の挙動
/*
unset関数を利用することで変数を破棄できます。
しかし、globalキーワードで定義された変数や、静的変数（static変数）を破棄する場合には、その挙動に注意が必要です。
*/
$x = 10;
function checkScope_5():int{
    global $x;
    unset($x);
    return ++$x;
}
print checkScope_5();//結果 1
print $x;//結果 10
/*
一見してグローバル変数を破棄するように見えますが、あくまで破棄されるのは「グローバル変数のようにふるまうローカル変数」だけです。
関数外部のグローバル変数には影響しません。
*/

print '<br/>';
//関数の中でグローバル変数を破棄したい場合
function checkScope_5_2():int{
    global $x;
    unset($GLOBALs['x']);
    return ++$x;
}

//staticキーワード
/*
静的変数を破棄した場合、その関数での以降の処理でのみ変数を破棄します
*/
function checkStatic_5():void{
    static $x_static = 0;
    $x_static++;
    print "unset前:{$x_static}";
    unset($x_static);
    $x_static = 13;
    print "unset後:{$x_static}";
}
checkStatic_5();//結果 unset前:1 unset後:13
checkStatic_5();//結果 unset前:2 unset後:13