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
        <?php
            $x = -10;	// начальное значение аргумента
            $encounting = 10000;	// количество вычисляемых значений
            $step = 2;	// шаг изменения аргумента
            $type = 'A';	// тип верстки

            $min_value= -500;	// минимальное значение, останавливающее вычисления
            $max_value= 0;	// максимальное значение, останавливающее вычисления


            if( $type == 'B' )	// если тип верстки В
                echo '<ul>';	// начинаем список

            // цикл с заданным количеством итераций
            for( $i=0; $i < $encounting; $i++, $x+=$step ) {
                if ( $x <= 10 )	
                    $f = 10*$x - 5;	
                else if ( $x > 10 and $x < 20 )	
                    $f = ($x + 3) * $x^2;	
                else {
                    if( $x == 25 )
                        $f= 'error';
                    else	
                        $f = 3 / ($x - 25);
                }
                if ( $type == 'A' )	{ // если тип верстки А
                    echo 'f('.$x.')='.$f;	// выводим аргумент и значение функции
                    if( $i < $encounting-1 ) // если это не последняя итерация цикла
                        echo '<br>';	// выводим знак перевода строки
                }
                else if( $type == 'B' )	{ // если тип верстки В
                    // выводим данные как пункт списка
                    echo '<li>f('. $x.')='.$f.'</li>';
                }

                if ( $f >= $max_value || $f < $min_value )	// если вышли за рамки диапазона
                    break;


            }

            if( $type == 'B' )	// если тип верстки В
                echo '</ul>';	// закрываем тег списка
        ?>


    </main>

    <footer class="footer">
        <div class="container">&copy; Корнеева Е.С.</div>
    </footer>
</body>

</html>