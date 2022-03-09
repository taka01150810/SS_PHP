<?php
/*
正規表現（RegularExpression）とは「あいまいな文字列パターンを表現するための記法」です。
わかりやすくするために、あえて語弊を恐れずに言うならば、「ワイルドカードをもっと高度にしたもの」と言い換えてもよいかもしれません。
ワイルドカードとは、たとえばWindowsのエクスプローラーなどでファイルを検索するために使う「*.php」「*day*.php」といった表現です。
「*」は0文字以上の文字列を意味しているので、「*.php」であれば「a.php」や「abc.php」のようなファイル名を表しますし
「*day*.php」なら「day.php」や「day01.php」「today00.php」のように、ファイル名に「day」という文字を含む.phpファイルを表します。

ワイルドカードは比較的なじみのあるものだと思いますが、あくまでシンプルを旨としているため、あまり複雑なパターンは表現できません。そこで登場するのが正規表現です。
たとえば、[0-9]{3}-[0-9]{4}という正規表現は一般的な郵便番号を表します。
「0～9の数値3桁」＋「－」＋「0～9の数値4桁」という文字列のパターンを、これだけ短い表現の中で表しているわけです。

しかし、正規表現を利用すれば、正規表現パターンと比較対象の文字列を指定するだけで、あとは両者が合致するかどうかを正規表現エンジンが判定してくれるのです。
単にマッチするかどうかの判定だけではありません。正規表現を利用すれば、たとえば、掲示板への投稿記事から有害なHTMLタグだけを取り除いたり、任意の文書からURL文字列だけを取り出したり
あるいはHTMLから<mata>タグの情報だけを取り出してリストを作成したり、といったこともできます。

正規表現とは、HTMLやテキストファイルなど、散文的な（ということは、コンピューターにとって再利用するのが難しい）データを、
ある定型的な形式に沿って抽出し、データとしての洗練度を向上させる──言わば、人間のためのデータと、システムのためのデータをつなぐ
橋渡し的な役割を果たす存在とも言える。
*/

//5.4.1 正規表現の基本
/*
正規表現によって表されたある文字列パターンのことを正規表現パターンと言います。
また、与えられた正規表現パターンが、ある文字列の中に含まれる場合、文字列が正規表現パターンにマッチすると言います。
*/

/* 基本
XYZ ... XYZという文字列,
[XYZ] ... XYZいずれかの文字,
[^XYZ] ... X,Y,Z以外のいずれかの文字
[X-Z] ... X〜Zの範囲の中の一文字
[X|Y|Z] ... X,Y,Zのいずれか
*/

/* 量指定
X* ... 0文字以上のX("son*n"の場合"sn","son","soon","sooon"などにマッチ)
X? ... 0文字、または1文字のX("so+n"の場合"sn","son"にマッチ)
X+ ... 1文字以上のX("son+n"の場合"son","soon","sooon"などにマッチ)
X{n} ... Xとn回以上一致("son{2}n"の場合"soon","sooon"にマッチ)
X{m.n} ... Xとm〜n回一致("so{2.3}nの場合"soon""sooon"にマッチ)
*/

/* 位置指定
^ ... 行の先頭に一致
$ ...  行の末尾に一致
\A ... 文字列の先頭に一致
\z ... 文字列の末尾に一致
\Z ... 文字列の末尾、または末尾の改行に一致
*/

/* 文字セット
. ... 任意の一文字
\w ... 単語以外、数字、アンダースコアに一致
\W ... 文字以外に一致("[^\w]"と同意)
\d ... 10進数値に一致
\D ... 数字以外に一致("[^\d]"と同意)
\n ... 改行に一致
\r ... 復帰に一致
\t ... タブ文字に一致
\s ... 空白文字に一致
\S ... 空白以外の文字に一致("[^\s]"と同意)
*/

/*
http(s)?://([\w]+\.)+[\w]+(/[\w./?%&=]*)?

「(s)?」は、「s」が0～1回登場することを意味します。つまり、「http://」または「https://」にマッチします。

「([\w]+\.)+[\w]+」は、英数字／アンダースコア（\w）、ハイフンで構成される文字列で、途中にピリオド（\.）を含むことを意味します。
「(/[\w./?%&=]*)?」で後続の文字列が英数字、アンダースコア（\w）、その他の記号（?、%、&、=、など）を含む文字から構成されることを意味します。
*/

