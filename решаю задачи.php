<?php
/*Создайте 3 переменные, все с числовыми значениями при помощи if проверьте, если первая переменная больше второй, то ее сравниваем с третьей переменной Если же вторая больше первой, то ее сравниваем с третьей Для этого используйте только if конструкцию, без логических операторов*/
$a = 24;
$b = 39;
$c = 50;

if($a > $b)
{
    return $a > $c;
} else{
    return $b > $c;
}


//Перепишите задачу №3 в одно условие if используя тернарный оператор
//$result = (bool) ($a > $b) ? ($a > $c) : ($b > $c);

//Вывести цифры от 3 до 10. А после 10 выводится 15 - 20
for($i = 3; $i <= 20; $i++)
{
    if ($i >= 10 && $i <= 15)
    {
      continue;
    }
    echo $i;
}



//На вход подается строка целых чисел, разделенных пробелами.Найдите максимальную разницу между двумя элементами строки при условии, что меньшее число должно находиться справа от большего.Например, для строки "1 6 4 3" правильный ответ: "3" (6-3)
echo "<br><hr>";
$line = '1 2 6 4 2';
$nums = explode(' ', $line);

$numsCount = count($nums);
$maxDiff = null;
foreach ($nums as $key => $num1) {
    for ($j = $key + 1; $j < $numsCount; $j++) {

        $num2 = $nums[$j];

        if ($num1 <= $num2) {
            continue;
        }

        if ($maxDiff === null) {
            $maxDiff = $num1 - $num2;
            continue;
        }

        $maxDiff = max($maxDiff, $num1 - $num2);
    }
}
echo $maxDiff;
echo "<hr>";




//На вход подается строка целых уникальных (не повторяющихся) чисел, разделенных пробелами (elements).Найдите все возможные комбинации заданной длины. Выведите их в любом порядке.
$str = '2 4 5 6 5';
$nums = explode(' ', $str); //сделали массив из строки
$count = (int)trim($str); //разделили строку пробелами
function find(array $array, int $count): array
{
    if ($count === 1) {
        return $array;
    }

    $lowLevelCombinations = find($array, $count - 1);

    $currentLevelCombinations = [];
    foreach ($array as $item) {
        foreach ($lowLevelCombinations as $lowLevelCombination) {
            $currentLevelCombinations[] = trim($item . ' ' . $lowLevelCombination);
        }
    }
    return $currentLevelCombinations;
}

foreach (find($nums, $count) as $combination) {
    echo $combination . PHP_EOL;
}





// Дана строка 'ahb acb aeb aeeb adcb axeb'. Напишите регулярку, которая найдет строки ahb, acb, aeb по шаблону: буква 'a', любой символ, буква 'b
$subject = 'aa aba abba abbba abca abea';
$pattern = "~ab+a~";
preg_match_all($pattern, $subject, $matches);
print_r($matches);





//Дано число $num с неким начальным значением. Умножайте его на 3 столько раз, пока результат деления не станет больше 1000. Какое число получится? Посчитайте количество итераций, необходимых для этого
$num = 20;
$number = 0;
while($num < 1000){
    $num = $num*3;
    echo $num . '<br>';
    $number++;
}
echo '<br>' . $number;






//На вход подается строка из чисел, разделенных пробелами. Найдите максимальное произведение двух чисел из этой строки
$line = '-11 -10 -4 -19 -10';
$line = explode(' ', $line);

$max = $line[0];
foreach($line as $key=>$value){
    foreach($line as $k=>$v){
        if($k === $key){
            continue;
        }
        $result = $value*$v;
        if($result >$max){
            $max = $result;
        }
    }
}
echo $max;
echo '<hr>';





//Найдите наиболее часто встречающееся число в строке.
$line = '1 2 3 2 4 4 2 5';
$nums = explode(' ', $line);

$nums2Freq = [];
$currentMaxFreq = 1;
$currentMaxNum = $nums[0];
foreach ($nums as $num) {
    if (!isset($nums2Freq[$num])) {
        $nums2Freq[$num]=1;
    } else {
        $nums2Freq[$num]++;
    }
    if ($nums2Freq[$num] > $currentMaxFreq) {
        $currentMaxFreq = $nums2Freq[$num];
        $currentMaxNum = $num;
    }
}
echo $currentMaxNum . '<hr>';





//находим все простые числа от 0 до $q
function aPrimeNumber($q){
    for($r=1; $r<=$q; $r++){
        $flag = true;
        for($i = 2; $i < $r; $i++){

            if($r % $i === 0){
                $flag = false;
                break;

            }
        }
        if($flag == true){
            echo "число $r простое";
        }
        else{
            echo "число $r не простое";
        }
    }
}
aPrimeNumber(37);





//Найдите сумму ключей этого массива и поделите ее на сумму значений.
$arr = [];
$arr = [1 => 6, 2 => 7, 3 => 8, 4 => 9, 5 => 10];
$sumKey = 0;
$sumValue = 0;
foreach($arro as $key => $value){
    $sumKey += $key;
    $sumValue += $value;
    $result = $sumKey / $sumValue;
}print_r($result);





//Переместите все нули в конец строки. Порядок остальных чисел должен сохраниться.
echo '<hr>';
$line = '7 0 39 0 282 2 4 0 45';
$numberOfZeros = 0;
$line = explode(' ', $line);

foreach($line as $key => $value){
    if($line[$key] == 0){
        unset($line[$key]);
        $numberOfZeros++;
    }
}
if($numberOfZeros > 0){
    for($i = $numberOfZeros; $i > 0; $i-- ){
        $line[] = 0;
    }
}
$line = implode(' ', $line);
echo $line;

echo '<hr>';





