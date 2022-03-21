<?php

//6.5 ジェネレーター
/*
ジェネレーター（Generator）の見た目は、普通の関数です。
しかし、普通の関数がreturn命令で値を返したらそれで終わりであるのに対して、
ジェネレーターはyieldという命令を利用することで、つど、その時どきの値を返せる点が異なります。
*/
function myGen(){
    yield 'あいうえお';
    yield 'かきくけこ';
    yield 'さしすせそ';
}
foreach(myGen() as $value){
    print $value.'<br/>';
}
//結果 あいうえお かきくけこ さしすせそ
/*
yieldは、returnとよく似た命令で、関数の値を呼び出し元に返します。
しかし、return命令がその場で関数の実行を終了する(いつも最初から実行)のに対して、
yield命令は処理を一時停止します(中断された箇所から実行を再開)。
つまり、次に呼び出されたときには、その時点から処理を再開できます。
*/

//6.5.1 素数を求めるジェネレーター
//素数を求めるジェネレーター関数
function getPrimes(){
    $num = 2;
    //素数の開始値//2から順に素数判定し、素数の場合にだけyield（無限ループ）
    while(true){
        if(isPrime($num)){
            yield $num;
        }
        $num++;
    }
}
//引数$valueが素数かどうかを判定
function isPrime(int $value):bool{
    $prime = true;//素数かどうかを表すフラグ
    //2～sqrt($value)で、$valueを割り切れる（余りが0）のものがあるか
    for($i = 2;$i <= floor(sqrt($value));$i++){
        if($value % $i === 0){ 
            $prime = false;//割り切れるものがあれば素数でない
            break;
        }
    }
    return $prime;
}
//素数を順に出力
foreach(getPrimes() as $prime){
    //素数が101以上になったら終了（これがないと無限ループになるので注意！）
     if($prime > 100){
         die();
    }
    print $prime.',';
}//結果 2,3,5,7,11,13,17,19,23,29,31,37,41,43,47,53,59,61,67,71,73,79,83,89,97,

//6.5.2 ジェネレーターの結果を取得する
/*
ジェネレーター関数でもreturn命令は利用できます。その場合、return命令はジェネレーターの最終的な結果を表します。
*/
function readLines(string $path){
    $i=0;//行数
    $file = fopen($path,'rb') or die('ファイルが見つかりません');
    //行単位にテキストを取得＆yield
    while($line = fgets($file,1024)){
        $i++;
        yield $line;
    }
    fclose($file);
    //読み込んだテキストの行数を返す
    return $i;
    //一般的にreturn命令を呼び出すのは、ジェネレーターがすべての処理を終えたタイミング。
}
//sample.datから行単位にテキストを出力
$gen = readLines('sample.dat');

foreach($gen as $line){
    print $line.'<br/>';
}
//最終的に読み込んだ行数を取得
print "{$gen->getReturn()}行ありました";//結果 6行ありました。
//return命令で返された値を取得するには、GeneratorオブジェクトのgetReturnメソッドを利用する

/*
仮に、上限を区切って10万個までの素数を求めるとしても、10万個の値を格納するための配列を用意しなければなりません。
これだけのメモリを消費するのは、直感的にも望ましい状態ではありません。
しかし、ジェネレーターを利用することで、yield命令のタイミングでつど、値が返されるので、メモリ消費もその時どきの状態を監視する最小限で済みます。
なにかしらのルールに従って、値セットを生成するような用途では、ジェネレーターをお勧めします。
*/

//6.5.3 一部の処理を他のジェネレーターに委譲する
/*
yield from命令を利用することで、ジェネレーターの中で別のジェネレーター、または配列を呼び出し、これを列挙できます
*/
function readFiles(string...$files){
    //配列から順にファイルパスを取り出す
    foreach($files as $file){
        //ジェネレーターreadLinesに処理を委ねる
        yield from readLines($file);
    }
}
function readLines_3(string $path){
    $file=fopen($path,'rb')or die('ファイルが見つかりません');//行単位にテキストを取得
    while($line = fgets($file,1024)){
        yield$line;
    }
    fclose($file);
}
//sample.dat／sample2.datの内容を順に列挙
foreach(readFiles('sample.dat','sample2.dat') as $line){
    print$line.'<br/>';
}