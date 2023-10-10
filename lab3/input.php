<?php
$pageTitle = "Корнеева Е.С. 221-362 lab3";
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
    <link rel="stylesheet" href="styles/input.css" />
</head>

<body>
    <header class="header">
        <div class="container">
            <nav class="main-menu">
                <a <?php echo 'selected-menu'; ?>  href="index.php#О нас"><?php echo 'О нас'; ?></a>
                <a <?php echo 'selected-menu'; ?>  href="index.php#Режим работы"><?php echo 'Режим работы'; ?></a>
                <a <?php echo 'selected-menu'; ?>  href="index.php#Контакты"><?php echo 'Контакты'; ?></a>
                <a <?php echo 'selected-menu'; ?>  href="index.php#Адреса"><?php echo 'Адреса'; ?></a>
                <a <?php echo 'selected-menu'; ?>  href="forma.php"><?php echo 'Форма обратной связи'; ?></a>
                <a <?php echo 'selected-menu'; ?>  href="index.php"><?php echo 'Назад'; ?></a>
            </nav>

            <div class="text-center py-5">
                <h1>Зоомагазин "Кобра"</h1>
                <h3>Ждем вас в мире животных!</h3>
            </div>
        </div>
    </header>

    <main>
        <h2>Авторизация</h2>
        <form action="https://httpbin.org/post" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label class="form-label" for="login">Логин</label>
                <input id="login" type="text" name="login" placeholder="Введите логин" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Пароль</label>
                <input id="password" type="password" name="password" placeholder="Введите пароль" required>
            </div>

            <div class="form-group">
                <input id="remember" name="remember" type="checkbox" value="yes">
                <label for="remember">Запомнить меня</label>
            </div>

            <input type="submit" value="Войти">
        </form>
        <br />
    </main>

    <footer class="footer">
        <div class="container">&copy; Корнеева Е.С.
            <br />
            <?php
                date_default_timezone_set('Europe/Moscow');
                echo 'Сформировано ' . $currentDate;
            ?>
        </div>
    </footer>
</body>

</html>