<?php
//7.5 HTTPクライアントGuzzle
/*
近年、ネットワーク経由で、情報／サービスにアクセスする状況は増えています。
たとえばスクレイピングは、サイト上のページから情報を抽出するための技術のことで、インターネット上から情報を効率的に収集するために用いられます。
また、マッシュアップは、ネットワーク上で提供されているサービスを組み合わせて、自作のアプリに取り込む技術のことです。
たとえばAmazonProductAdvertisingAPIを利用すれば、Amazonの膨大な商品データベースをあたかも自分のアプリの一部であるかのように
（しかもも低コストで！）利用できるようになります。
*/

//7.5.1 HTTP通信の基本
/*
autoload.phpはライブラリを自動ロードするためのコードです。
Composerでインストールしたライブラリを利用する際には、
あらかじめautoload.phpをインポートしておきます。
*/
require '../vendor/autoload.php';

//クライアントを生成
/*
GuzzleHttp\ClientはGuzzleの中核とも言うべきクラスで、HTTP通信そのもの（リクエスト／レスポンス）を管理します。
コンストラクターには「オプション名=>値」の形式で、動作オプションを指定できます。
*/
$cli = new GuzzleHttp\Client([
    'base_uri' => 'https://google.com',
]);
//リクエストを送信
$res = $cli->request('get', 'https://google.com');
//取得したコンテンツを出力
print $res->getBody();

//7.5.2 HTTP POSTによる通信
/*
get（HTTP GET）という命令を使ってHTTP通信を行いました。HTTP GETは、主にデータを取得するための命令です。
リクエスト時に簡単なデータを送信することもできますが、サイズは制限されます。
まとまったデータを送信するには、HTTP POSTを利用してください。
*/
require '../vendor/autoload.php';

$cli = new GuzzleHttp\Client([
    'base_uri' => 'https://yahoo.com',
]);

$res = $cli->post('https://yahoo.com',[
    'form_params' => [
        'name' => '宮中 良明',
    ]
]);

print $res->getBody();