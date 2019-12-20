<?php
// 1. Создать функцию по преобразованию нотаций: строка вида 'this_is_string'
// преобразуется в 'thisIsString' (CamelCase-нотация)
$str = 'this_is_string';
//explode — Разбивает строку с помощью разделителя
// implode — Объединяет элементы массива в строку
// ucwords — Преобразует в верхний регистр первый символ каждого слова в строке
function changeStr ($some_str) {
    $new_str = ucwords(implode(' ', explode('_', $some_str)));
    $new_arr = implode('', explode(' ', $new_str));
    return $new_arr;
}
var_dump(changeStr($str));

// 2. Дана строка, содержащая полное имя файла (например, 'C:\OpenServer\testsite\www\someFile.txt').
// Написать функцию, которая сможет выделить из подобной строки имя файла без расширения.
$str = 'C:\OpenServer\testsite\www\someFile.txt';
//strstr — Находит первое вхождение подстроки (Если установлен в TRUE, strstr()
// возвращает часть строки haystack до первого вхождения needle (исключая needle).
// array_intersect — Вычисляет схождение массивов
function typeStr($some_str) {
    // создание строки someFile.txt, разбивка на элементы массива
    $new_str1 = explode('.',substr(strrchr($some_str, '\\'), 1));
    // создание строки C:\OpenServer\testsite\www\someFile, разбивка на элементы массива
    $new_str2 = explode('\\', strstr($some_str, '.', true));
    //вычисляем схождение массивов и объединяем их в строку
    $res = implode('', array_intersect($new_str1, $new_str2));

    return $res;
}
var_dump(typeStr($str));
// 3. Дано два текста. Определите степень совпадения текстов
// (придумать алгоритм определения соответствия, использовать 5 балльную шкалу).
$text1 = "Hello, world!";
$text2 = "Hello, w";
function compareText ($some_text1, $some_text2) {
    similar_text($some_text1, $some_text2,$perc);
    if($perc == 0) {
        echo 'нет совпадений';
    } elseif ($perc > 0 && $perc < 20){
        echo 'степень совпадения: 1 балл';
    } elseif ($perc >= 20 && $perc < 40) {
        echo 'степень совпадения: 2 балла';
    } elseif ($perc >= 40 && $perc < 60) {
        echo 'степень совпадения: 3 балла';
    } elseif ($perc >= 60 && $perc < 80) {
        echo 'степень совпадения: 4 балла';
    } elseif ($perc >= 80 && $perc < 100) {
        echo 'степень совпадения: 5 баллов';
    }
    return $perc;
}
var_dump(compareText($text1, $text2));

// 4. Дан массив, состоящий из целых чисел. Написать функцию сортировки массива по возрастанию суммы цифр чисел.
//Например, дан массив [13, 55, 100]. После сортировки он будет следующего вида: [100, 13, 55], тк сумма цифр числа 100 = 1,
//сумма цифр числа 13 = 4, а 55 = 10.
//На экран вывести исходный массив, массив после сортировки и сумму цифр каждого числа отсортированного массива.
$arr = [13, 55, 100];
// ПОЛУЧИЛОСЬ ОЧЕНЬ ДЛИННОЕ РЕШЕНИЕ... НЕ ПОНИМАЮ КАК СДЕЛАТЬ ЕГО КОРОЧЕ
function sortArr($some_arr){
    var_dump($some_arr);
    $arr1 = [];
    for ($i = 0; $i < count($some_arr); $i++) {
        $num = $some_arr[$i];
        $summ = 0;
        //      echo $num. '<br>';

        while (abs($num)) {
            $summ += abs($num) % 10;
            $num /= 10;
        }
        $arr1[] = $summ;
        echo 'Сумма цифр элемента: ' . $summ . '<br>';
    }
    $arr3 = array_combine($some_arr, $arr1);
    var_dump($arr3);
    asort($arr3);
    foreach ($arr3 as $key => $value) {
        echo $key.' : '.$value.'<br>';
    }
    $arr4 = [];
    foreach ($arr3 as $key => $value) {
        $arr4[] = $key;
    }
    var_dump($arr4);
}
sortArr($arr);

// 5. Написать функцию - конвертер строки (функция принимает на вход строку и функцию-преобразователь,
// возвращает преобразованную строку). Использовать анонимные функции. Возможности:
//    перевод всех символов в верхний регистр,
//    перевод всех символов в нижний регистр,
//    перевод всех символов в нижний регистр и первых символов слов в верхний регистр.

$str = "She gOes to school";

//    перевод всех символов в верхний регистр,
$upcase = function ($some_str) {
    return strtoupper($some_str);
};

//    перевод всех символов в нижний регистр,
$lcase = function ($some_str) {
    return strtolower($some_str);
};

//    перевод всех символов в нижний регистр и первых символов слов в верхний регистр.
$firstup = function ($some_str) {
    return ucwords(strtolower($some_str));
};
//    перевод всех символов в нижний регистр и первых символов слов в верхний регистр.
function find_by_param(string $some_str, callable $func) : string
{
    if ($func($some_str)) {
        return $func($some_str);
    }
}
var_dump(find_by_param($str, $upcase));
var_dump(find_by_param($str, $lcase));
var_dump(find_by_param($str, $firstup));