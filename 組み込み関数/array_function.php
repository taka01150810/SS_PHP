<?php
/* 5.3 配列関数
配列関数は、配列に対して要素を追加／削除したり、配列要素を並べ替えたりと、配列に対する操作全般を担う関数です。
*/

//5.3.1 配列の要素数を取得する count関数
$data = ['山田','掛谷','日尾','本多','矢吹'];
print count($data);//結果：5

print '<br/>';
$data = [
    ['X1','X2','X3'],
    ['Y1','Y2','Y3'],
    ['Z1','Z2','Z3']
];
print count($data);//結果 3

print '<br/>';
//入れ子になった配列までカウントしたい場合
print count($data, COUNT_RECURSIVE);//結果:12

print '<br/>';
//要素の登場回数をカウントする
/*
array_count_values関数の戻り値は、「要素値=>登場回数」形式の連想配列です。
ただし、カウントできるのは文字列／数値のみです。
*/
$data=['い','ろ','は','に','ほ','へ','と','い','ろ'];
print_r(array_count_values($data));//結果 Array ( [い] => 2 [ろ] => 2 [は] => 1 [に] => 1 [ほ] => 1 [へ] => 1 [と] => 1 )

print '<br/>';
//5.3.2 配列の内容を連結する array_merge関数
$ary1 = [1,3,5];
$ary2 = [2,3,6];
$result = array_merge($ary1, $ary2);
print_r($result);//結果 Array ( [0] => 1 [1] => 3 [2] => 5 [3] => 2 [4] => 3 [5] => 6 )

print '<br/>';
$assoc1 = ['Apple' => 'Red', 'Orange' => 'Yellow', 'Melon' => 'Green'];
$assoc2 = ['Grape' => 'Purple', 'Apple' => 'Green', 'Strawberry' => 'Red'];
$result = array_merge($assoc1, $assoc2);
print_r($result);//結果 Array ( [Apple] => Green [Orange] => Yellow [Melon] => Green [Grape] => Purple [Strawberry] => Red )

print '<br/>';
//結果 配列のキーが重複した場合は（上書きするのではなく）入れ子の配列を生成するarray_merge_recursive関数を使う
$result = array_merge_recursive($assoc1, $assoc2);
print_r($result);//結果 Array ( [Apple] => Array ( [0] => Red [1] => Green ) [Orange] => Yellow [Melon] => Green [Grape] => Purple [Strawberry] => Red )

print '<br/>';
//5.3.3 配列の各要素を結合する implode関数
$data = ['PHP','Perl','Ruby','Python','JavaScript'];
print implode(',',$data);//結果 PHP,Perl,Ruby,Python,JavaScript

//5.3.4 配列の先頭／末尾に要素を追加／削除する  array_push／array_pop／array_shift／array_unshift関数
$data=['高江','青木','片渕'];
print array_push($data,'山田','土井');//結果：5（要素数）
// array_push = 末尾に追加
print '<br/>';
print_r($data);//結果：Array([0]=>高江[1]=>青木[2]=>片渕[3]=>山田[4]=>土井)
print '<br/>';
print array_pop($data);//結果：土井
// array_pop = 末尾から除去
print '<br/>';
print_r($data);//結果：Array([0]=>高江[1]=>青木[2]=>片渕[3]=>山田)
print '<br/>';
print array_shift($data);//結果：高江
// array_shift = 先頭から除去
print '<br/>';
print_r($data);//結果：Array ( [0] => 青木 [1] => 片渕 [2] => 山田 )
print '<br/>';
print array_unshift($data, '宮中');//結果：4(要素数)
// array_unshift = 先頭に追加
print '<br/>';
print_r($data);//結果：Array ( [0] => 宮中 [1] => 青木 [2] => 片渕 [3] => 山田 )
print '<br/>';
//5.3.5 スタックとキュー
/*
スタック（Stack）は、後入れ先出し（LIFO：LastInFirstOut）または先入れ後出し（FILO：FirstInLastOut）とも呼ばれる構造のことです。
たとえばアプリでよくあるUndo機能では、操作を履歴に保存し、最後に行った操作から順に取り出しますが、このような操作に使われるのがスタックです。
あるいは、キャリアカー（乗用車を運搬するためのトラック）をイメージしてみるとよいかもしれません。
この場合、順番に積み込んだ乗用車は、最後に積み込んだものからしか降ろすことはできません。

このようなスタック構造は、array_push関数（またはブラケット構文）とarray_pop関数によって表現できます。
array_push関数でキャリアカーに車を載せ、array_pop関数で車を降ろすのです。
*/
$data = [];
array_push($data, 10);
array_push($data, 15);
array_push($data, 30);

print_r($data);//結果 Array ( [0] => 10 [1] => 15 [2] => 30 )
print '<br/>';
print(array_pop($data));//結果 30
print '<br/>';
print_r($data);//結果 Array ( [0] => 10 [1] => 15 )

