<!DOCTYPE html>

<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <title>Корнеева Елизавета Сергеевна, 221-362, Лабораторная работа №9, Вариант: 1</title>
    <link rel="stylesheet" href="styles.css" />
</head>

<body>
    <header>
        <div>
            <img src="mospolytech-logo-white.svg" alt="University Logo">
        </div>
        <div>
            <h3>ФИО: Корнеева Елизавета Сергеевна</h3>
            <h3>Группа: 221-362</h3>
            <h3>Лабораторная работа №9</h3>
            <h3>Вариант: 1 (11-ая в списке)</h3>
        </div>
    </header>

    <main>
        <form method="post" action="" class="contact-form">
            <input class="form-field" type="number" name = "startArgument" id="startArgument" placeholder="Начальное значение аргумента" required>
            <br>
            <input class="form-field" type="number" name = "numValues" id="numValues" placeholder="Количество вычисляемых значений" required>
            <br>
            <input class="form-field" type="number" name = "step" id="step" placeholder="Шаг изменения аргумента" required>
            <br>
            <input class="form-field" type="number" name = "min" id="min" placeholder="Минимальное значение, останавливающее вычисления" required>
            <br>
            <input class="form-field" type="number" name = "max" id="max" placeholder="Максимальное значение, останавливающее вычисления" required>
            <br>
            <label for="type">Тип верстки:</label>
            <br>
            <select class="form-field" name="type" id="type">
                <option value="A">Тип A</option>
                <option value="B">Тип B</option>
                <option value="C">Тип C</option>
                <option value="D">Тип D</option>
                <option value="E">Тип E</option>
            </select>
            <br>
            <button type="submit" class="btn">Рассчитать</button>
        </form>
        <br>

        <?php
            function cycleWithCounter($x, $encounting, $step, $type, $min_value, $max_value, $sum, $min, $max) {
                //цикл со счетчиком
                for( $i = 0; $i < $encounting; $i++, $x += $step ) {
                    $k = $i + 1;

                    if ( $x <= 10 )	
                        $f = 10*$x - 5;	
                    else if ( $x > 10 and $x < 20 )	
                        $f = ($x + 3) * $x**2;	
                    else {
                        if( $x == 25 )
                            $f= 'error';
                        else	
                            $f = 3 / ($x - 25);
                    }

                    if ($f != 'error') {
                        $sum += $f;
                        $min = min($min, $f);
                        $max = max($max, $f);
                    }

                    switch ($type) {
                        case 'A':
                            echo "f($x) = $f<br><br>";
                            break;
                        case 'B':
                            echo "<ul><li>f($x) = $f</li></ul>";
                            break;
                        case 'C':
                            echo "<ol start='$k'><li>f($x) = $f</li></ol>";
                            break;
                        case 'D':
                            echo "<table border='1' cellspacing='0' cellpadding='10'>
                                <tr>
                                    <td>Шаг</td>
                                    <td>Аргумент функции</td>
                                    <td>Значение функции</td>
                                </tr>
                                <tr>
                                    <td>$i</td>
                                    <td>$x</td>
                                    <td>$f</td>
                                </tr>
                            </table>";
                            break;
                        case 'E':
                            // Блочная верстка
                            echo '<div style="border: 2px solid red; display: inline-block; margin-right: 8px;">';
                            echo "f($x) = $f";
                            echo '</div>';
                            break;
                        default:
                            // По умолчанию использовать верстку A
                            echo "f($x) = $f<br><br>";
                    }

                    if ( $f >= $max_value || $f < $min_value )	// если вышли за рамки диапазона
                        break;
                }

                echo '<p>Максимальное значение: ' . ($max != PHP_INT_MIN ? round($max, 3) : 'error') . '</p>';
                echo '<p>Минимальное значение: ' . ($min != PHP_INT_MAX ? round($min, 3) : 'error') . '</p>';
                echo '<p>Среднее арифметическое: ' . ($encounting > 0 ? round($sum / $encounting, 3) : 'error') . '</p>';
                echo '<p>Сумма значений: ' . ($sum != 'error' ? round($sum, 3) : 'error') . '</p>';
            }

            function cycleWithPrecondition($x, $encounting, $step, $type, $min_value, $max_value, $sum, $min, $max) {
                //цикл с предусловием
                $i = 0; $f = 0;
                
                while($i < $encounting && ($f <= $max_value && $f >= $min_value)  ){

                    if ( $x <= 10 )	
                        $f = 10*$x - 5;	
                    else if ( $x > 10 and $x < 20 )	
                        $f = ($x + 3) * $x**2;	
                    else {
                        if( $x == 25 )
                            $f= 'error';
                        else	
                            $f = 3 / ($x - 25);
                    }

                    if ($f != 'error') {
                        $sum += $f;
                        $min = min($min, $f);
                        $max = max($max, $f);
                    }

                    $k = $i + 1;

                    switch ($type) {
                        case 'A':
                            echo "f($x) = $f<br><br>";
                            break;
                        case 'B':
                            echo "<ul><li>f($x) = $f</li></ul>";
                            break;
                        case 'C':
                            echo "<ol start='$k'><li>f($x) = $f</li></ol>";
                            break;
                        case 'D':
                            echo "<table border='1' cellspacing='0' cellpadding='10'>
                                <tr>
                                    <td>Шаг</td>
                                    <td>Аргумент функции</td>
                                    <td>Значение функции</td>
                                </tr>
                                <tr>
                                    <td>$i</td>
                                    <td>$x</td>
                                    <td>$f</td>
                                </tr>
                            </table>";
                            break;
                        case 'E':
                            // Блочная верстка
                            echo '<div style="border: 2px solid red; display: inline-block; margin-right: 8px;">';
                            echo "f($x) = $f";
                            echo '</div>';
                            break;
                        default:
                            // По умолчанию использовать верстку A
                            echo "f($x) = $f<br><br>";
                    }

                    $i++; 
                    $x += $step;
                }


                echo '<p>Максимальное значение: ' . ($max != PHP_INT_MIN ? round($max, 3) : 'error') . '</p>';
                echo '<p>Минимальное значение: ' . ($min != PHP_INT_MAX ? round($min, 3) : 'error') . '</p>';
                echo '<p>Среднее арифметическое: ' . ($encounting > 0 ? round($sum / $encounting, 3) : 'error') . '</p>';
                echo '<p>Сумма значений: ' . ($sum != 'error' ? round($sum, 3) : 'error') . '</p>';

            }

            function cycleWithPostcondition($x, $encounting, $step, $type, $min_value, $max_value, $sum, $min, $max) {
                //цикл с постусловием
                $i=0;
                do {
                    if ( $x <= 10 )	
                        $f = 10*$x - 5;	
                    else if ( $x > 10 and $x < 20 )	
                        $f = ($x + 3) * $x**2;	
                    else {
                        if( $x == 25 )
                            $f= 'error';
                        else	
                            $f = 3 / ($x - 25);
                    }

                    if ($f != 'error') {
                        $sum += $f;
                        $min = min($min, $f);
                        $max = max($max, $f);
                    }

                    $k = $i + 1;

                    switch ($type) {
                        case 'A':
                            echo "f($x) = $f<br><br>";
                            break;
                        case 'B':
                            echo "<ul><li>f($x) = $f</li></ul>";
                            break;
                        case 'C':
                            echo "<ol start='$k'><li>f($x) = $f</li></ol>";
                            break;
                        case 'D':
                            echo "<table border='1' cellspacing='0' cellpadding='10'>
                                <tr>
                                    <td>Шаг</td>
                                    <td>Аргумент функции</td>
                                    <td>Значение функции</td>
                                </tr>
                                <tr>
                                    <td>$i</td>
                                    <td>$x</td>
                                    <td>$f</td>
                                </tr>
                            </table>";
                            break;
                        case 'E':
                            // Блочная верстка
                            echo '<div style="border: 2px solid red; display: inline-block; margin-right: 8px;">';
                            echo "f($x) = $f";
                            echo '</div>';
                            break;
                        default:
                            // По умолчанию использовать верстку A
                            echo "f($x) = $f<br><br>";
                    }

                    $i++; 
                    $x += $step;

                }
                while( $i < $encounting && ($f < $max_value && $f > $min_value ) );

                echo '<p>Максимальное значение: ' . ($max != PHP_INT_MIN ? round($max, 3) : 'error') . '</p>';
                echo '<p>Минимальное значение: ' . ($min != PHP_INT_MAX ? round($min, 3) : 'error') . '</p>';
                echo '<p>Среднее арифметическое: ' . ($encounting > 0 ? round($sum / $encounting, 3) : 'error') . '</p>';
                echo '<p>Сумма значений: ' . ($sum != 'error' ? round($sum, 3) : 'error') . '</p>';
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $x = isset($_POST["startArgument"]) && is_numeric($_POST["startArgument"]) ? (int)$_POST["startArgument"] : 0;	// начальное значение аргумента
                $encounting = isset($_POST["numValues"]) && is_numeric($_POST["numValues"]) ? (int)$_POST["numValues"] : 0;	// количество вычисляемых значений
                $step = isset($_POST["step"]) && is_numeric($_POST["step"]) ? (int)$_POST["step"] : 0;	// шаг изменения аргумента
                $type = isset($_POST["type"]) ? $_POST["type"] : '';	// тип верстки

                $min_value = (int) $_POST["min"]; // минимальное значение, останавливающее вычисления
                $max_value = (int) $_POST["max"]; // максимальное значение, останавливающее вычисления

                $sum = 0;
                $min = PHP_INT_MAX; // Максимальное значение для поиска минимума
                $max = PHP_INT_MIN; // Минимальное значение для поиска максимума

                echo "Цикл со счетчиком <br>";
                echo '<br>';
                cycleWithCounter($x, $encounting, $step, $type, $min_value, $max_value, $sum, $min, $max);
                echo '<br>';
                echo "Цикл с предусловием <br>";
                echo '<br>';
                cycleWithPrecondition($x, $encounting, $step, $type, $min_value, $max_value, $sum, $min, $max);
                echo '<br>';
                echo "Цикл с постусловием <br>";
                echo '<br>';
                cycleWithPostcondition($x, $encounting, $step, $type, $min_value, $max_value, $sum, $min, $max);
            }
        ?>
    </main>

    <footer class="footer">
        <?php
            if (!empty($type)){
            echo "<footer><p>Тип верстки: $type</p></footer>";
            } else{
                $type = 'Верстка еще не выбрана.';
            }
        ?>   
        <div class="container">&copy; Корнеева Е.С.</div>
    </footer>
</body>

</html>