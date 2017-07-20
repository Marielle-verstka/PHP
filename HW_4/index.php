<?php
header('Content-Type: text/html; charster = utf-8');
ini_set('display_errors', true);
error_reporting(E_ALL);

echo <<<END
<h3>Задача 2</h3>
<p>Cоздать массив из 1000 чисел каждый элемент которого равен квадрату своего номера.
Результат вывести в виде таблицы (офорить ее рамкой)</p>
END;
/*Табличка в самом низу html-файла*/
$powArr = array();
echo "<table border='1' style='text-align: center; margin: 0 auto;'>";
echo "<tr>";
echo "<td style='padding: 2px 4px;'>";
for ($i = 1; $i <= 1000; $i++) {
    $powArr[$i] = pow($i, 2); /*Создаём элементы массива*/
    if ($i % 1000 == 0) { /*Закрываем табличку*/
        echo "<span style='display: block;'>$i<sup>2</sup> = ";
        echo $powArr[$i];
        echo "</span>";
        echo "</td>";
        echo "</tr>";
    } elseif ($i % 50 == 0) { /*Закрываем строку*/
        echo "<span style='display: block;'>$i<sup>2</sup> = ";
        echo $powArr[$i];
        echo "</span>";
        echo "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td style='padding: 2px 4px;'>";
    } elseif ($i % 10 == 0) { /*Закрываем ячейку*/
        echo "<span style='display: block;'>$i<sup>2</sup> = ";
        echo $powArr[$i];
        echo "</span>";
        echo "</td>";
        echo "<td  style='padding: 2px 4px;'>";
    } else { /*Закрываем строку в ячейке*/
        echo "<span style='display: block;'>$i<sup>2</sup> = ";
        echo $powArr[$i];
        echo "</span>";
    }
}
echo "<hr>";



echo <<<END
<h3>Задача 3</h3>
<p>Создайте массив из 1000 случайных чисел. Определите, есть ли в массиве повторяющиеся элементы</p>
END;

$randArr = array();
for ($i = 0, $length = 1000;  $i < $length; $i++) { /*Создаём массив из случайных чисел. $length - длина массива*/
    $randArr[$i] = rand(1, 10000);
}
for ($i = 0, $n = 0, $cnt = $length - 1; $i < $cnt; $i++) { /*$cnt - сокращаем кол-во итераций на 1, т.к. последние число провериться во втором цикле*/
    for ($j = $i + 1; $j < $length; $j++) { /*$j - элемент, следующий за текущим. Проверять с 0 нет смысла*/
        if ($randArr[$i] == $randArr[$j]) {
            echo '$randArr[',"$i",']', "<span style = 'color:red;'> $randArr[$i]</span>"," = ", '$randArr[',"$j",']', "<span style = 'color:red;'> $randArr[$j]</span>","<br>";
            $n++;
        }
    }
}
echo "<p>В массиве ","<span style = 'color:red;'>$n</span>"," повторений</p>";
echo "<hr>";



echo <<<END
<h3>Задача 4</h3>
<p>Создать массив из 100 случайных чисел. Найти сумму чисел, которые кратны 5-ти(пяти)</p>
END;

for($i = 0, $sum = array(); $i < 100; $i++) {/*Создаём массив из случайных чисел*/
    $sum[$i] = rand(1, 10000);
}
for($i = 0, $counter = 0, $k = 0; $i < 100; $i++) {/*$counter - сумма элементов, кратных 5; $k = 0 - количество элементов кратных 5;*/
    if ($sum[$i] % 5 == 0) { /*Проверяем кратен ли элемент массива 5*/
        echo '$sum[',"$i",'] = ', "<span style = 'color:red;'>$sum[$i]</span>", "<br>";
        $counter += $sum[$i];
        $k++;
    }
}
echo "<p>В массиве ", '$sum', " <span style = 'color:red;'>$k</span> элементов кратных 5-ти. Их общая сумма составляет <span style = 'color:red;'>$counter</span>.</p>";
echo "<hr>";



echo <<<END
<h3>Задача 5</h3>
<p>Дана строка. Если ее длина больше 10 символов, то оставить в строке только первые 6 символов, иначе дополнить строку символами 'o' до длины 12.</p>
END;
$str = "Hello, World!";
$length = strlen($str);
echo "<p>";
if($length > 10) {
    $length = 6;
    echo substr($str, 0, $length);
} else {
    $length = 12;
    echo str_pad($str, $length, "o");
}
echo "</p>";
echo "<hr>";



echo <<<END
<h3>Задача 6</h3>
<p>Сгенерировать массив из 10-ти случайных чисел. После этого, сгенерировать одно случайно число и проверить, входи ли оно в данный массив.</p>
END;
$randAr = array();
for($i = 0; $i < 10; $i++) {
    $randAr[$i] = rand(1, 25);
}
$randNum = rand(1, 25);
$searchNum = array_search($randNum, $randAr);
echo "<pre>",print_r($randAr),"</pre>";
if (!empty($searchNum) || $searchNum === 0) { //isset всегда true. Проверка на ноль для нулевого ключа
    echo "<p>Число $randNum присутсвует в массиве</p>";
} else {
    echo "<p>Число $randNum не входит в массив</p>";
}
echo "<hr>";