print '<br/>';
/*
キュー（Queue）は、（LIFO／FILOに対して）先入れ先出し（FIFO：FirstInFirstOut）とも呼ばれる構造のことです。
待ち行列と呼ばれることもあります。
イメージとしては、スーパーのレジに並ぶ人を思い浮かべればよいでしょう。この場合、レジに先に並んだ人が最初に精算を終え、出ていくことができます。

このようなキュー構造を表現するには、array_push関数（またはブラケット構文）とarray_shift関数の組み合わせを利用します。
*/
$data = [];
array_push($data, 10);
array_push($data, 15);
array_push($data, 30);

print_r($data);//結果 Array ( [0] => 10 [1] => 15 [2] => 30 )
print '<br/>';
print_r(array_shift($data));//結果 10
print '<br/>';
print_r($data);//結果 Array ( [0] => 15 [1] => 30 )

print '<br/>';
//5.3.6 配列に複数要素を追加/置換/削除する array_splice関数
$data = ['高江','青木','片渕','和田','花田','佐藤'];
print_r(array_splice($data, 2, 3, ['日尾','掛谷','薄井']));//結果 Array ( [0] => 片渕 [1] => 和田 [2] => 花田 )
print '<br/>';
print_r($data);//結果 Array ( [0] => 高江 [1] => 青木 [2] => 日尾 [3] => 掛谷 [4] => 薄井 [5] => 佐藤 )
print '<br/>';
print_r(array_splice($data, -3, -2, ['長田','杉谷']));//結果 Array ( [0] => 掛谷 )
print '<br/>';
print_r($data);//結果 Array ( [0] => 高江 [1] => 青木 [2] => 日尾 [3] => 長田 [4] => 杉谷 [5] => 薄井 [6] => 佐藤 )
print '<br/>';
print_r(array_splice($data, 3));//結果 Array ( [0] => 長田 [1] => 杉谷 [2] => 薄井 [3] => 佐藤 )
print '<br/>';
print_r($data);//結果 Array ( [0] => 高江 [1] => 青木 [2] => 日尾 )
print '<br/>';
print_r(array_splice($data, 1, 0, ['山田', '矢吹']));//結果 Array ( )
print '<br/>';
print_r($data);//結果 Array ( [0] => 高江 [1] => 山田 [2] => 矢吹 [3] => 青木 [4] => 日尾 )
print '<br/>';

//5.3.7 配列から特定範囲の要素を取得する array_slice関数
$data = ['高江','青木','片渕','和田','花田','佐藤'];
print_r(array_slice($data, 2, 3));//結果 Array ( [0] => 片渕 [1] => 和田 [2] => 花田 )
print '<br/>';
print_r(array_slice($data, 2, 3, true));//Array ( [2] => 片渕 [3] => 和田 [4] => 花田 )
print '<br/>';
print_r(array_slice($data, 4));//結果 Array ( [0] => 花田 [1] => 佐藤 )
print '<br/>';
print_r(array_slice($data, -4, -3));//結果 Array ( [0] => 片渕 )
print '<br/>';

//5.3.8 配列の内容を検索する array_search関数
$data = ['PHP','JavaScript','PHP','Java','C#','15'];
$data2 = ['X' => 10, 'Y' => 20, 'Z' => 30];
var_dump(array_search('JavaScript', $data));//結果 int(1)
print '<br/>';
var_dump(array_search('PHP', $data));//結果 int(0)
print '<br/>';
var_dump(array_search('JAVA', $data));//結果 bool(false)
print '<br/>';
var_dump(array_search(15, $data));//結果 int(5)
print '<br/>';
var_dump(array_search(15, $data, true));//結果 bool(false)
print '<br/>';
var_dump(array_search(10, $data2));//結果 string(1) "X"
print '<br/>';

//5.3.9 配列に特定の要素が存在するか確認する in_array関数
$data = ['PHP','JavaScript','PHP','Java','C#','15'];
if(!array_search('PHP',$data)){
    print '見つかりませんでした';//結果 見つかりませんでした
}
/*
このコードの結果は、（目的の要素が存在するにもかかわらず）「見つかりませんでした」となります。これは戻り値の0が暗黙的にfalseとみなされるために生じる現象です。
この問題を回避するために、array_search関数の戻り値は「===」演算子で判定すべきである。
*/
if(array_search('PHP',$data)===false){
    print '見つかりませんでした';//結果 何も表示されない
}
/*
しかし真偽値を「===」演算子で判定するようなコードは冗長なので、できれば避けたい。
単に、特定の要素の有無を判定したいならば、専用のin_array関数を利用するのが望ましい。
*/
if(!in_array('PHP', $data)){
    print '見つかりませんでした';//結果 何も表示されない
}

print '<br/>';
//5.3.10 配列の内容を並び替える sort関数
$data = ['Tennis','Swimming','Soccer','Baseball'];
sort($data, SORT_STRING);
print_r($data);//結果 Array ( [0] => Baseball [1] => Soccer [2] => Swimming [3] => Tennis )
print '<br/>';
rsort($data, SORT_STRING);
print_r($data);//結果 Array ( [0] => Tennis [1] => Swimming [2] => Soccer [3] => Baseball )
print '<br/>';

