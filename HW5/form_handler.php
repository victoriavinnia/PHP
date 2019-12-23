<?php
$post = $_POST;
var_dump($post);

$files = $_FILES;
var_dump($files);

$file_name = $files['picture']['name'];

$tmp_name = $files['picture']['tmp_name'];

$file_size = $files['picture']['size'];

$num = count($files['picture']['name']);

for ($i = 0; $i < $num; $i++) {
    $ext =  pathinfo($file_name[$i], PATHINFO_EXTENSION);
    var_dump($ext);
    if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg') {
        var_dump($ext);
        if ($file_size[$i] < 1024 * 1024) {
            $name = md5($file_name[$i]);
            $full_name = $name.'.'.$ext;
            var_dump($full_name);
            if(move_uploaded_file($tmp_name[$i], "img/$full_name")) {
                echo "Файл успешно загружен";
            } else {
                echo "Не удалось загрузить файл";
            }
        } else { echo 'Данный размер файла не поддерживается';}
    } else { echo 'Данный тип файла не поддерживается';}
}
