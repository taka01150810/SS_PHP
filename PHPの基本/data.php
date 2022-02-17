<?php
/*
データ型（型）とは、データの種類のことです。
PHPでは、実にさまざまなデータをコードの中で扱えます。
たとえば、「abc」や「イロハ」は文字列型、1や10は数値型、true（真）やfalse（偽）は真偽型に分類できます。
プログラミング言語には、このデータ型を強く意識するものと、逆にほとんど意識する必要がないものとがあります。
PHPは後者に属する言語です。つまり、データ型に対して寛容です。最初に文字列を格納した変数にあとから数字をセットしてもかまいませんし、その逆も可能です。
そのため、次のようなスクリプトもPHPでは正しいコードです。
*/

$data = '10日でおぼえるPHP入門教室';
$data = 2920;//文字列が代入された変数に数値を代入
print $data;

/*
しかし開発者がデータ型をまったく意識しなくてよいというわけではありません。
PHPで扱える主なデータ型はスカラー型、複合型、特殊型。
スカラー型とは、1つの変数（入れ物）で1つの値だけを扱うことができるものを言う。データ型の中でも最も基本的なものである。
スカラー型と対照的なのが複合型で、この型は1つの変数で複数の値をまとめて扱える。
特殊型は、スカラー型／複合型のいずれにも分類できない特殊な値を表す型のことである。
*/

// 2.3.1 論理リテラル（bool）
/*
論理型は、スカラー型の中でも最も単純な型で、真（正しい）か偽（間違い）のいずれかの状態しか持ちません。
falseキーワードだけがfalseを表すわけではない。
*/

?>