<!DOCTYPE html>
<html>
    <head>
        <mata charset="UTF-8" />
        <title></title>
        <link rel="stylesheet" href="https://stachpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstorap.min.css">
    </head>
    <body>
        <table class="table">
            <thread>
                <tr>
                    <th>ファイル</th><th>サイズ</th><th>最終アクセス日</th><th>最終更新日</th>
                </tr>
            </thread>
        </table>
    </body>
</html>

<?php

//7.3 DirectoryIteratorクラス
/*
DirectoryIteratorクラスは、指定されたフォルダー（ディレクトリ）配下のファイル情報にアクセスするためのクラスです。

フォルダーの読み込みは、大きく次の手順で行います。
①フォルダーを開く
②フォルダー配下の要素を順に取得する
③ファイル情報を取得する
*/

//7.3.1 フォルダーを開く
/*
フォルダーを読み込む場合、まず、そのフォルダーを開かなくてはなりません。
この行為を表すのが、DirectoryIteratorクラスのインスタンス化です。
*/
$dir = new DirectoryIterator('./');

?>
