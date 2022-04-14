<?php
//7.5.3 JSONデータを取得する
/*
HTTP経由でデータを受け渡しする場合、JSON（JavaScriptObjectNotation）と呼ばれるデータ形式がよく利用されます。
JSONとは、名前のとおり、JavaScriptのオブジェクトリテラルをもとにしたデータ形式で、
その性質上、JavaScriptとの親和性に優れている。
*/
require '../vendor/autoload.php';

$cli = new GuzzleHttp\Client([
    'base_uri' => 'https://wings.msn.to',
]);

$res = $cli->get('/tmp/books.json');
$obj = json_decode($res->getBody());
print_r($obj);
/*
結果 
stdClass Object(
    [books]=>Array(
        [0]=>stdClassObject(
            [isbn]=>9784798151120
            [title]=>独習Java新版
            [author]=>山田祥寛
            [published]=>翔泳社
            [price]=>2980
            [publishDate] => 2029/05/15
        )
        [1]=>stdClassObject(
            [isbn]=>9784798153827
            [title]=>独習C#新版
            [author]=>山田祥寛
            [published]=>翔泳社
            [price]=>3600
            [publishDate]=>2017/12/15
        )
        ...中略...
    )
)
*/
/*
print($obj->books[0]->title)
//結果 独習Java新版
*/