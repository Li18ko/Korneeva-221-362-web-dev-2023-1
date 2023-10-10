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
    <link rel="stylesheet" href="styles/forma.css" />
</head>

<body>
    <header class="header">
        <div class="container">
            <nav class="main-menu">
            <a <?php echo 'selected-menu'; ?>  href="index.php#О нас"><?php echo 'О нас'; ?></a>
                <a <?php echo 'selected-menu'; ?>  href="index.php#Режим работы"><?php echo 'Режим работы'; ?></a>
                <a <?php echo 'selected-menu'; ?>  href="index.php#Контакты"><?php echo 'Контакты'; ?></a>
                <a <?php echo 'selected-menu'; ?>  href="index.php#Адреса"><?php echo 'Адреса'; ?></a>
                <a <?php echo 'selected-menu'; ?>  href="input.php"><?php echo 'Вход'; ?></a>
                <a <?php echo 'selected-menu'; ?>  href="index.php"><?php echo 'Назад'; ?></a>
            </nav>

            <div class="text-center py-5">
                <h1>Зоомагазин "Кобра"</h1>
                <h3>Ждем вас в мире животных!</h3>
            </div>
        </div>
    </header>

    <main>
        <h2>Форма обратной связи</h2>
        <form action="https://httpbin.org/post" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label class="form-label" for="name">ФИО</label>
                <input id="name" type="text" name="name" placeholder="Введите имя" required>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input id="email" type="text" name="email" placeholder="Введите email">
            </div>

            <div class="form-group">
                <h4 class="form-label">Как вы узнали о нас?</h4>
                <input id="advertising" type="radio" name="source" value="advertising">
                <label for="advertising">Реклама в интернете</label>

                <input id="friends" type="radio" name="source" value="friends">
                <label for="friends">Рассказали знакомые</label>
            </div>

            <div class="form-group">
                <label class="form-label" for="categoty">Категория обращения</label>
                <select id="category" name="category">
                    <option value="proposal">Предложение</option>
                    <option value="complaint">Жалоба</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="message">Текст сообщения</label>
                <textarea id="message" name="message" cols="30" rows="10" placeholder="Введите сообщение"></textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="attachment">Вложение</label>
                <input id="attachment" name="attachment" type="file">
            </div>

            <div class="form-group">
                <input id="agreement" name="agreement" type="checkbox" value="yes" required>
                <label for="agreement">Даю согласие на обработку персональных данных</label>
            </div>

            <input type="submit" value="Отправить">
        </form>
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