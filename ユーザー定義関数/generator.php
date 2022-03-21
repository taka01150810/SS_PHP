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