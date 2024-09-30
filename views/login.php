<?php include view_path('partials/header.php'); ?>

<h1>Вход</h1>
<form action="/login" method="POST">
    <input type="hidden" name="_token" value="<?= $_SESSION['_token'] ?? '' ?>">
    <div>
        <label for="phone_or_email">Телефон или email:</label>
        <input type="text" name="phone_or_email" id="phone_or_email">
        <?php if (isset($_SESSION['_flash']['errors']['phone_or_email'])) : ?>
            <small><?= $_SESSION['_flash']['errors']['phone_or_email'][0] ?></small>
        <?php endif; ?>
    </div>
    <div>
        <label for="password">Пароль:</label>
        <input type="password" name="password" id="password">
        <?php if (isset($_SESSION['_flash']['errors']['password'])) : ?>
            <small><?= $_SESSION['_flash']['errors']['password'][0] ?></small>
        <?php endif; ?>
    </div>
    <div>
        <div
            id="captcha-container"
            class="smart-captcha"
            data-sitekey="<?= $captcha_key ?? '' ?>"
        ></div>
        <?php if (isset($_SESSION['_flash']['errors']['captcha'])) : ?>
            <small><?= $_SESSION['_flash']['errors']['captcha'][0] ?></small>
        <?php endif; ?>
    </div>
    <?php if (isset($_SESSION['_flash']['errors']['global'])) : ?>
        <small><?= $_SESSION['_flash']['errors']['global'][0] ?></small>
    <?php endif; ?>
    <br>
    <div>
        <button type="submit">Войти</button>
    </div>
</form>

<?php include view_path('partials/footer.php'); ?>