//5.4.2 正規表現パターンを記述する際の注意点
/* 構文
/pattern/opts
pattern : 正規表現パターン
opts : 修飾子(動作オプション)
*/

/*
正規表現パターンは、まずパターン本体を「/～/」のように囲む必要があります。
慣例的には「/」を使いますが、「|～|」のように違う文字で囲んでもかまいません（要は、パターンの最初と最後が識別できればよいのです）。
*/

/*
NG例
/http(s)?://([\w]+\.)+[\w]+(/[\w./?%&=]*)?/

OK例
|http(s)?://([\w]+\.)+[\w]+(/[\w./?%&=]*)?|
*/

//正規表現パターンはシングルクォートでくくる
/*
OK例
'|http(s)?://([\w]+\.)+[\w]+(/[\w./?%&=]*)?|'

NG例
"|http(s)?://([\w]+\.)+[\w]+(/[\w./?%&=]*)?|"
*/

//5.4.3 正規表現で文字列を検索する preg_match関数
/*
正規表現パターンの中で、丸カッコで囲まれた部分的なパターンのことをサブマッチパターン、または、キャプチャグループ（グループ）と言います。
また、サブマッチパターンにマッチした文字列のことをサブマッチ文字列と言います。
preg_match関数では、まずマッチ文字列全体を配列の最初の要素に、その後、サブマッチ文字列を先頭から順番に格納します。
*/
/* 構文
preg_match($pattern, $subject[&$matches[$flags[$offset]]])

$pattern：正規表現パターン
$subject：検索対象の文字列
&$matches：検索結果を格納する配列
$flags：動作フラグ（後述）
$offset：検索の開始位置（既定では文字列の先頭）
*/
$str = '彼の電話番号は0399-88-9785、私のは0398-99-1234です。郵便番号はどちらも687-1109です。';
if(preg_match('/([0-9]{2,4})-([0-9]{2,4})-([0-9]{4})/', $str, $data)){
    print "電話番号:{$data[0]}<br/>";
    print "市外局番:{$data[1]}<br/>";
    print "市内局番:{$data[2]}<br/>";
    print "加入者番号:{$data[3]}<br/>";
}
//結果 電話番号:0399-88-9785 市外局番:0399 市内局番:88 加入者番号:9785
/*
preg_match関数の戻り値は、正規表現パターンがマッチした回数を表します。
preg_match関数が1（＝暗黙的なtrue）を返した場合に、マッチ文字列全体と、それぞれのサブマッチ文字列を出力しています。
*/

//引数$flagsに定数PREG_OFFSET_CAPTUREを指定することで、マッチ文字列とそれぞれのオフセット値（登場位置）を取得することもできます。
//オフセット値は、（文字数ではなく）バイト数で返される点に注意してください。
print '<br/>';
if(preg_match('/([0-9]{2,4})-([0-9]{2,4})-([0-9]{4})/', $str, $data, PREG_OFFSET_CAPTURE)){
    print_r($data);
}
//結果 Array ( [0] => Array ( [0] => 0399-88-9785 [1] => 21 ) [1] => Array ( [0] => 0399 [1] => 21 ) [2] => Array ( [0] => 88 [1] => 26 ) [3] => Array ( [0] => 9785 [1] => 29 ) )

//5.4.4 全てのマッチ文字列を取得する preg_match_all関数
/*
preg_match関数は一度の実行で1つの実行結果しか返しません。
つまり、対象の文字列に複数のマッチ文字列があっても、結果には最初の1つしか出力されないのです。
しかし、用途によってはすべてのマッチ文字列を取得したいこともあるでしょう。その場合は、preg_match_all関数を利用します。
*/
/* 構文
preg_match_all($pattern, &$subject[&$matches[$flags = PREG_PATTERN_ORDER[$offset]]])

$pattern：正規表現パターン
$subject：検索対象の文字列
&$matches：検索結果を格納する配列
$flags：動作フラグ
$offset：検索の開始位置（既定では文字列の先頭）
*/
$str = '彼の電話番号は0399-88-9785、私のは0398-99-1234です。郵便番号はどちらも687-1109です。';
if(preg_match_all('/([0-9]{2,4})-([0-9]{2,4})-([0-9]{4})/', $str, $data, PREG_SET_ORDER)){
    foreach($data as $item){
        print "1の電話番号:{$item[0]}<br/>";
        print "1の市外局番:{$item[1]}<br/>";
        print "1の市内局番:{$item[2]}<br/>";
        print "1の加入者番号:{$item[3]}<hr/>";
    }
}
//結果 電話番号:0398-99-1234 市外局番:0398 市内局番:99 加入者番号:1234

