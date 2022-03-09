<?php
//5.5 ファイルシステム関数
/*
ファイルシステム関数は、ファイルシステム上のフォルダー（ディレクトリ）やファイルを操作するための関数です。
フォルダー／ファイルの情報を取得する、ファイルへの読み書きを行うなど、さまざまな機能を提供します。
ここでは、その中でも特によく利用すると思われる「ファイルへの読み書き」につい
*/

//5.1.1 テキストファイルへの書き込み
/*
下記はアクセスログ情報をタブ区切りテキストの形式でテキストファイルに書き込むコードです。
具体的には、アクセス日時、アクセスしたスクリプトのパス、クライアントの種類、リンク元のアドレスといった情報を書き込みます。
*/
//書き込み内容を配列$dataにセット
$data[] = date('Y/m/d H:i:s');
$data[] = $_SERVER['SCRIPT_NAME'];//アクセスしたスクリプトのパス
$data[] = $_SERVER['HTTP_USER_AGENT'];//クライアントの種類
$data[] = $_SERVER['HTTP_REFERER'];//リンク元のアドレス
//access.logを追記書き込みモードでオープン
$file = @fopen('access.log', 'a') or die('ファイルを開けませんでした');
//ファイルのロック
flock($file, LOCK_EX);
//ファイルの書き込み
fwrite($file, implode("\t", $data) . "\n");
//ロックの解除
flock($file, LOCK_UN);
//フェイルのクローズ
fclose($file);
print 'アクセスログを記録しました';

/* ファイル書き込みに手順
以降では、ファイル書き込みの基本手順として、次の一連の流れを追っていくことにします。
1.ファイルを開く
2.ファイルをロックする
3.ファイルに対して書き込みを行う
4.ファイルを閉じる（ロックを解除する）
*/

//5.5.2 ファイルを開く　fopen/fclose関数
/* 構文
fopen($filename, $mode[$use_include_path])

$filename：ファイルのパス
$mode：オープンモード
$use_include_path：include_pathパラメーターを利用するか
*/
/*
fopen関数は、ファイルのオープンに成功すると、戻り値としてファイルハンドルを返します。
ファイルハンドルとは、名前のとおり、そのファイルを操作（handle）するためのキーとなる情報です。
今後、ファイルに対する読み書きは、このファイルハンドルに対して行うことになります。
*/

/* 構文
fclose($stream)

$stream: ファイルハンドル
*/
/*
ファイルのクローズはスクリプトの終了時に自動的に行われるので、必ずしも必須というわけではありませんが
使ったものは片付ける癖をつけておくのは悪いことではありません。
*/

//5.5.3 fopen関数でのエラー処理 エラー制御演算子
/*
die($status)

$status: 終了時に表示する文字列
*/
/*
die関数は、指定されたメッセージを出力して、スクリプトを強制終了するための関数です。
つまり「@fopen……ordie……」とは、「ファイルを開きなさい、さもなければ（or）終了しなさい」と言っているわけです。
*/
$file = @fopen('access.log', 'ab') or die('ファイルを開けませんでした');

//5.5.4 ファイルの書き込み fwrite関数
/* 構文
fwrite($handle, $string[$length])

$handle：書き込み対象のファイルハンドル
$string：書き込む文字列
$length：書き込む文字列の長さ
*/
$data[] = date('Y/m/d H:i:s');
$data[] = $_SERVER['SCRIPT_NAME'];//アクセスしたスクリプトのパス
$data[] = $_SERVER['HTTP_USER_AGENT'];//クライアントの種類
$data[] = $_SERVER['HTTP_REFERER'];//リンク元のアドレス

fwrite($file, implode("\t", $data) . "\n");
/*
アクセス日時、アクセスしたスクリプトのパス、クライアントの種類、リンク元のアドレスを配列に格納しておき、タブ（\t）区切りで連結したものをファイルに書き込んでいます。
このように、決まった区切り文字のテキストを生成するにはimplode関数を利用するのが便利です。
行の終わりには、改行文字（\n）を指定するのを忘れないようにしてください。
*/

