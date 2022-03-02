<?php

//文字列関数は、文字列の加工や整形、部分文字列の検索／取得など、文字列の操作に広くかかわる機能を提供します。

//5.2.1 文字列の長さを取得する mb-strlen関数
/*
$string：対象の文字列 $encoding：使用する文字エンコーディング
引数 $encoding は、文字列を処理する際に利用する文字エンコーディング名です。

mb_strlen(string $string[,?string$encoding]):int
*/
$str = 'WINGSプロジェクト';
print mb_strlen($str);//結果：11

print '<br/>';
/*
よく似た関数としてstrlen関数がありますが、こちらはマルチバイト文字（日本語）には対応していないので注意してください。
英数字（半角文字）であれば1文字は1バイトで表されるので、問題はありません。
しかし、日本語（マルチバイト文字）の1文字が何バイトで表されるかは、利用している文字エンコーディングによって異なります。
*/
print strlen($str);//結果 23

print '<br/>';
//5.2.2 文字列を大文字⇆小文字で変換する mb_convert_case関数
$data_1 = 'Wings project';
$data_2 = 'W I N G Sプロジェクト';
$data_3 = 'Fußball';//ドイツ語のß（エスツェット）は「ss」を表す

print mb_convert_case($data_1, MB_CASE_UPPER);//結果 WINGS PROJECT
print '<br/>';
print mb_convert_case($data_1, MB_CASE_LOWER);//結果 wings project
print '<br/>';
print mb_convert_case($data_1, MB_CASE_TITLE);//結果 Wings Project
print '<br/>';
print mb_convert_case($data_2, MB_CASE_LOWER);//結果 w i n g sプロジェクト
print '<br/>';
print mb_convert_case($data_2, MB_CASE_UPPER);//結果 W I N G Sプロジェクト
print '<br/>';
print mb_convert_case($data_3, MB_CASE_UPPER);//結果 FUSSBALL
print '<br/>';
print mb_convert_case($data_3, MB_CASE_UPPER_SIMPLE);//結果 FUßBALL
print '<br/>';

//5.2.3 部分文字列を取得する① mb_substr関数
$str = 'WINGSプロジェクト';
print mb_substr($str, 5, 2);//結果 プロ
print '<br/>';
print mb_substr($str, 5);//結果 プロジェクト
print '<br/>';
print mb_substr($str, 5, -4);//結果 プロ
print '<br/>';
print mb_substr($str, -6, 2);//結果 プロ
print '<br/>';

//5.2.4 部分文字列を取得する② mb_strstr関数
$str = 'WINGSプロジェクト';
print mb_strstr($str, 'S', true);//結果 WING
print '<br/>';
print mb_strstr($str, 'S');//結果 Sプロジェクト
print '<br/>';
print mb_strstr($str, 'M', false);//結果 false(何も表示されない)
print '<br/>';

//5.2.5 部分文字列を置換する str_replace関数
/*
構文
str_replace(string|array $search, string|array $replace,string|array $subject
[,int&$count]):string|array

$search：置き換える部分文字列
$replace：置き換え後の文字列
$subject：対象の文字列
&$count：置き換えた文字列の個数を格納する変数
*/
$str = 'にわにはにわにわとりがいる';
print str_replace('にわ', 'ニワ', $str, $cnt);//結果 ニワにはニワニワとりがいるd
print '<br/>';
print "{$cnt}個の置き換えをしました。";//結果 3個の置き換えをしました。

print '<br/>';
//引数$search、$replace、$subjectには、それぞれ配列を渡すこともできます
$str = ['PHPは良い言語です。','PHPは良いサーバー実行環境です。'];
$src = ['PHP','良い'];
$rep = ['PHP8','素晴らしい'];
print_r(str_replace($src, $rep, $str, $cnt));//結果 Array ( [0] => PHP8は素晴らしい言語です。 [1] => PHP8は素晴らしいサーバー実行環境です。 )
print '<br/>';
print "{$cnt}個の置き換えをしました。";//結果 4個の置き換えをしました。

