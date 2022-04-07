<?php

/*
プログラム上で扱う対象をオブジェクト（モノ）に見立てて、
オブジェクトを中心にコードを組み立てていく手法のことをオブジェクト指向プログラミングと言います。
近年ではオブジェクト指向プログラミングの隆盛に伴い、PHPでもオブジェクト指向プログラミングに対応した
オブジェクト指向型のライブラリ（クラスライブラリ）が多く提供されるようになっています。
*/

//7.1 オブジェクト指向プログラミングの基本
//7.1.1 クラスと関数/変数
/*
関数とは与えられた入力（引数）に対して、処理結果を戻り値として出力するだけの仕組みでした。
データは関数を通過していくだけで、その中に留まるものではありません。
これに対して、クラス（オブジェクト）は自分自身でデータを持つことができます。
処理前、または処理後のデータを保存しておき、必要に応じて別の用途で利用できるのです。

変数は データ保持○ データ処理×
関数は データ保持× データ処理○
クラス/オブジェクト データ保持○ データ処理○
*/

//7.1.2 クラスとオブジェクトの関係
/*
クラスとオブジェクトは本質的には異なる。
クラスをモノの作りを表す「設計図」や「金型」であるとするならば
オブジェクトは設計図や金型をもとに作られた実際のモノです。
なので同一のクラスは一つしか存在しません。
クラスを元に作られたオブジェクトは複数存在する可能性があります。
*/

//7.1.3 インスタンス化とメンバーの呼び出し
/*
クラスをもとにしてコピーを作る作業のことをインスタンス化、インスタンス化によってできる複製のことをインスタンス（オブジェクト）と呼びます。
インスタンス化とは、クラスを扱うために「自分専用の領域」を確保する行為と言ってもよいでしょう。
クラスをインスタンス化するには、new演算子を利用します。
*/
/* 構文
$変数名 = new クラス名([引数,……])
*/

/*
インスタンス化によってできたオブジェクトは「$変数名」に格納されます。オブジェクトが格納された変数のことをオブジェクト変数と呼ぶ場合もあります。
クラス（オブジェクト）に属する関数と変数のことを、それぞれメンバー関数／メンバー変数、またはメソッド／プロパティと呼びます。
オブジェクトのメソッド／プロパティは、それぞれアロー演算子（－>）で呼び出せます
*/
/* 構文
[戻り値=]オブジェクト変数->メソッド名([引数,……])
オブジェクト変数->プロパティ名[=値]
*/

//null安全演算子（?->）
/*
PHP8以降では、「?->」（null安全演算子）が追加され、「オブジェクトが非nullのときだけ、そのメンバーにアクセスしたい」
（＝nullの場合はそのままnullを返したい）という状況に対応できるようになりました。
*/
$dt = null;
print $dt?->format('Y年m月d日g:i:s');
//結果 何も表示されない($dtがnullでもエラーにならない)
/*
PHP7までは、以下のように変数$dtがnullであるかどうかを判定してから、メソッドにアクセスしなければなりませんでした。
*/
$dt = null;
$result = null;
//$dtがnullでない場合にだけformatメソッドにアクセス
if($dt !== null){
    $result = $dt->format('Y年m月d日g:i:s');
}

//7.1.4 静的メソッド/静的プロパティ
/*
ただし、メソッドやプロパティの種類によっては、例外的にオブジェクトを生成せずに呼び出せるものがあります。
このようなメソッド／プロパティのことをクラスメソッド／クラスプロパティ、または静的メソッド／静的プロパティと呼びます。
静的メソッド／静的プロパティは、それぞれ「::」演算子で呼び出すことができます。
呼び出し元が（オブジェクト変数ではなく）クラスである点に注目です。
静的メソッド／静的プロパティに対して、オブジェクト経由で呼び出すメソッド／プロパティのことをインスタンスメソッド／インスタンスプロパティと呼びます。
なお、クラスの中で定義された定数（クラス定数）にアクセスする場合にも、同じく「::」演算子を利用できます。
*/
/* 構文
[戻り値=]クラス名::メソッド名([引数,……])
クラス名::プロパティ名[=値]
*/
/* メンバーの種類とアクセス方法
インスタンスメソッド ->
静的メソッド/静的プロパティ ::
*/

//7.2 DateTimeクラス
//DateTimeクラスは、日付／時刻の演算や整形を行うためのクラスです。
//7.2.1 DateTimeオブジェクトの生成
//(1)現在の日付/時刻から生成
$now = new DateTime();
print $now->format('Y年m月d日 H:i:s');//結果 2022年04月07日 04:15:30
/*
引数なしでDateTimeオブジェクトを生成した場合、DateTimeオブジェクトには現在の日時がセットされます。
formatメソッドは、DateTimeオブジェクトの内容を整形するためのメソッドです。
*/
print '<br/>';