//5.5.5 ファイルのロック flock関数
/*
このように、ファイルへの書き込みそのものはfopen、fwrite、fclose関数によって簡単にできてしまいます。
しかし、ここで1つだけ注意すべき点があります。それは「ファイルへの同時書き込み」です。
あるユーザー（山田さん）がファイルを開いて書き込んでいる間に、別のユーザー（鈴木さん）が元のファイルを開いて、別の書き込みをしたらどうでしょう。
山田さんが書き込んだ内容が結果的に無視されてしまうかもしれません。処理の内容によっては、ファイルそのものが破壊されてしまう恐れもあります。
つまり、テキストファイルという共有のリソース（資源）に対して書き込みを行う場合には、このような同時アクセスが行われないように、あらかじめファイルをロックしておく必要があるのです。
*/
/* 構文
flock($stream, $operation)

$stream: ファイルハンドル
$operation: ロックモード
*/
flock($file, LOCK_EX);
/* ロックモード
LOCK_SH...共有ロック(読み込み中なので他者による書き込みを禁止する(読むだけならいいですよ))
LOCK_EX...排他ロック(書き込み中なので、他者による書き込みを禁止する(現在自分が書いているので読むのも書くのもやめてください))
LOCK_UN...ロックの解除
LOCK_NB...非ブロックモード
*/

//5.5.6 タブ区切りテキストの読み込み fgetcsv関数
/* 構文
fgetcsv($stream[$length[$separator[$enclosure[$escape]]]])

$stream：ファイルハンドル
$length：読み込む最大長（バイト単位）
$separator：区切り文字（既定ではカンマ）
$enclosure：フィールドの囲み文字（既定ではダブルクォート）
$escape：エスケープ文字（既定ではバックスラッシュ）
*/
?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<title>アクセスログ</title>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</html>
<body>
    <table class="table">
        <thread>
            <th>アクセス日時</th>
            <th>スクリプト名</th>
            <th>ユーザーエージェント</th>
            <th>リンク元のURL</th>
        </thread>
        <tbody>
            <?php
            //ファイル読み取り専用でオープン
            $file = fopen('access.log', 'r');
            //ファイルを共有ロック
            flock($file, LOCK_SH);
            //行単位でテキストを読み込み&タブ文字で分割
            while($line = fgetcsv($file, 1024, "\t")){
                print '<tr>';
                //分割した結果を順に出力
                foreach($line as $value){
                    print '<td>' . $value . '</td>';
                }
                print '</tr>';
            }
            //ロックの解除
            flock($file, LOCK_UN);
            //ファイルのクローズ
            fclose($file);
            ?>
        </tbody>
    </table>
</body>
<?php
/*
fgetcsv関数は、ファイルポインターを1行ずつ後ろにずらしながら、現在行のテキストを読み込み、指定された区切り文字で分割した値を配列として返します。
ファイルポインターとは、ファイルを現在読み書きしている位置を示す目印のようなものです。

fgetcsv関数は、読み込むべき次の行が存在しない場合にfalseを返します。
fgetcsv関数のこの性質を利用して、fgetcsv関数がfalseを返すまでwhileループを繰り返すことで、ファイル内のすべての行を読み込んでいるというわけです。
*/
//5.5.7 タブ区切りテキストの読み込み fget/file関数
/* 構文
fgets($handle,[$length])

$handle：ファイルハンドル
$length：読み込む最大長（バイト単位）
*/
/*
この場合は、読み込んだ行データをexplode関数で分割処理する必要があります。
タブ区切りテキストを読み込む場合にはfgetcsv関数のほうが便利ですが
特定の区切り文字を持たないテキストを順に読み込む場合にはfgets関数がよいでしょう。
*/
?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<title>アクセスログ</title>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</html>
<body>
    <table class="table">
        <thread>
            <th>アクセス日時</th>
            <th>スクリプト名</th>
            <th>ユーザーエージェント</th>
            <th>リンク元のURL</th>
        </thread>
        <tbody>
            <?php
            //ファイル読み取り専用でオープン
            $file = fopen('access.log', 'r');
            //ファイルを共有ロック
            flock($file, LOCK_SH);
            //行単位でテキストを読み込み&タブ文字で分割
            while($fline = fgets($file, 1024)){
                $line = explode("\t", trim($fline));
                print '<tr>';
                //分割した結果を順に出力
                foreach($line as $value){
                    print '<td>' . $value . '</td>';
                }
                print '</tr>';
            }
            //ロックの解除
            flock($file, LOCK_UN);
            //ファイルのクローズ
            fclose($file);
            ?>
        </tbody>
    </table>