//Найдите все возможные комбинации пар чисел и выведите их в любом порядке
/*Input
1 2 3
Output
1 2
1 3
2 1
2 3
3 1
3 2*/

$line = '5 8 6 3';
$line = explode(' ', $line);
$ress = null;
foreach($line as $value){
    foreach($line as $v){
        if($v !== $value){

            $ress = $v. $value . PHP_EOL;
            echo $ress;
        }
    }
}
echo '<hr>';





//Дан массив с числами. Переберите его циклом и в каждой итерации цикла выведите два предыдущих элемента массива.
$line = [1, 2,4,5,6,7];
foreach($line as $key => $value){
    echo $line[$key-2] . $line[$key-1] . '<br>';
}
echo '<hr>';





//получение чисел fibonacci
$result = '';
$fib = 0;
$num1 = 0;
$num2 = 1;
$num3 = 2;
for($i = 0; $i < 10; $i++){
    $fib = $num1 + $num2 + $num3;
    $num1 = $num2;
    $num2 = $num3;
    $num3 = $fib;
    echo $fib . '<br>';
}
echo '<hr>';





//Дана строка с целыми числами. С помощью регулярного выражения преобразуйте строку так, чтобы вместо этих чисел стояли их квадраты.
$str = '2 3 3 5 7 8';

$res = preg_replace_callback('~\d{1}? ~', function($matches){ //используем анонимную функцию для суммирования и вывода аргуметов в строке

    $result = 'квадрат ' . $matches[0];
    $result .= '= ' . $matches[0] * $matches[0] . '<br>';
    return $result;

}, $str);
echo '<pre>';
print_r ($res);
echo '</pre>';
unset($res);




//На вход подается строка целых чисел, разделенных пробелами. Нужно найти последовательность подряд идущих чисел, у которой сумма элементов будет максимальной
$line = "-100 1 -3 4 -1 15 1 -500";
$nums = explode(' ', $line);
$numsCount = count($nums);

$maxSumCurrent = $nums[0];
$maxSumTotal = $nums[0];

for ($i = 1; $i < $numsCount; $i++) {
    $num = $nums[$i]; //значение с ключом 1 потом с ключом 2, 3...7

    $maxSumCurrent += $num;	//теперь переменная равна сумме значений с первым и вторым ключом

    if ($maxSumCurrent < $num) {
        $maxSumCurrent = $num; // если сумма первых двух значений меньше, чем второе значение, то $maxSumCurrent = второму значению
    }

    if ($maxSumCurrent > $maxSumTotal) {
        $maxSumTotal = $maxSumCurrent;
    }
}



//На вход подается строка из чисел, разделенных пробелами. Замените каждый элемент строки произведением всех других элементов.
$line = '4 1 5 5 2 1 2';
$q = explode(' ', $line);

foreach ($q as $key => $value){
    if($value != 0){
        $newValue = array_product($q) / $value;
    }
    else{
        unset($q[$key]);
        $newValue = array_product($q);
        $q[$key] = 0;
    }
    echo $newValue . ' ';
}




// Вывести числа Фибоначчи, количество которых равно $line
$line = 0;

function Fib($line){
    if($line == 0){
        $result = [];
        $result = implode($result);
    }

    elseif($line == 1){
        $result = [0];
        $result = implode($result);
    }

    else{
        $arFib = [0, 1];

        for($i = 2; $i < $line; $i++){
            $endKey = end($arFib);
            $prevEndKey = prev($arFib);
            $sum = $endKey + $prevEndKey;
            $arFib[] = $sum;
        }
        $result = implode(' ', $arFib);
    }
    return $result;
}
echo Fib($line);




//Если в массиве В есть значения, совпадающие со значениями из массива А, их следует удалить. Вывести значения из А, сохраняя их порядок
function arrayDiff($a, $b) {
    $result = [];

    foreach($a as $key => $value) {
        if(in_array($value, $b)) continue;
        else {
            $result[] = $value;
        }
    }
    return $result;
}
print_r(arrayDiff([1,2,3,4,5], [2,3]));




//Определить, сколько согласных содержится в строке и передать их количество (англ).
$str = 'abracadabra';
function getCounts($str) {
    $vowelsCount = 0;
    $newstr = str_split( $str, 1);
    $vowels = ['a','e','i','o','u'];
    foreach ($newstr as $v){
        if(in_array($v, $vowels))
        {
            $vowelsCount++;
        }
    }
    return $vowelsCount;
}
echo getCounts($str);




/* Строку такого формата:
"the-stealth-warrior" конвертировать в такой формат: "theStealthWarrior"    (первый символ в нижнем регистре - значит первый символ в результате - в нижнем регистре)
"The_Stealth_Warrior" конвертировать в такой формат: "TheStealthWarrior"    (первый символ в верхнем регистре - значит первый символ в результате - в верхнем регистре)
 */
function toCamelCase($str){
    $result = '';
    if(preg_match('~[A-Z]~', $str[0])){
        if(preg_match('~[_]~', $str)){
            $arr = explode('_', $str);
            foreach ($arr as $value) {
                $value = ucwords($value);
                $result .= $value;
            }
        }
        else{
            $arr = explode('-', $str);
            foreach ($arr as $value) {
                $value = ucwords($value);
                $result .= $value;
            }
        }
    }
    else{
        if(preg_match('~[_]~', $str)){
            $arr = explode('_', $str);
            foreach ($arr as $value) {
                $value = ucwords($value);
                $result .= $value;
            }
            $result = lcfirst($result);
        }
        else{
            $arr = explode('-', $str);
            foreach ($arr as $value) {
                $value = ucwords($value);
                $result .= $value;
            }
            $result = lcfirst($result);
        }
    }
    return $result;
}