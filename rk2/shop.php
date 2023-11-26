<?php

include "db.php";
$query = "SELECT * FROM products";
$products = mysqli_query($mysql, $query);
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
                <li><a href="contact.php">Контакты</a></li>
                <li><a onclick="goBack()">Назад</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="product-list">
            <?php foreach ($products as $product) : ?>
                <div class="product">
                    <div class = "image-container">
                        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    </div>
                    <p><?php echo $product['name']; ?></p>
                    <p>Цена: <?php echo $product['price']; ?></p>
                    <p><?php echo $product['description']; ?></p>
                    <button class="view-details" data-product-id="<?php echo $product['id']; ?>">Подробнее</button>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer>
        <p>Контактные данные: +7 (999) 999 - 99 - 99</p>
        <p>&copy; 2023 Магазин</p>
    </footer>

    <script src="index.js"></script>
</body>

</html>