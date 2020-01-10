<?php

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Form</title>
</head>
<body>
    <form action="form_handler.php" method="post" name="formUrl">
        <p id="answer"></p>
        <input type="url" placeholder="Введите ссылку" name="url" id="url">
        <input type="submit" name="submit" value="Отправить">
    </form>

</body>
</html>
