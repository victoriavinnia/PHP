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
            //Если здесь использовать trim, показывает, что "Данные введены не верно"
            //$url_validate = trim($url_validate);
            echo "Данные введены верно".'<br>';
            return;
        } else {
            echo "Данные введены не верно".'<br>';
            return;
        }
    } else {
        echo "Введите ссылку!".'<br>';
    }
}
//validate($url);

$filename = 'url.txt';

//функция для внесения ссылки в файл
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
//generate($arr_url);


//function write_files($some_filename, $some_url, $short_some_url)
//{
//    if (is_writable($some_filename)) {
//        if (validate($some_url) !== false) {
//            $fp = fopen($some_filename, 'a');
//            $arr_url = file($some_filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
//            foreach ($arr_url as $elem) {
//                $elem = strstr($elem, ' ', true);
//                var_dump($elem);
//                if (trim($some_url) === trim($elem)) {
//                    fclose($fp);
//                } else {
//                    fwrite($fp, "
//$some_url : $short_some_url");
//                }
//                    fclose($fp);
//                }
//            }
//        }
//}

//fwrite($fp, "
//$some_url : $short_some_url"); // перенос строки сделан, чтобы каждая ссылка была на новой строке. По другому не получалось
//}
//fclose($fp);
//write_files($filename, $url, $short_url);
//
//if($post['submit']) {
//    echo '<a href="#">'.$short_url.'</a>'.'<br>';
//}
//$filename2 = 'url2.txt';
//function repeat($some_filename, $some_filename2) {
//    $arr_url = file($some_filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
//    $arr_url = array_unique($arr_url);
//    $f1=fopen($some_filename,'r');
//    $f2=fopen($some_filename2,'w');
//    foreach ($arr_url as $elem) {
//        fwrite($f2,$elem."\r\n");
//    }
//    fclose($f1);
//    fclose($f2);
//}
//repeat($filename, $filename2);

// сначало нужно проверить, есть ли такая ссылка в файле и если ее нет, только потом записывать ее. Короткая ссылка -  это хешированная ссылка
// и сделать базу данных до