print '<br/>';
//5.2.6 文字列を特定の区切り文字で分割する　explode関数
$data = 'リオとニンザブロウとナミとリンリン';
print_r(explode('と', $data));//結果 Array ( [0] => リオ [1] => ニンザブロウ [2] => ナミ [3] => リンリン )
print '<br/>';
print_r(explode('や', $data));//結果 Array ( [0] => リオとニンザブロウとナミとリンリン )
print '<br/>';
print_r(explode('と', $data, 2));//結果 Array ( [0] => リオ [1] => ニンザブロウとナミとリンリン )
print '<br/>';
print_r(explode('と', $data, -2));//結果 Array ( [0] => リオ [1] => ニンザブロウ )

print '<br/>';
//5.2.7 特定の文字位置を検索する mb_strpos／mb_strrpos関数
/* 構文
mb_strpos(string($haystack),string($needle) [,int($offset)] [,?string($encoding)]]):int|false

mb_strrpos(string($haystack),string($needle)[,int($offset)[,?string($encoding)]]):int|false

$haystack：検索対象の文字列
$needle：検索文字列
$offset：検索開始位置
$encoding：使用する文字エンコーディング（省略時はdefault_charsetパラメーターの値）
*/
/*
mb_strpos関数とmb_strrpos関数との違いは、検索文字列が最初に現れた位置を返すか（mb_strpos関数）、最後に現れた位置を返すか（mb_strrpos関数）です。
mb_strpos／mb_strrpos関数のいずれも、部分文字列が見つからなかった場合にはfalseを、見つかった場合には先頭文字を0とした場合の文字位置を返します。
*/
$str = 'にわにはにわにわとりがいる';
print mb_strpos($str, 'にわ');//結果 0
print '<br/>';
print mb_strpos($str, 'にわ', 2);//結果 4
print '<br/>';
print mb_strpos($str, 'にわ', -10);//結果 4
print '<br/>';
print mb_strrpos($str, 'かに');//結果 false
print '<br/>';
print mb_strrpos($str, 'にわ');//結果 6
print '<br/>';
print mb_strrpos($str, 'にわ', -8);//結果 4

print '<br/>';
if(mb_strpos($str, 'にわ') != false){
    print '文字列が見つかりました。';
}//結果：なにも表示されない
/*
このコードでは、期待した結果を得られません。mb_strpos／mb_strrpos関数の戻り値が0である場合、「=」「!=」演算子ではfalseとみなされてしまうのです。
0とfalseを区別するには、厳密な等価演算子を使う必要があります。「!=」を「!==」に変更すれば表示される
*/

print '<br/>';
//5.2.8 部分文字列の登場回数をカウントする
/* 構文
mb_substr_count(string($haystack),string($needle)[,?string($encoding)]):int

$haystack：検索対象の文字列
$needle：検索文字列
$encoding：使用する文字エンコーディング（省略時はdefault_charsetパラメーターの値）
*/
$str = 'にわにはにわにわとりがいる';
print mb_substr_count($str, 'にわ');//結果 3
print '<br/>';
$str='いちいちいちばにいち';
print mb_substr_count($str,'いちいち');//結果：1
//一見すると、「いちいち」は0～3文字目、2～5文字目に2か所あるように見えますが、mb_substr_count関数は重複のない出現数をカウントする。

print '<br/>';
//5.2.9 文字列に特定の文字列が含まれるかを判定する str_contains
/*
文字列に指定された文字列が含まれるかを判定するには、str_contains関数を利用します。
単に含まれるかだけでなく、ある文字列が先頭／末尾に位置するか（＝文字列がある文字列で始まる／終わるか）を判定するならば
str_starts_with／str_ends_with関数も利用できます。

構文
str_contains(string($haystack),string($needle)) : bool
str_starts_with(string($haystack),string($needle)) : bool
str_ends_with(string($haystack),string($needle)) : bool

$haystack：検索対象の文字列
$needle：検索文字列
*/
$str = 'WINGSプロジェクト';
var_dump(str_contains($str, 'プロ'));//結果 bool(true)
print '<br/>';
var_dump(str_starts_with($str, 'WINGS'));//結果 bool(true)
print '<br/>';
var_dump(str_ends_with($str, 'WINGS'));//結果 bool(false)
print '<br/>';