$data2 = ['Tennis'=> 1,'Swimming'=> 2,'Soccer' => 3,'Baseball' => 4];
sort($data, SORT_NUMERIC);
print_r($data2);//結果 Array ( [Tennis] => 1 [Swimming] => 2 [Soccer] => 3 [Baseball] => 4 )
print '<br/>';

$data3 = ['Tennis'=> 1,'Swimming'=> 1,'Soccer' => 11,'Baseball' => 9];
asort($data3, SORT_NUMERIC);
print_r($data3);//結果 Array ( [Tennis] => 1 [Swimming] => 1 [Baseball] => 9 [Soccer] => 11 )
print '<br/>';
ksort($data3, SORT_STRING);
print_r($data3);//結果 Array ( [Baseball] => 9 [Soccer] => 11 [Swimming] => 1 [Tennis] => 1 )

print '<br/>';
//より人間的なソートの「自然順ソート」
/*
自然順ソートとは、文字列と数値混在の値を、より人間が行うのに近い手法で並べ替える手法である
*/
$data=['img15.png','img5.png','img2.png','img18.png','img3.png'];
sort($data,SORT_STRING);
print_r($data);//結果：Array ( [0] => img15.png [1] => img18.png [2] => img2.png [3] => img3.png [4] => img5.png )

print '<br/>';
/*
SORT_STRINGでは辞書順にソートされるので、15、18は2よりも小さいとみなされます。
しかし、一般的には2、3、5、15、18の順にソートしたいはずです。
これには、太字部分をSORT_NATURAL（自然順）としてください。
*/
sort($data,SORT_NATURAL);
print_r($data);//結果 Array ( [0] => img2.png [1] => img3.png [2] => img5.png [3] => img15.png [4] => img18.png )

print '<br/>';
//5.3.11 自作のルールで配列を並び替える usort関数
/*
usort関数を利用することで、標準的なソート関数では表現できない順序に基づいてソートできます。
特別な順序とは、たとえば干支や役職、曜日など、意味的に順序を持った対象のことを言います。
下記は、数値の単位に基づいて、昇順に並べ替える例です。
*/
//単位を昇順に準備
$keys_usort = ['十','百','千','万','億','兆','京','垓','穣','溝','澗','正','載','極','恒河沙','阿僧祇','那由他','不可思議','無量大数'];
//ソート対象の配列
$data_usort = ['那由他','京','垓','億','無量大数'];
//指定された単位で配列$dataをソート
usort($data_usort, function( $a, $b) use($keys_usort){
    return array_search($a,$keys_usort) <=> array_search($b,$keys_usort);
});
print_r($data_usort);//結果 Array ( [0] => 億 [1] => 京 [2] => 垓 [3] => 那由他 [4] => 無量大数 )

/* 構文
usort(&$array, $callback)

&$array：ソート対象の配列
$callback：ソート規則を表した関数
引数$callback（無名関数）は、以下のルールに則っていなければなりません。
● 引数は比較する配列要素（2個）
● 第1引数が第2引数よりも大きい場合は正数、小さい場合は負数、等しい場合は0を返す

この例では、引数$a／$bをキーに、配列keys（単位リスト）を検索し、その登場位置で大小比較します。
比較の結果を正数／負数／0で返すには、<=> 演算子を利用するのが便利です。
*/

//5.3.12 配列の内容を順に処理する array_walk関数
/*
array_walk関数を利用すれば、配列から順に要素を取得＆処理できます。

構文

array_walk($array, $callback, [$user_data])

&$array：処理対象の配列
$callback：処理方法を表した関数
$user_data：引数$callbackに渡す任意の値
*/
$data = ['高江'=>'男','掛谷'=>'女','日尾'=>'男','薄井'=>'女','和田'=>'男'];
array_walk($data,
    function($value, $key, $suffix){
        print "{$key}:{$value}{$suffix}";
    },'<br/>'
);
//結果 掛谷:女 日尾:男 薄井:女 和田:男

//配列の内容を変更する
/*
コールバック関数の第1引数（ここでは$value）を参照渡しすることで、元の配列（引数&$array）の内容を書き換えることも可能
*/
$data = ['高江'=>'男','掛谷'=>'女','日尾'=>'男','薄井'=>'女','和田'=>'男'];
array_walk($data, 
function(&$value){
    $value = "New{$value}";
});

print_r($data);//結果 Array ( [高江] => New男 [掛谷] => New女 [日尾] => New男 [薄井] => New女 [和田] => New男 )

print '<br/>';
//入れ子の配列を再帰的に処理する
$sum = 0;
$count = 0;
$data = [5,1,[10, -3]];
//配列内の要素を順に加算＆カウント
array_walk_recursive($data,
function($value) use(&$sum, &$count){
    $sum += $value;
    $count++;
}
);
$average = $sum / $count;
print "要素の個数:{$count}";//要素の個数:4
print "合計値:{$sum}";//合計値:13
print "平均値:{$average}";//平均値:3.25