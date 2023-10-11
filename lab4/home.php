<?php
include 'header.html';
?>

<body>
    <?php
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $attachment = $_POST['attachment'];
        $message = $_POST['message'];
        $category = $_POST['category'];
        $source = $_POST['source'];
    }

    echo '<h2> Здравствуйте, ' .$_POST['name']. '</h2>'; //выводим ФИО
    if ($_POST['category'] == 'proposal'){ //проверяем тип обращения
           echo '<h3>Спасибо за ваше предложение:</h3>';
           echo '<h3><textarea>' .$_POST['message'] .'</textarea></h3>';//вывод текста сообщения
    }
    else{
           echo '<h3>Мы рассмотрим Вашу жалобу:</h3>';
           echo '<h3><textarea>'.$_POST['message'].'</textarea></h3>';
    }

    if (isset($_POST['attachment']) & $_POST['attachment'] != '') 
        echo '<h3>Вы приложили следующий файл: '.$_POST['attachment']. '</h3>';

    echo '<br><a class="button" href="index.php?N=' . $_POST['name'] . '&E=' . $_POST['email'] . '&S=' . $_POST['source'] . '">Заполнить снова</a>';

    ?>
</body>

</html> 