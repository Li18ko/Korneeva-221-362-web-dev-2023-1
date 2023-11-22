<?php
$pageTitle = "Корнеева Е.С. 221-362";
$currentDate = date('d.m.Y в H:i:s');
?>

<!DOCTYPE html>

<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Главная страница</a></li>
                <li><a href="shop.php">Каталог товаров</a></li>
                <li><a onclick="goBack()">Назад</a></li>
            </ul>
        </nav>
    </header>

    <main>

        
    </main>

    <footer>
        <p>Контактные данные: +7 (999) 999 - 99 - 99</p>
        <p>&copy; 2023 Магазин</p>
    </footer>

    <script src="index.js"></script>
</body>

</html>