//5.4.5 正規表現で文字列を置換する preg_replace関数
/* 構文
preg_replace($pattern, $replacement, $subject[$limit[&$count]])

$pattern：正規表現パターン
$replacement：置き換え後の文字列
$subject：置き換え対象の文字列
$limit：置換の上限回数（既定では無制限）
&$count：実際に置換が行われた回数を受け取る変数
*/
//下記は文字列に含まれるURL文字列を抽出し、これを対応するアンカータグで置き換えるサンプルです
$msg=<<<EOD
サンプルは、「サーバーサイド技術の学び舎（http://www.wings.msn.to/）」から入手できます。
執筆のノウハウ集「WINGSKnowledge」（http://www31.atwiki.jp/wingsproject）もどうぞ。
EOD;
print preg_replace('|http(s)?://([\w]+\.)+[\w]+(/[\w./?%&=]*)?|',
'<a href="$0">$0</a>',$msg);
/* 結果 
サンプルは、「サーバーサイド技術の学び舎（http://www.wings.msn.to/）」から入手できます。 
執筆のノウハウ集「WINGSKnowledge」（http://www31.atwiki.jp/wingsproject）もどうぞ。
*/

print '<br/>';
//5.4.6 正規表現で置き換えたコールバック関数で処理する preg_replace_callback関数
$msg=<<<EOD
サンプルは、サポートサイト「サーバーサイド技術の学び舎（http://www.wings.msn.to/）」から入手できます。
執筆のノウハウ集「WINGSKnowledge」（http://www31.atwiki.jp/wingsproject）もどうぞ。
EOD;
print preg_replace_callback('|http(s)?://([\w]+\.)+[\w]+(/[\w./?%&=]*)?|i',
function($matches){
    foreach($matches as $match){
        return mb_convert_case($match,MB_CASE_UPPER);
    }
},$msg);
/* 結果
サンプルは、サポートサイト「サーバーサイド技術の学び舎（HTTP://WWW.WINGS.MSN.TO/）」から入手できます。 
執筆のノウハウ集「WINGSKnowledge」（HTTP://WWW31.ATWIKI.JP/WINGSPROJECT）もどうぞ。
*/
/*  構文
preg_replace_callback($pattern, $callback, $subject[$limit = -1[&$count, $flags]])

$pattern：正規表現パターン
$callback：置き換え文字列を加工するための関数
$subject：置き換え対象の文字列
$limit：置換の上限回数（既定では無制限）
&$count：実際に置換が行われた回数を受け取る変数
$flags：動作フラグ

引数$callback（無名関数）は、以下のルールに則っていなければなりません。
1.引数はマッチした文字列の配列（形式はpreg_match関数を参照）
2.戻り値は置き換え後の文字列
*/
print '<br/>';
//5.4.7 正規表現で文字列を分割する preg_split関数
/* 構文
preg_split($pattern, $subject[$limit = -1[$flags]])

$pattern：正規表現パターン（空パターン「//」の場合、1文字単位に分割）
$subject：分割対象の文字列
$limit：分割の上限回数（既定では無制限）
$flags：動作オプション
*/
$today = '2021-05-14';
$result = preg_split('|[/.\-]|', $today);
print "{$result[0]}年{$result[1]}月{$result[2]}日";//結果：2021年05月14日
//「2021/05/14」を「2021.05.14」のように変更しても、同じ結果が得られる。