echo <<<END
<h3>Задача 7</h3>
<p>Создать массив из 100 случайных как чисел так и ключей. После этого выполнить:</p>
<p>Сортировку массива по значению</p>
<p>Сортировку массива по ключу.</p>
END;
$maxRand = array(); //Создаем пустой массив
$count = count($maxRand); //Начальное состояние массива - точка отсчета
while($count < 100) { //Устанавливаем конечное число элементов в массиве
    $n = rand(1, 100); //Генерируем число, которое вдальнейшем возможно станет индексом массива
    if (!array_key_exists($n, $maxRand)) { //Предотвращаем использование одинаковых ключей, что может привести к их перезапси
        $maxRand[$n] = rand(1, 100); //Генерируем случайное значение для случайного ключа
        $count++;
    } else {
        $count = $count;
    }
}
echo "<p>Массив из 100 случайных чисел и ключей</p>";
echo "<pre>",print_r($maxRand),"</pre>";
$ksortMaxRand = $maxRand;
ksort($ksortMaxRand,SORT_NUMERIC); //Сортировка по ключу с сохранением связи ключ-значение
echo "<p>Сортировка по ключу с сохранением связи ключ-значение</p>";
echo "<pre>",print_r($ksortMaxRand),"</pre>";
$asortMaxRand = $maxRand;
asort($asortMaxRand,SORT_NUMERIC); //Сортировка по значению с сохранением связи ключ-значение
echo "<p>Сортировка по значению с сохранением связи ключ-значение</p>";
echo "<pre>",print_r($asortMaxRand),"</pre>";
echo "<hr>";



echo <<<END
<h3>Задача 8</h3>
<p>Создать два массива из 10-ти случайных чисел.</p>
<p>Выполнить сравнения массивов по двум критеряим: вычислить схождение массива, вычислить расхождение массива.</p>
END;
for ($firstArr = array(), $secondArr = array(), $i = 0; $i < 10; $i++) {
    $firstArr[$i] = rand(1, 100); //Первый массив
    $secondArr[$i] = rand(1, 100); //Второй массив
}
echo "<p>Первый массив</p>";
echo "<pre>",print_r($firstArr),"</pre>";
echo "<p>Второй массив</p>";
echo "<pre>",print_r($secondArr),"</pre>";
$resultIntersect = array_intersect($firstArr, $secondArr); // Схождение массивов
echo "<p>Схождение массивов</p>";
echo "<pre>",print_r($resultIntersect),"</pre>";
$resultIntersectAssoc = array_intersect_assoc($firstArr, $secondArr); //Схождение массивов с проверкой индекса
echo "<p>Схождение массивов с проверкой индекса</p>";
echo "<pre>",print_r($resultIntersectAssoc),"</pre>";
$resultDiff = array_diff($firstArr, $secondArr); // Расхождение массивов
echo "<p>Расхождение массивов</p>";
echo "<pre>",print_r($resultDiff),"</pre>";
$resultDiffAssoc = array_diff_assoc($firstArr, $secondArr); //Расхождение массивов с проверкой индекса
echo "<p>Расхождение массивов с проверкой индекса</p>";
echo "<pre>",print_r($resultDiffAssoc),"</pre>";
echo "<hr>";



echo <<<END
<h3>Задача 9</h3>
<p>Создать массив из 50-ти случайных чисел. Генерируя случайно число, проверять есть ли такой ключ в данном массив.</p>
END;
$arrRand = array(); //Создаем пустой массив
$counts = count($arrRand); //Начальное состояние массива - точка отсчета
while($counts < 50) { //Устанавливаем конечное число элементов в массиве
    $k = rand(1, 100); //Генерируем число, которое вдальнейшем возможно станет индексом массива
    if (!array_key_exists($k, $arrRand)) { //Предотвращаем использование одинаковых ключей, что может привести к их перезапси
        $arrRand[$k] = rand(1, 100); //Генерируем случайное значение для случайного ключа
        $counts++;
    } else {
        $counts = $counts;
    }
}
$keyRand = rand(1, 100);
echo "<pre>",print_r($arrRand),"</pre>";
if (array_key_exists($keyRand, $arrRand)) {
    echo "Массив содержит ключ $keyRand.";
} else {
    echo "Массив не содержит ключ $keyRand.";
}
echo "<hr>";



echo <<<END
<h3>Задача 10</h3>
<p>Создать массив из 100 случайных ключей. Создать еще один массив, который будет содержать все ключи первого массива. Использовать функции php, не писать «велосипед»</p>
END;
echo "<pre>",print_r($maxRand),"</pre>"; /*Массив, создали ранее*/
$flipped = array_flip($maxRand); /*Создаем промежуточный массив, в котором меняем местами ключи и значения массива $maxRand*/
$arrayFill = array_fill_keys($flipped, ""); /*Используя значения массива $flipped в качестве ключей, создаём новыймассив с пустыми значениями*/
echo "<pre>",print_r($arrayFill),"</pre>";
echo "<hr>";



echo <<<END
<h3>Задача 11</h3>
<p>Создать массива з 10-ти чисел. Вычислить произведение значений массива. Не использовать для решения задачи циклы.</p>
END;
echo array_product($randAr); //$randAr - массив, создовали в задаче №6
echo "<hr>";



echo <<<END
<h3>Задача 12</h3>
<p>Нарисовать треугольник из чисел при помощи php.</p>
END;
$height = 5;
for ($i = 0; $i <= $height; $i++) {
    echo "<h1 style='text-align: center;'>";
    for ($j = 0, $n = 1; $j <= $i; $j++) {
        echo "$n";
    }
    echo "</h1>";
}
echo "<hr>";



echo <<<END
<h3>Задача 13</h3>
<p>Нарисовать ромб из чисел, используя php.</p>
END;
$height = 5;
$long = $height * 2;
for($i = 1; $i <= $long; $i++) {
    if (($i <= $height)) {
        echo str_repeat("&nbsp",$height - $i).str_repeat('1',$i)."\n";
        echo "<br>";
    } else {
        $n = $long - $i + 1;
        $v = $i - $height - 1;
        echo str_repeat("&nbsp", $v).str_repeat('1',$n)."\n";
        echo "<br>";
        $n++;
    }
}
?>