//5.2.10 文字列の前後から空白を除去する  trim／ltrim／rtrim関数
/*
trim／ltrim／rtrim関数を利用することで、文字列前後の空白を除去できます。
trim関数は前後双方の空白、ltrim関数は前方だけの空白、rtrim関数は後方だけの空白を、それぞれ除去します。

trimは、あくまで文字列の前後から文字を取り除くための関数です。
文字列に含まれる文字まで除去するならば、str_replace関数を利用してください。

構文
trim(string $string[, string $characters = "\n\r\t\v\0"]):string
ltrim(string $string[, string $characters = "\n\r\t\v\0"]):string
rtrim(string $string[, string $characters = "\n\r\t\v\0"]):string

$string：対象の文字列
$characters：除去する文字
*/
$str = "  こんにちは    ";
var_dump($str);//結果 string(22) " こんにちは "
print '<br/>';
var_dump(trim($str));//結果 string(15) "こんにちは"
print '<br/>';
var_dump(ltrim($str));//結果 string(15) "こんにちは  "
print '<br/>';
var_dump(rtrim($str));//結果 string(15) "  こんにちは"

print '<br/>';
$str_2 = '!=====[独習PHP]=====!';
var_dump(trim($str_2, "! = []"));//結果 string(9) "独習PHP"

print '<br/>';
//5.2.11 文字列を整形する printf関数
/*
printf関数は、指定された書式文字列に基づいて文字列を整形し、その結果を出力します

構文
printf(string($format), mixed($value));

$format：書式文字列
$values：書式に埋め込む文字列

書式文字列$formatには、変換指定子と呼ばれるプレイスホルダーを埋め込むことができます。
プレイスホルダーとは、引数$valuesで指定された文字列を埋め込む場所と考えればよいでしょう。
変換指定子は、「%指定子」の形式で表せます。
*/
printf('%sは%sです。','ニンザブロウ','ハムスター');//結果 ニンザブロウはハムスターです。
/*
%s = 引数を文字列と見なして処理（データ型）
*/
print '<br/>';
printf('売上平均(前月比):%+0-8.3f',0.198765);//結果 売上平均(前月比):+0.19900
/*
+ = 符号の指定  0 = 不測桁の埋め  - = 左/右寄せ  8 = 全体桁数  .3 = 小数点以下桁数  f = 引数を浮動小数点として表現（データ型）
*/
print '<br/>';
printf("売上平均(前月比):%'*10.3e",0.198765);//結果 売上平均(前月比):**1.988e-1
/*
' = パディング指定子(不足している桁を埋めるための文字)。パディング指定子に「」（空白）、「0」以外の値を指定する場合、サンプルのように指定子の前に「'」を置く必要がある。
    パディング指定子に「*」を指定する例です。この場合、1.988e1が10桁から2桁不足しているので、2つの「*」で補われます。
*/
print '<br/>';
printf("%.6sは%sです", 'ニンザブロウ', 'ハムスター');//結果 ニンはハムスターです
/*
UTF8は1文字を3バイトで表現するので、「.6」は2文字を表します。
*/
print '<br/>';
printf('%2$sは%1$sです。%2$s、大好き', 'ニンザブロウ', 'ハムスター');//結果 ハムスターはニンザブロウです。ハムスター、大好き
/*
引数$valuesを指定順ではなく、任意の順番で書式文字列に埋め込みたい場合の例
*/
print '<br/>';

printf('%sは%sです。','ニンザブロウ','ハムスター');//結果 ニンザブロウはハムスターです。
print '<br/>';
print sprintf('%sは%sです。','ニンザブロウ','ハムスター');//結果 ニンザブロウはハムスターです。
print '<br/>';
vprintf('%sは%sです。',['ニンザブロウ','ハムスター']);//結果 ニンザブロウはハムスターです。
print '<br/>';
print vsprintf('%sは%sです。',['ニンザブロウ','ハムスター']);//結果 ニンザブロウはハムスターです。
print '<br/>';

//5.2.13 文字エンコーディングを変換する  mb_convert_encoding関数
/*
mb_convert_encoding('$string', '$to_encoding', '$from_encoding');

$string = 任意の文字列
$to_encoding = 変換後の文字コード
$from_encoding = 変換前の文字コード
*/
file_put_contents('result.txt', mb_convert_encoding('こんにちは、赤ちゃん!','UTF8','UTF8, JIS, JIS'));
