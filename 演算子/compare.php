<?php
//3.3.1 文字列混在の比較
/*
等価演算子「==」は、数値と文字列を比較するときに、文字列を数値に変換した上で比較しようとします。
また、文字列同士の比較であっても、数値形式の文字列である場合には、同じく数値に変換したものを比較しようとします。
*/
var_dump('3.14' == 3.14000);//結果 bool(true)
var_dump('3.14E2' == 314);//結果 bool(true)
var_dump('0x10' == 16);//結果 bool(false)
var_dump('010' == 8);//結果 bool(false)
var_dump('13xyz' == 13);//結果 bool(true)
var_dump('X' == 0);//結果 bool(true)
var_dump('3.14' == '3.14000');//結果 bool(true)
var_dump('3.14E2' == '314');//結果 bool(true)
var_dump('13xyz' == '13');//結果 bool(false)