</body>
<?php
/* 構文
file($filename[$flag])

$filename：読み込むファイルのパス
$flags：動作フラグ
*/
/*　$flagの設定値
FILE_USE_INCLUDE_PATH include_pathパラメータからファイルを検索
FILE_IGNORE_NEW_LINES 配列の要素末尾に改行文字を追加しない
FILE_SKIP_EMPTY_LINES 空行を読み飛ばす
*/
$file = file('access.log',FILE_IGNORE_NEW_LINES);
//配列に格納された行を順に処理
foreach($file as $line){
    //タブ文字で行単位のテキストを分割
    $line = explode("\t",$line);
    print '<tr>';
    foreach($line as $value){
        print '<td>'.$value.'</td>';
    }
    print '</tr>';
}
/*
file関数は、ファイルの内容をまとめて取得したいという場合に便利です。ただし巨大なテキストが相手の場合、メモリも大量に消費します。
テキストの内容を順に処理（出力）するケースでは、できるだけfgets／fgetcsv関数を優先して利用すべきです。
*/

//5.5.8 ファイルシステム関数の設定パラメーター
/*
PHPでは、ファイルシステム関数の挙動を制御するために、php.iniで設定可能ないくつかのパラメーターを用意しています。
設定によっては、ファイルが正しく読み込めない、見つからないなどの原因にもなるので、最低限、以降に示すパラメーターについては理解しておきたいところです。
*/

/*　　allow_url_fopenパラメーター
fopen関数で読み込めるのは、サーバー上のファイルだけではありません。
「http://～」や「ftp://～」で始まるアドレス、つまり、ネットワーク上のファイルを読み込むこともできます。
ただし、その場合にはallow_url_fopenパラメーターをOn（既定）に設定しておく必要があります。
*/

/*　　open_basedirパラメーター
スクリプトからアクセスできるフォルダーを設定します。
open_basedirパラメーターを指定した場合、スクリプトからはここで設定したフォルダーにしかアクセスできなくなります。
（既定では、すべてのフォルダーへのアクセスを許可しています）。
これによって、スクリプトになにかしら脆弱性があった場合にも、予期せぬファイルにアクセスされてしまう危険性を最小化できます。
*/

/* include_pathパラメーター
ドキュメントルートとは別のフォルダーにアクセスしたい場合、いちいち絶対パスを指定するのではコードも冗長になりますし
そもそもフォルダーの場所が変わった場合には、コードも書き換えなければならなくなるので面倒です。
そこで登場するのが、include_pathパラメーターです。include_pathパラメーターは、ファイルの検索先を表します。

include_path=".;C:\mamp\php\includes;C:\mamp\php\pear"
のように設定している場合には、
1．現在のフォルダー（.）
2．C:\mamp\php\includes
3．C:\mamp\php\pear

の順番でファイルを検索します

ただし、fopen関数でinclude_pathパラメーターを有効にするには、次のように第3引数にtrueを指定する必要があります。
既定ではinclude_pathパラメーターの値は無視されるので、注意してください。
$file = fopen('access.log','r',true);
*/