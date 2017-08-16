<?php
    header('Content-Type: text/html; charset=utf-8');
    ini_set('display_errors',true);
    error_reporting(E_ALL);

    /* Задача 1.
    Создать текстовую гостевую книгу.  Сделать на страничке форму, в которой будет одно поле для ввода имени.
    После ввода имени и нажатия кнопки Ок, в файл (название произвольное)
    Записать имя, дату и посещенную страницу в файл. Примечание. Файл обязательно дописывать. */

    /* Определяем переменные и устанавливаем их на пусты значения */
    $usernameErr = "";
    $username = "";
    $guestbook = 'guestbook.txt';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"])) {
            $usernameErr = "Поле \"Ваше имя\" является обязательным для ввода";
        } else {
            $username = cleanInput($_POST["username"]);
        }
    }

    function cleanInput($data) {
        $data = trim($data); /* Удаляет пробелы (или другие символы) из начала и конца строки */
        $data = stripslashes($data); /* Удаляет экранирование символов */
        $data = strip_tags($data); /* Удаляет HTML и PHP-теги из строки */
        $data = htmlspecialchars($data); /* Преобразует специальные символы в HTML-сущности */
        // $data = (int)$data; /* Явное преобразование в число */
        return $data;
    }

    if (!empty($username)) {
        $page = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $time = time(); /* Затем можно использовать echo date('d.m.Y h:i:s',$time); */
        $userinfo = $username.'|'.$time.'|'.$page."\n" ;
        $data = fopen("$guestbook","a+");
        flock($data, LOCK_EX);
        fwrite($data, $userinfo);
        flock($data, LOCK_UN);
        fclose($data);
    }



    /* Задача 2.
    Создать текстовый файл, записать в него 1000 случайных чисел в диапазоне от 1 до 500(столбиком).
    Прочитать файл в массив и записать два разных файла.
    В одном файле записать только парные числа
    В другом файле записать тольно непарные числа
    Писать в формате ключ массива => число. */

    $file = 'rand_num.txt';
    $file_even = 'even_num.txt';
    $file_odd = 'odd_num.txt';

    $string = '';
    for ($i = 0; $i < 1000; $i++) {
        $number = rand(1, 500);
        $string .= $number."\n";
    }

    file_put_contents("$file", "$string");

    $numArr = file("$file");
    $count = count($numArr);
    $evenNum = '';
    $oddNum = '';
    for ($i = 0; $i < $count; $i++) {
        if ($numArr[$i] % 2 == 0) {
            $evenNum .='['."$i".']=>'.$numArr[$i];
        } else {
            $oddNum .='['."$i".']=>'.$numArr[$i];
        }
    }
    file_put_contents("$file_even", "$evenNum");
    file_put_contents("$file_odd", "$oddNum");

?>


<!doctype html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Guestbook</title>
<style>
    .content {
        width: 1024px;
        margin: 0 auto;
    }
</style>
</head>
<body>
<div class="content">
    <h1>Добро пожаловать на наш сайт</h1>
    <form action="" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
        <label for="username">Ваше имя:</label>
        <input type="text" name="username" id="username" required>
        <input type="submit" class="">
    </form>
    <span class="error">* <?php echo $usernameErr;?></span>
</div>
<?php if (file_exists('guestbook.txt')) readfile('guestbook.txt'); ?>
</body>
</html>