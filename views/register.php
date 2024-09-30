<?php include view_url('partials/header.php'); ?>

<h1>Регистрация</h1>
<form action="/register" method="POST">
    <div>
        <label for="phone">Телефон:</label><br>
        <input type="text" name="phone" id="phone">
        <?php if (isset($_SESSION['_flash']['errors']['phone'])) : ?>
            <p><?= $_SESSION['_flash']['errors']['phone'][0] ?></p>
        <?php endif; ?>
    </div>
    <div>
        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email">
        <?php if (isset($_SESSION['_flash']['errors']['email'])) : ?>
            <p><?= $_SESSION['_flash']['errors']['email'][0] ?></p>
        <?php endif; ?>
    </div>
    <div>
        <label for="username">Никнейм:</label><br>
        <input type="text" name="username" id="username">
        <?php if (isset($_SESSION['_flash']['errors']['username'])) : ?>
            <p><?= $_SESSION['_flash']['errors']['username'][0] ?></p>
        <?php endif; ?>
    </div>
    <div>
        <label for="password">Пароль:</label><br>
        <input type="password" name="password" id="password">
        <?php if (isset($_SESSION['_flash']['errors']['password'])) : ?>
            <p><?= $_SESSION['_flash']['errors']['password'][0] ?></p>
        <?php endif; ?>
    </div>
    <div>
        <label for="password_repeat">Повторите пароль:</label><br>
        <input type="password" name="password_repeat" id="password_repeat">
        <?php if (isset($_SESSION['_flash']['errors']['password_repeat'])) : ?>
            <p><?= $_SESSION['_flash']['errors']['password_repeat'][0] ?></p>
        <?php endif; ?>
    </div>
    <div>
        <button type="submit">Регистрация</button>
    </div>
</form>

<?php include view_url('partials/footer.php'); ?>
