<?php
//5.6 その他の関数
//5.6.1 数学関数
print abs(-100);//結果 100 abs = 絶対値
print '<br/>';
print base_convert(100, 2, 10);//結果 4 base_convert = $from -> $to進数への変換
print '<br/>';
print ceil(1234.56);//結果 1235 ceil = 小数点以下の切り下げ
print '<br/>';
print floor(1234.56);//結果 1234 floor = 小数点以下の切り上げ
print '<br/>';
print intdiv(10, 3);//結果 3 intdiv = $num1 / $num2 の整数商
print '<br/>';
print fmod(10.5, 5);//結果 0.5 fmod = $x / $y の余剰余
print '<br/>';
print max(1, 5, 3);//結果 5 max = 最大値
print '<br/>';
print min(1, 5, 3);//結果 1 min =  最小値
print '<br/>';
print rand(123.456, 2);//結果 ランダム $rand = $min〜$maxの乱数
print '<br/>';
print pow(2, 4);//結果 16 pow = $baseの$exp乗
print '<br/>';
print round(123.456, 2);//結果 123.46 round = 小数点以下$prec桁で数値を丸め
print '<br/>';
print sqrt(10000);//結果 100 sqrt = 平行根
print '<br/>';
print cos(deg2rad(60));//結果 0.5 cos = コサイン
print '<br/>';
print sin(deg2rad(30));//結果 0.5 sin = サイン
print '<br/>';
print tan(deg2rad(45));//結果 1 tan = タンジェント
print '<br/>';
print deg2rad(180);//結果 3.1415926535898 deg2rad() = 度->ラジアンに変換
print '<br/>';
print exp(1);//結果 2.718281828459 exp = eの($num)乗
print '<br/>';
print log10(100);//結果 2 底10の対数
print '<br/>';
print log(125, 5);//結果 3 対数