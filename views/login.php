<?php include view_url('partials/header.php'); ?>

<h1>Логин</h1>
<form action="/login" method="POST">
    <div>
        <label for="phone_or_email">Телефон или email:</label><br>
        <input type="text" name="phone_or_email" id="phone_or_email">
        <?php if (isset($_SESSION['_flash']['errors']['phone_or_email'])) : ?>
            <p><?= $_SESSION['_flash']['errors']['phone_or_email'][0] ?></p>
        <?php endif; ?>
    </div>
    <div>
        <label for="password">Пароль:</label><br>
        <input type="password" name="password" id="password">
        <?php if (isset($_SESSION['_flash']['errors']['password'])) : ?>
            <p><?= $_SESSION['_flash']['errors']['password'][0] ?></p>
        <?php endif; ?>
    </div>
    <?php if (isset($_SESSION['_flash']['errors']['global'])) : ?>
        <p><?= $_SESSION['_flash']['errors']['global'][0] ?></p>
    <?php endif; ?>
    <div>
        <button type="submit">Войти</button>
    </div>
</form>

<?php include view_url('partials/footer.php'); ?>
