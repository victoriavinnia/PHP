<?php

//Написать функцию удаления непустого каталога
function deleteDir ($some_dir)
{
    if (is_dir($some_dir)) {
        if($dh = opendir($some_dir)) {
            while (($data = readdir($dh)) !== false) {
                if ($data!='.' && $data!='..') {
                    $path = $some_dir.'/'.$data;
                    if(is_dir($path)) {
                        deleteDir($path);
                    } else {
                    if (file_exists($path)) {
                        unlink($path);
                        }
                    }
                }
            }
            closedir($dh);
        }
    }
    rmdir("$some_dir");
}
deleteDir ('qwerty');