//動作オプション($flags)付きの場合
print '<br/>';
$today = '2021-05-14';
$result = preg_split('|[/.\-]|', $today, -1, PREG_SPLIT_DELIM_CAPTURE);
print_r($result);//結果：Array ( [0] => 2021 [1] => 05 [2] => 14 )
/*
PREG_SPLIT_DELIM_CAPTUREを指定することで、区切り文字パターン（引数$pattern）に含まれるサブマッチ文字列を分割結果に含めることができます。
ここでは区切り文字パターン全体を丸カッコでくくっているので、区切り文字がそのまま分割結果に反映されます。
*/

print '<br/>';
//5.4.8 正規表現パターンの修飾子
/*
修飾子とは、正規表現でマッチングや置換を行う際に利用する動作オプションです。
修飾子は「/パターン/修飾子」の形式で、正規表現の末尾に指定できます
*/
//大文字/小文字を区別しない i修飾子
$msg=<<<EOD
サンプルは、サポートサイト「サーバーサイド技術の学び舎（http://www.wings.msn.to/）」から入手できます。
執筆のノウハウ集「WINGSKnowledge」（HTTP://www31.atwiki.jp/wingsproject）もどうぞ。
EOD;
print preg_replace('|http(s)?://([\w]+\.)+[\w]+(/[\w./?%&=]*)?|',
'<a href="$0">$0</a>',$msg);
print '<br/>';
//この場合 HTTP://www31.atwiki.jp/wingsproject がアンカータグに変換されないのでi修飾子を使う
print preg_replace('|http(s)?://([\w]+\.)+[\w]+(/[\w./?%&=]*)?|i',
'<a href="$0">$0</a>',$msg);

print '<br/>';
//複数行検索に対応する m修飾子(マルチラインモード)
$str = '7人の小人と白雪姫\n101匹ワンちゃん';//$strの内容を先頭から検索＆マッチしたものを書き出し
if(preg_match_all('/^[0-9]{1,}/', $str, $data)){
    foreach($data[0] as $item){
        print "マッチング結果：{$item}<br/>";
    }
}//結果 マッチング結果：7

$str = '7人の小人と白雪姫\n101匹ワンちゃん';//$strの内容を先頭から検索＆マッチしたものを書き出し
if(preg_match_all('/^[0-9]{1,}/m', $str, $data)){
    foreach($data[0] as $item){
        print "マッチング結果：{$item}<br/>";
    }
}//結果 マッチング結果：7 マッチング結果：101

print '<br/>';
//シングルラインモードを有効にする
//シングルラインモード（単一行モード）とは、「.」の挙動を変更するためのモードです。
$str = "初めまして。\nよろしくお願いします。";
if(preg_match_all('/\A.+/', $str, $data)){
    foreach($data[0] as $item){
        print $item;
    }
}//結果 初めまして。

print '<br/>';
if(preg_match_all('/\A.+/s',$str,$data)){
    foreach($data[0] as $item){
        print $item;
    }
}//結果 初めまして。 よろしくお願いします。

