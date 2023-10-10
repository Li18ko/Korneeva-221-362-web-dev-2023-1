<?php
$seconds = date('s');
$pageTitle = "Корнеева Е.С. 221-362 lab3";
$currentDate = date('d.m.Y в H:i:s');

$workingHours = array(
    array('Пн-Пт', '9:00-13:00; 14:00-22:00'),
    array('Сб-Вс', '10:00-13:30; 14:30-20:00')
);

$speclist = array(
    '+7(495) 222-33-11; +7(495) 111-22-33
    <br />
    Пн-пт: 9:00 - 22:00
    <br />
    Сб-вс: 10:00 - 20:00',
    'Почта: kobraa@gmail.com'
);

$speclistAddress = array(
    'м. Окружная,
    <br />
    Локомотивный проезд, 31',
    'м. Партизанская,
    <br />
    Измайловское шоссе, 71с8',
    'м. Тульская,
    <br />
    Большая Тульская улица, 4',
    'м. Шелепиха,
    <br />
    Шелепихинское шоссе, 3'
);

if ($seconds % 2 == 0){
    $imageClass = 'images/animals.jpg';
    $imageClass1 = 'images/animals2.jpg';
}
else {
    $imageClass = 'images/animals1.jpg';
    $imageClass1 = 'images/animals3.jpg';
}

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
    <link rel="stylesheet" href="styles/main.css" />
</head>

<body>
    <header class="header">
        <div class="container">
            <nav class="main-menu">
                <a <?php echo 'selected-menu'; ?>  href="#О нас"><?php echo 'О нас'; ?></a>
                <a <?php echo 'selected-menu'; ?>  href="#Режим работы"><?php echo 'Режим работы'; ?></a>
                <a <?php echo 'selected-menu'; ?>  href="#Контакты"><?php echo 'Контакты'; ?></a>
                <a <?php echo 'selected-menu'; ?>  href="#Адреса"><?php echo 'Адреса'; ?></a>
                <a <?php echo 'selected-menu'; ?>  href="input.php"><?php echo 'Вход'; ?></a>
                <a <?php echo 'selected-menu'; ?>  href="forma.php"><?php echo 'Форма обратной связи'; ?></a>
            </nav>

            <div class="text-center py-5">
                <h1>Зоомагазин "Кобра"</h1>
                <h3>Ждем вас в мире животных!</h3>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <section id="О нас">
                <h1>О нас</h1>

                <figure class="avatar">
                    <img src=<?php echo $imageClass; ?> alt="animals">
                    <img src=<?php echo $imageClass1; ?> alt="animals2">
                </figure>


                <p>
                    Зоомагазин "Кобра" предлагает широкий ассортимент товаров для
                    домашних питомцев. Мы являемся профессионалами в своей области и
                    заботимся о здоровье и комфорте животных. В нашем магазине вы
                    найдете корма, лакомства, игрушки, аксессуары и многое другое для
                    собак, кошек, грызунов, рептилий и рыбок. Мы используем только
                    натуральные материалы и уважаем окружающую среду. Приходите к нам и
                    сделайте жизнь своих питомцев более комфортной и счастливой.
                </p>
            </section>

            <br />
            <br />

            <section id="Режим работы">
                <h1>Режим работы</h1>

                <table>
                    <?php foreach ($workingHours as $hours) :?>
                    <tr>
                        <?php foreach ($hours as $time) :?>
                        <td><?php echo $time; ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </section>

            <br />
            <br />

            <section id="Контакты">
                <h1>Контакты</h1>
                <ul>
                    <?php foreach ($speclist as $spec) : ?>
                        <li><?php echo $spec; ?></li>
                    <?php endforeach; ?>
                </ul>
            </section>

            <br />
            <br />

            <section id="Адреса">
                <h1>Адреса</h1>
                <ul>
                    <h4>г. Москва</h4>
                    <?php foreach ($speclistAddress as $spec) : ?>
                        <li><?php echo $spec; ?></li>
                    <?php endforeach; ?>
            
                </ul>
            </section>
            <br />
        </div>
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