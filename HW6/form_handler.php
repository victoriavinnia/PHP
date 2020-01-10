<?php
$post = $_POST;
$url = $post['url'];
$submit = $post['submit'];
$url = trim($url);
//echo $url;

// проверка
function validate ($some_url) {
    if (!empty($some_url)) {
        $url_validate = filter_var($some_url, FILTER_VALIDATE_URL);
        if($url_validate) {
      //      echo "Данные введены верно".'<br>';
            return true;
        } else {
      //     echo "Данные введены не верно".'<br>';
            return false;
        }
    } else {
        echo "Введите ссылку!".'<br>';
    }
}
//validate($url);

// $filename = 'url.txt';

function write_files($some_url) {
    if (validate($some_url) == false) {
        echo "Данные введены не верно".'<br>';
        return;
    }
    $filename = 'url.txt';
  //  var_dump($filename);
    $fileArr = file('url.txt');
  //  var_dump($fileArr);
    foreach ($fileArr as $elem) {
        $dup = strpos($elem, $some_url); // находим повторы
        if ($dup !== false) {
            $elem = substr(strrchr($elem, ' '), 1);
            echo "Ссылка из базы: <a href='$some_url'>$elem</a><br>"; // если повторы есть выводим короткую ссылку на экран
            return;
        }
    }
    $h = "QqWwEeRrTtYyUuIiOoPpAaSsDdFfGgHhJjKkLlZzXxCcVvBbNnMm1234567890"; // символы,
    // из которых будет состоять наш рандом
    $short_url = substr(str_shuffle($h), 0, 6);
    $fp = fopen($filename, 'a');
    fwrite($fp, "
$some_url : $short_url");
    fclose($fp);
    echo "Новая ссылка: ".$short_url;
}
write_files($url);

/*//функция для внесения ссылки в файл
function write_files($some_filename, $some_url) {
    if (validate($some_url) !== false) {
//    $h = "QqWwEeRrTtYyUuIiOoPpAaSsDdFfGgHhJjKkLlZzXxCcVvBbNnMm1234567890"; // символы,
//    // из которых будет состоять наш рандом
//    $short_url = substr(str_shuffle($h), 0, 6);
    $arr_url = file($some_filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $short_url = generate($arr_url); // не понимаю, как здесь использовать функцию генерации коротких ссылок
    if (is_writable($some_filename)) {
  //      if (validate($some_url) !== false) {
            $fp = fopen($some_filename, 'a');
            fwrite($fp, "
$some_url : $short_url");
            fclose($fp);
        }
    // если отправлять пустую строку, все равно создается новая ссылка
        echo "Новая ссылка: ".$short_url;
    }
}
// write_files($filename, $url);


// функция поиска совпадений
function search($some_filename, $some_url) {
    $arr_url = file($some_filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $dup = '';
//   var_dump($arr_url);
    if (validate($some_url) !== false) {
        foreach ($arr_url as $elem) {
            $dup = strpos($elem, $some_url); // находим повторы
            if ($dup !== false) {
                $elem = substr(strrchr($elem, ' '), 1);
                echo "Ссылка из базы: <a href='$some_url'>$elem</a><br>"; // если повторы есть выводим короткую ссылку на экран
                return;
            }
        }
    }
    if (!$dup) {
        write_files($some_filename, $some_url); // если совпадений не найдено, записываем в файл
    }
}
search($filename, $url);


$arr_url = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
function generate($arr_url){
    $h = "QqWwEeRrTtYyUuIiOoPpAaSsDdFfGgHhJjKkLlZzXxCcVvBbNnMm1234567890"; // символы,
    // из которых будет состоять наш рандом
    $short_url = substr(str_shuffle($h), 0, 6);
    foreach ($arr_url as $elem){
        $word=trim(strrchr($elem,' '));
        if($word === $short_url){
            return generate($arr_url);
        }
    }
    echo $short_url;
}
//generate($arr_url);*/