print '<br/>';
//正規表現を見やすく整理する x修正子
//x修飾子を有効にすることで、正規表現に空白／コメントを付与できるようになります。
$str = '仕事用はwings@example.comです。';
if(preg_match("/
[a-z0-9.!#$%&'*+\/=?^_{|}~-]+ #local
@ #delimiter
[a-z0-9-]+(\.[a-z0-9-]+)* #domain
/x", $str, $data)){
    print "Mail: {$data[0]}";
}//結果 Mail: wings@example.com

//埋め込みフラグ
/*
正規表現オプションは、正規表現パターンの末尾で指定する他、埋め込みフラグ（インラインフラグ）として指定することもできます。
(?フラグ)で正規表現パターンの中に埋め込むことができます。
以下のコードは同じ意味です。
*/
if(preg_match("/[a-z0-9.!#$%&'*+\/=?^_{|}~]+@[a-z0-9-]+(\.[a-z0-9-]+)*/i",$str,$data)){

}
if(preg_match("/(?i)[a-z0-9.!#$%&'*+\/=?^_{|}~]+@[az09]+(\.[a-z0-9-]+)*/",$str,$data)){

}
//(?i)以降でのみフラグが有効になる場合
if(preg_match("/[a-z0-9.!#$%&'*+\/=?^_{|}~]+@(?i)[az09]+(\.[a-z0-9-]+)*/",$str,$data)){

}
/*
上記の場合、指定された以降でのみフラグは有効になります。
よって、上の例であれば「xxxxx@example.com」「xxxxx@EXAMPLE.COM」にはマッチしますが、「XXXXX@EXAMPLE.COM」にはマッチしません。
*/
//(?-フラグ)の形式で、パターンの途中で一旦有効にしたフラグを無効にすることも可能
if(preg_match("/(?i)[a-z0-9.!#$%&'*+\/=?^_{|}~]+@(?-i)[az09]+(\.[a-z0-9-]+)*/",$str,$data)){

}
print '<br/>';
//5.4.9 正規表現による検索
//最長一致と最短一致
//最長一致とは、正規表現で「*」「+」などの量指定子を利用した場合に、できるだけ長い文字列を一致させなさい、というルールです。
$tags='<p><strong>WINGS</strong>サイト<a href="index.html"><img src="wings.jpg"/></a></p>';
if(preg_match_all('/<.+>/',$tags,$data,PREG_SET_ORDER)){//「<.+>」は、<...>の中に「.」（任意の文字）が「+」（1文字以上）で、<strong>や<img>のようなタグにマッチすることを想定
    foreach($data as $item){
        print htmlspecialchars($item[0]).'<br/>';
    }
}
//結果 <p><strong>WINGS</strong>サイト<a href="index.html"><img src="wings.jpg"/></a></p>

//個々のタグを取り出したい場合
if(preg_match_all('/<.+?>/',$tags,$data,PREG_SET_ORDER)){//「+?」は最短一致を意味し、今度は「できるだけ短い文字列を一致」させようとする。
    foreach($data as $item){
        print htmlspecialchars($item[0]).'<br/>';
    }
}
/* 結果
  <p> 
    <strong>
    </strong>
    <a href='index.html'>
        <img src='wings.jpg'/>
    </a>
  </p>
*/

//名前付きキャプチャグループ
/*
正規表現パターンに含まれる(...)でくくられた部分のことを、グループ、またはキャプチャグループと言うのでした。
これらグループにマッチした文字列を「$item[1]」のようにインデックス番号で参照していましたが、グループに意味ある名前を付与することもできます。
*/
$str = '彼の電話番号は0399-88-9785、私のは0398-99-1234です。郵便番号はどちらも687-1109です。';
if(preg_match_all('/(?P<area>[0-9]{2,4})-(?P<city>[0-9]{2,4})-(?P<local>[0-9]{4})/', $str, $data, PREG_SET_ORDER)){
    foreach($data as $item){
        print "電話番号:{$item[0]}<br/>";
        print "市外局番:{$item['area']}<br/>";
        print "市内局番:{$item['city']}<br/>";
        print "加入者番号:{$item['local']}<br/>";
    }
}
/* 結果
電話番号:0399-88-9785
市外局番:0399
市内局番:88
加入者番号:9785
電話番号:0398-99-1234
市外局番:0398
市内局番:99
加入者番号:1234
*/

//グループの後方参照
/*
グループにマッチした文字列は、正規表現パターンの中であとから参照することもできます（後方参照）。
一般的なグループは「\1」のような番号で後方参照できます。もちろん、複数のグループがある場合は、\2、\3...のように指定します。
*/
$str = '<p>サポートサイト<a href="http://www.wings.msn.to/">http://www.wings.msn.to/</a></p>';
if(preg_match('/<a href="(.+?)">\1<\/a>/', $str, $data)){
    print htmlspecialchars($data[0]);
}
//結果 <a href="http://www.wings.msn.to/">http://www.wings.msn.to/</a>

print '<br/>';
/*
名前付きキャプチャグループも利用できます。
名前付きキャプチャグループを参照するには「(?P=名)」とする
*/
if(preg_match('/<a href="(?P<link>.+?)">(?P=link)<\/a>/',$str,$data)){
    print htmlspecialchars($data[0]);
}
//結果 <a href="http://www.wings.msn.to/">http://www.wings.msn.to/</a>

print '<br/>';
//参照されないグループ
/*
これまでに何度も見てきたように、正規表現では、パターンの一部を(...)でくくることで、部分的なマッチング文字列を取得できるのでした。
ただし、(...)はサブマッチの目的だけで用いるばかりではありません。たとえば、「*」「+」の対象をグループ化するために用いるような状況もあります
*/
$str = '仕事用はwings@example.comです。プライベート用はYAMA@example.comです。';
if(preg_match_all("/([a-z0-9.!#$%&\'*+\/=?^_{|}~-]+)@([a-z0-9-]+(\.[a-z0-9-]+)*)/i", $str, $data, PREG_SET_ORDER)){
    foreach($data as $item){
        print "{$item[0]}<br />";
        print "{$item[1]}<br />";
        print "{$item[2]}<br />";
        print "{$item[3]}";
        print "<hr />";
    }
}
/* 結果
wings@example.com
wings
example.com
.com
YAMA@example.com
YAMA
example.com
.com
*/
if(preg_match_all('/([a-z0-9.!#$%&\'*+\/=?^_{|}~-]+)@([a-z0-9-]+(\.[a-z0-9-]+)*)/i', $str, $data, PREG_SET_ORDER))
//、(?:...)とすることで、サブマッチの対象から除外できる
if(preg_match_all('/([a-z0-9.!#$%&\'*+\/=?^_{|}~-]+)@([a-z0-9-]+(?:\.[a-z0-9-]+)*)/i',$str,$data,PREG_SET_ORDER)){
    foreach($data as $item){
        print "{$item[0]}<br />";
        print "{$item[1]}<br />";
        print "{$item[2]}<br />";
        print "<hr />";
    }
}
/* 結果
wings@example.com
wings
example.com
YAMA@example.com
YAMA
example.com
*/

//後読みと先読み
/*
A(?=B)...肯定的先読み(Aの直後にBが続く場合にだけAにマッチ)
A(?!B)...否定的先読み(Aの直後にBが続かない場合にだけAにマッチ)
(?<=B)A...肯定的後読み(Aの直前にBがある場合にだけAにマッチ)
(?<!B)A...否定的後読み(Aの直前にBがない場合にだけAにマッチ)
*/
function showMatch($ptn, $input){
    if(preg_match_all($ptn, $input, $data)){
        foreach($data as $items){
            foreach($items as $item){
                print "{$item}<br />";
            }
        }
    } else {
        print 'マッチしません<br />';
    }
    print '<hr />';
}

$ref1 = '/いろ(?=はに)/';
$ref2 = '/いろ(?!はに)/';
$ref3 = '/(?<=。)いろ/';
$ref4 = '/(?<!。)いろ/';
$msg1 = 'いろはにほへと';
$msg2 = 'いろものですね。いろいろと';

showMatch($ref1, $msg1);//結果 いろ
showMatch($ref1, $msg2);//結果 マッチしません
showMatch($ref2, $msg1);//結果 マッチしません
showMatch($ref2, $msg2);//結果 いろ、いろ、いろ
showMatch($ref3, $msg1);//結果 マッチしません
showMatch($ref3, $msg2);//結果 いろ
showMatch($ref4, $msg1);//結果 いろ
showMatch($ref4, $msg2);//結果 いろ、いろ

//ひらがな/カタカナ/漢字などを取得する
/*
Unicodeの個々の文字には、それぞれの文字種を表すためのプロパティが割り当てられています。
これらプロパティを正規表現のパターンの中で利用できるようにしたものがUnicodeプロパティという仕組みです。
Unicodeプロパティを利用するには、UTF8モード（u修飾子）を有効にした上で、\p{...}の形式で表します。
*/
/* よく利用するUnicodeプロパティ
Hiragana ひらがな
Katakana カタカナ
Han 漢字
Punct 句読点
Digit 数字(10進数)
Space 空白
Lower 小文字英字
Upper 大文字英字
*/
$str = 'ただいまWINGSプロジェクトメンバー募集中!';
preg_match('/[\p{Hiragana}]+/u', $str, $data);
preg_match('/[\p{Katakana} - ]+/u', $str, $data2);
preg_match('/[\p{Han}]+/u', $str, $data3);

print $data[0];//結果 ただいま
print $data2[0];//結果 プロジェクトメンバ
print $data3[0];//結果 募集中