<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Текстовый анализатор Корнеева Е.С.</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['text']) && $_POST['text']) {
            $text = $_POST['text'];
            echo "<p><i>Исходный текст:</i></p>";
            echo '<div class="src_text">' . $text . '</div>';
            test_it(iconv("utf-8", "cp1251//TRANSLIT", $text));
        } else {
            echo '<div class="src_error">Нет текста для анализа</div>';
        }

        echo "<a href=\"index.html\">Другой анализ</a><br><br>";
    }

    function test_it($text) {
        // определяем ассоциированный массив с цифрами
        $cifra = array('0' => true, '1' => true, '2' => true, '3' => true, '4' => true, '5' => true, '6' => true, '7' => true, '8' => true, '9' => true);
    
        // вводим переменные для хранения информации о:
        $cifra_amount = 0; // количество цифр в тексте
        $word_amount = 0; // количество слов в тексте
        $word = ''; // текущее слово
        $words = array(); // список всех слов
    
        for ($i = 0, $length = mb_strlen($text, 'cp1251'); $i < $length; $i++) { // перебираем все символы текста
            $char = mb_substr($text, $i, 1, 'cp1251');
            if (array_key_exists($char, $cifra)) // если встретилась цифра
                $cifra_amount++; // увеличиваем счетчик цифр
    
            // если в тексте встретился пробел или текст закончился
            if ($char == ' ' || $i == $length - 1) {
                if ($word) { // если текущее слово сохранено в списке слов
                    if (isset($words[$word]))
                        $words[$word]++; // увеличиваем число его повторов
                    else
                        $words[$word] = 1; // первый повтор слова
                }
    
                $word = ''; // сбрасываем текущее слово
            } else // если слово продолжается
                $word .= $char; // добавляем в текущее слово новый символ
        }
    
        // вызов функции для подсчета символов
        $symbs = test_symbs($text);
        // вывод информации о словах
        $sorted_words = sort_and_print_words($words);
    
        echo '<table>';
        echo '<tr><th>Тип информации</th><th>Количество</th></tr>';
        echo '<tr><td>Количество символов</td><td>' . mb_strlen($text, 'cp1251') . '</td></tr>';
        echo '<tr><td>Количество цифр</td><td>' . $cifra_amount . '</td></tr>';
        echo '<tr><td>Количество знаков препинания</td><td>' . (isset($symbs['punct']) ? $symbs['punct'] : 0) . '</td></tr>';
        echo '<tr><td>Количество строчных букв</td><td>' . (isset($symbs['l']) ? $symbs['l'] : 0) . '</td></tr>';
        echo '<tr><td>Количество заглавных букв</td><td>' . (isset($symbs['u']) ? $symbs['u'] : 0) . '</td></tr>';
        echo '<tr><td>Количество уникальных слов</td><td>' . count($sorted_words) . '</td></tr>';

        echo '</table>';
        echo '<table>';
        echo '<tr><th>Слово</th><th>Количество</th></tr>';
        foreach ($sorted_words as $word) {
            $w = iconv("cp1251", "utf-8", $word);
            echo "<tr><td>$w</td><td>{$words[$word]}</td></tr>";
        }
        echo '</table><br><br>';
    }
    
    
    function test_symbs($text) {
        $symbs = array(); // массив символов текста
        // последовательно перебираем все символы текста
        for ($i = 0, $length = mb_strlen($text, 'cp1251'); $i < $length; $i++) {
            $char = mb_substr($text, $i, 1, 'cp1251');
            if (ctype_punct($char)) { // если символ является знаком препинания
                if (isset($symbs['punct'])) {
                    $symbs['punct']++;
                } else {
                    $symbs['punct'] = 1;
                }
            } elseif (ctype_alpha($char)) { // если символ является буквой
                if (ctype_upper($char)) {
                    if (isset($symbs['u'])) {
                        $symbs['u']++;
                    } else {
                        $symbs['u'] = 1;
                    }
                } else {
                    if (isset($symbs['l'])) {
                        $symbs['l']++;
                    } else {
                        $symbs['l'] = 1;
                    }
                }
            }
    
            if (isset($symbs[$char])) { // если символ есть в массиве
                $symbs[$char]++; // увеличиваем счетчик повторов
            } else { // иначе
                $symbs[$char] = 1; // добавляем символ в массив
            }
        }
        return $symbs; // возвращаем массив с числом вхождений символов в тексте
    }

    function sort_and_print_words($words){
        ksort($words); // сортировка массива по ключам (по алфавиту)
        return array_keys($words); // возвращаем упорядоченные слова
    }
    ?>
</body>
</html>