//(2)日付/時刻文字列から生成
$now = new DateTime('2022/4/7 04:15:20');
print $now->format('Y年m月d日 H時i分');//結果 2022年04月07日 04時15分

print '<br/>';
//(3)タイムゾーンを指定する
$dt1 = new DateTime(null,new DateTimeZone('Asia/Ulan_Bator'));
print $dt1->format('Y年m月d日H時i分');//結果：2022年04月07日12時21分

print '<br/>';
$dt2 = new DateTime(null,new DateTimeZone('America/Virgin'));
print $dt2->format('Y年m月d日H時i分');//結果：2022年04月07日00時21分

print '<br/>';
$dt3 = new DateTime(null,new DateTimeZone('Europe/London'));
print $dt3->format('Y年m月d日H時i分');//結果：2022年04月07日05時22分


print '<br/>';
//(4)年月日、時分秒を個別に設定する
$now = new DateTime();
$now->setDate(2021, 6, 25);
$now->setTime(14, 70, 59);
print $now->format('Y年m月d日 H:i:s');//結果 2021年06月25日 15:10:59

print '<br/>';
//(5)タイムスタンプ値を設定する
/*
Unixタイムスタンプ（タイムスタンプ）とは、日付／時刻値を1970年01月01日00:00:00からの経過秒で表現したものです。
timeは、現在の日時のタイムスタンプを求めるための日付／時刻関数です。
setTimestampメソッドは、このようにタイムスタンプ値を返す関数からDateTimeオブジェクトを生成するのに役立ちます。
*/
$now = new DateTime();
$now->setTimestamp(time());
print $now->format('Y年m月d日 H:i:s');//結果 2022年04月07日 04:27:37

print '<br/>';
 //7.2.2 日付/時刻値を指定のフォーマットで整形する formatメソッド
 $now = new DateTime();
 print $now->format('Y年m月d日 (D) g:i:s a');//結果 2022年04月07日 (Thu) 5:09:50 am
 print '<br/>';
 print $now->format('当日の日数: t日');//結果 当日の日数: 30日
 print '<br/>';
 print $now->format('L') ? '閏年です。':'閏年ではありません。';//結果 閏年ではありません。//L = 閏年であるか判別
 print '<br/>';
 print $now->format(DateTime::RSS);//結果 Thu, 07 Apr 2022 05:13:09 +0000

 print '<br/>';
 //7.2.3 日付/時刻文字列を解析する createFromFormatメソッド
 /*
 createFromFormat静的メソッドは、指定した書式文字列で日付／時刻文字列を解析（パース）し、DateTimeオブジェクトを生成します
 */
$fmt = 'Y年m月d日H時i分s秒';
$time = '2021年05月15日11時58分32秒';
$dt = DateTime::createFromFormat($fmt,$time);
print $dt->format('Y-m-d H:i:s');//結果 2021-05-15 11:58:32

print '<br/>';
//7.2.4 日付/時刻値を加算/減産する add/subメソッド
$dt = DateTime::createFromFormat($fmt,$time);
print $dt->format('Y年m月d日 H時i分');//結果 2021年05月15日 11時58分
$dt->add(new DateInterval('P1YT10H'));//「P＜日付間隔＞T＜時間間隔＞」の形式で、日付／時間間隔は「数値+単位」の形式で表します。
print $dt->format('Y年m月d日 H時i分');//結果 2022年05月15日 21時58分
$dt->sub(new DateInterval('P3MT20M'));
print $dt->format('Y年m月d日 H時i分');//結果 2022年02月15日 21時38分

print '<br/>';
//7.2.5 日付/時間値の差分を取得する diffメソッド
$dt1 = new DateTime('2021/5/15 10:58:31');
$dt2 = new DateTime('2021/12/04');
$interval = $dt1->diff($dt2,true);
print $interval->format('%Y年%M月%d日%H時間%I分%');//結果 00年06月18日13時間01分

print '<br/>';
//7.2.6 日付/時刻関数
//カレンダーをテキスト表示するcalendar関数（引数$yearは年、$monthは月）
function calendar(int $year,int $month):void{
    //1～31までの間でループ処理
    for($i=1;$i<32;$i++){//日付（$i）が該当月の妥当な日である場合のみ表示
        if(checkdate($month,$i,$year)){
            print "{$i}&nbsp;";
        }
    }
}
print '2024年2月のカレンダー';
calendar(2024,2);