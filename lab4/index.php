<?php
include 'header.html';
?>

<?php
if (isset($_GET['N'])) {
    $name = $_GET['N'];
}
else{
    $name = '';
}
if (isset($_GET['E'])) {
    $email = $_GET['E'];
}
else{
    $email = '';
}
if (isset($_GET['S'])) {
    $source = $_GET['S'];
}
else{
    $source = '';
}
?>



<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $source = $_POST['source'];
    $category = $_POST['category'];
    $message = $_POST['message'];
    $attachment = isset($_POST['attachment']) ? 'Yes' : 'No';
    $agreement = $_POST['agreement'];

    header("Location: home.php?name=$name&message=$message&source=$source&attachment=$attachment");
    exit();
}
?>


<body>
    <main>
        <h2>Форма обратной связи</h2>
        <form action="home.php" method="post">
            <div class="form-group">
                <label class="form-label" for="name">ФИО</label>
                <input id="name" type="text" name="name" value="<?=$name ?>" required>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input id="email" type="text" name="email" placeholder="example@example.com" value="<?=$email ?>"required>
            </div>

            <div class="form-group">
                <h4 class="form-label">Как вы узнали о нас?</h4>
                <input id="advertising" type="radio" name="source" value="advertising" <?php if ($source == 'advertising') echo ' checked="checked"'?>>
                <label for="advertising">Реклама в интернете</label>

                <input id="friends" type="radio" name="source" value="friends" <?php if ($source == 'friends') echo ' checked="checked"'?>>
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
                <textarea id="message" name="message" cols="30" rows="10"></textarea>
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

</body>