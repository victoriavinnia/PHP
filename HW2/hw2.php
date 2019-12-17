<?php
/*Задача на цикл(ы) for: Вывести таблицу умножения, чтобы получилось:

    1 2 3
    2 4 6
    3 6 9 и тд*/
$a = 9; // количество строк $tr
$b = 9; // количестов столбцов $td
echo '<table>';
for ($tr = 1; $tr <= $a; $tr++) {
    echo '<tr>';
    for($td = 1; $td <= $b; $td++) {
        echo '<td>' . $tr * $td . '</td>';
    }

    echo '</tr>';

}
echo '</table>';

/*Задача на циклы:
    Дано:
    $x - количество километров, которые спортсмен пробежал в первый день
    $y - количество километров.  По данному числу нужно определить номер дня.

В первый день спортсмен пробежал $x километров, а затем он каждый день увеличивал пробег на 10% от предыдущего значения.
По заданному числу $y определить номер дня, на который пробег спортсмена составит не менее $y километров.*/
$x = 6;
$y = 10;
$day = 1;

for($day = 1; $x <= $y; $day++) {
    if ($day == 1) {
        var_dump($x);
        var_dump($day);
    }
    if ($day != 1) {
        $x = $x * 1.1;
        var_dump($x);
        var_dump($day);
    }
    if ($x - $y > 0) {
        var_dump($day);
    }
}
/*Задача на while или for. Дано число $num=800. Делите его на 2 столько раз, пока результат деления не станет меньше 50.
Какое число получится?
Посчитайте количество итераций, необходимых для этого (итерация - это проход цикла).*/
$num=800;
for($i = 0; $num >= 50; $i++) {
    $num /= 2;
    if ($num < 50) {
        var_dump('Понадобится '.$i.' итерации');
        break;
    }
    var_dump($num);
}


/*Посмотреть функции для работы с массивами и ответить на следующие вопросы (это задание проверим в начале занятия):

1. С помощью какой функции можно разбить данный массив на переменные $title и $pageCount:

    $book = ['title'=>'PHP 7',
        'pageCount' => 342];

2. Функция, которая возвращает количество элементов в массиве?
3. Как проверить наличие значения в массиве?
4. Чем отличаются array_replace_recursive и array_replace?
5. Как работает функция compact?*/

// 1. С помощью какой функции можно разбить данный массив на переменные $title и $pageCount:

$book = ['title'=>'PHP 7', 'pageCount' => 342];
var_dump(array_chunk($book, 1));

// 2. Функция, которая возвращает количество элементов в массиве?
var_dump(count($book));

// 3. Как проверить наличие значения в массиве?
var_dump(in_array('PHP 7', $book));
var_dump(in_array('title', $book));
var_dump(in_array('page', $book));

// 4. Чем отличаются array_replace_recursive и array_replace?
$base = array('citrus' => array( "orange") , 'berries' => array("blackberry", "raspberry"), );
$replacements = array('citrus' => array('pineapple'), 'berries' => array('blueberry'));

$basket = array_replace_recursive($base, $replacements);
print_r($basket);

$basket = array_replace($base, $replacements);
print_r($basket);

//5. Как работает функция compact?
$a = 31;
$s = 3;
$w = 54;
$location_vars = array("a", "s");
$re = compact("w", $location_vars);
var_dump($re);

/*Отсортировать массив, который находится в файле lesson2/task.php, по 'price'.
При решении использовать функции для работы с массивами.*/

$arr = [
    '1'=> [
        'price' => 10,
        'count' => 2
    ],
    '2'=> [
        'price' => 5,
        'count' => 5
    ],
    '3'=> [
        'price' => 8,
        'count' => 5
    ],
    '4'=> [
        'price' => 12,
        'count' => 4
    ],
    '5'=> [
        'price' => 8,
        'count' => 4
    ],
];
/*foreach ($arr as $key => $value) {
    $price[$key]  = $value['price'];
}*/
$price  = array_column($arr, 'price');
var_dump($price);
array_multisort($price, SORT_DESC, $arr);
var_dump($arr);
echo $arr;