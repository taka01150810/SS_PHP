<?php
//4.1 条件分岐
//4.1.1 if命令--単純分岐
/*
if(条件式){
    //条件式がtrueである場合に実行する処理
} else {
    //条件式がfalseである場合に実行する処理
}
*/
$x=10;
if($x === 10){
    print'変数$xは10です。';
}else{
    print'変数$xは10ではありません。';
}//結果：変数$xは10です。

print '<br/>';
/*
変数$xが10のときにだけ処理を実行したい場合にはelseブロックを省略してもかまいません。
*/
if($x === 10){
    print'変数$xは10です。';
}//結果：変数$xは10です。

print '<br/>';
//4.1.2 if命令 -- 多岐分岐
/*
if(条件式1){
    //条件式1がtrueである場合に実行する処理
}elseif(条件式2){
    //条件式2がtrueである場合に実行する処理}
}else{
    //条件式1、2、……がいずれもfalseである場合に実行する処理
}
*/
$x=35;
if($x > 20){
    print'変数$xは20より大きいです。';
}elseif($x > 10){
    print'変数$xは10より大きく、20以下です。';
}else{
    print'変数$xは10以下です。';
}//結果：変数$xは20より大きいです。

/*
変数$xは、条件式「$x>20」にも「$x>10」にも合致するのに、表示されるメッセージは「変数$xは20より大きいです。」だけ。
メッセージ「変数$xは10より大きく、20以下です。」も表示されない理由は複数の条件に合致しても、実行されるブロックは最初に合致した1つだけだからです。
*/
print '<br/>';
$x=35;
if($x > 10){
    print'変数$xは10より大きく、20以下です。';
}elseif($x > 20){
    print'変数$xは20より大きいです。';
}else{
    print'変数$xは10以下です。';
}//結果：変数$xは10より大きく、20以下です。

print '<br/>';
//4.1.3 if命令 -- 入れ子構造
/*
このように制御命令同士を入れ子に記述することをネストすると言う。
*/
$x = 1;
$y = 0;
if( $x === 1 ){
    if( $y === 1 ){
        print'変数$x、$yは1です。';
    }else{
        print'変数$xは1ですが、$yは1ではありません。';
    }
}else{
    print'変数$xは1ではありません。';
}//結果：変数$xは1ですが、$yは1ではありません

print '<br/>';
//4.1.4 中カッコは省略可能
$x = 10;
if($x === 10)
print '変数$xは10です。';
else
print '変数$xは10ではありません。';//結果 変数$xは10です。

/*
中カッコを省略した場合、elseブロックは直近のif命令に対応する
*/
$x = 1;
$y = 0;
if($x === 1){
    if($y === 1){
        print '変数$x、$yは1です。';
    }
} else {
    print '変数$xは1ではありません。';
}//結果：なにも表示されない

$x = 1;
$y = 0;
if($x === 1)
if($y === 1)
print '変数$x、$yは1です。';
else
print '変数$xは1ではありません。';
//結果：変数$xは1ではありません。

//4.1.5 条件式を指定する場合の注意点
//（1）bool型の変数を「==」「===」で比較しない
/*
if($flag == true)

if($flag)

//上記は意味が同じ

*/

//(2) falsyな値に注意
/*
mb_strpos／mb_strrpos関数の戻り値が0である場合、「=」「!=」演算子ではfalseとみなされてしまう。
0とfalseを区別するには、厳密な等価演算子を使う必要がある。
（!=）を「!==」で置き換えると、今度は意図した結果が得られる。
*/
$str = 'にわにはにわにわとりがいる';
if( mb_strpos($str,'にわ') != false){
    print'文字列が見つかりました。';
}//結果：なにも表示されない

//(3) 条件式からは出来るだけ否定を取り除く
/*
時として、思わぬバグの温床ともなるので要注意です。
特に否定＋論理演算子の組み合わせは、一般的な人間の感覚でわかりにくいので、できるだけ肯定表現に置き換えるべきです。
*/
/*
$flag1、2がともにtrueでない場合
if( !$flag1 && !$flag2 )
*/
/*
このような場合に利用できるのがド・モルガンの法則です。一般的に、以下の関係が成り立ちます。
!A && !B == !(A || B)
!A || !B == !(A && B)
*/

//4.1.6 if命令によるコメントアウト
if(false){
    print('コメントアウトするコード');
}//結果 コメントなのでなし

/*
条件式がfalse固定なので、ブロック配下のコードは常に実行されません。
条件式が定数（リテラル）であることから、定数条件式とも言います。
複数行に跨るコードをまとめてコメントアウトできるという意味では、// などと同じです。
*/
/*
ただし、もちろんメリットばかりではありません。
というのも、ifはもともとコメントアウトを目的とした構文ではありません。
濫用によって、本来の条件分岐とコメントとが区別しにくくなり、結果としてコードが読みにくくなるおそれもあります。
基本は、開発／本番環境の切り替えなど、限られた用途でのみの利用
*/

print '<br/>';
//4.1.7 switch命令 --多岐分岐
$rank = '甲';
if($rank == '甲'){
    print '大変良いです。';
}elseif($rank == '乙'){
    print '良いです。';
}elseif($rank == '丙'){
    print 'もう少しがんばりましょう。';
}else{
    print '？？？';
}//結果：大変良いです。

$rank='甲';
switch($rank){
    case'甲':
        print'大変良いです。';
    break;
    case'乙':
        print'良いです。';
    break;
    case'丙':
        print'もう少しがんばりましょう。';
    break;
    default:
        print'？？？';
    break;
}//結果：大変良いです。
/*
それぞれのcase句には複数の命令を記述できますが、その際、最後には必ずbreak命令を指定しなければならない点に注意してください。
break命令は、現在のswitchブロックから脱出するための命令です。
*/

print '<br/>';
//4.1.8 switch命令の判定方法
/*
switch命令は、式と値を（「===」演算子ではなく）「==」演算子で比較する点に注意してください。
「==」演算子はデータ型について寛容であるがために、時として思わぬ挙動をする場合があります。
*/
$exp = '3E2';
switch($exp){
    case 300:
        print '値は300';
    break;
    case 3E2:
        print '値は3E2';
    break;
}//値は300