<?php include view_path('partials/header.php'); ?>

<h1>Привет, <?= $user['username'] ?? '' ?></h1>
<div class="pl-row">
    <div>
        <h3>Изменить информацию</h3>
        <form action="/update" method="POST">
            <input type="hidden" name="_token" value="<?= $_SESSION['_token'] ?? '' ?>">
            <input type="hidden" name="_method" value="PATCH">
            <div>
                <label for="phone">Телефон:</label>
                <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($user['phone']) ?? '' ?>">
                <?php if (isset($_SESSION['_flash']['errors']['phone'])) : ?>
                    <small><?= $_SESSION['_flash']['errors']['phone'][0] ?></small>
                <?php endif; ?>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?? '' ?>">
                <?php if (isset($_SESSION['_flash']['errors']['email'])) : ?>
                    <small><?= $_SESSION['_flash']['errors']['email'][0] ?></small>
                <?php endif; ?>
            </div>
            <div>
                <label for="username">Никнейм:</label>
                <input type="text" name="username" id="username" value="<?= htmlspecialchars($user['username']) ?? '' ?>">
                <?php if (isset($_SESSION['_flash']['errors']['username'])) : ?>
                    <small><?= $_SESSION['_flash']['errors']['username'][0] ?></small>
                <?php endif; ?>
            </div>
            <div>
                <button type="submit">Сохранить</button>
            </div>
        </form>
    </div>
    <br>
    <br>
    <br>
    <div>
        <h3>Изменить пароль</h3>
        <form action="/change-password" method="POST">
            <input type="hidden" name="_token" value="<?= $_SESSION['_token'] ?? '' ?>">
            <input type="hidden" name="_method" value="PATCH">
            <div>
                <label for="password">Пароль:</label>
                <input type="password" name="password" id="password">
                <?php if (isset($_SESSION['_flash']['errors']['password'])) : ?>
                    <small><?= $_SESSION['_flash']['errors']['password'][0] ?></small>
                <?php endif; ?>
            </div>
            <div>
                <label for="password_repeat">Повторите пароль:</label>
                <input type="password" name="password_repeat" id="password_repeat">
                <?php if (isset($_SESSION['_flash']['errors']['password_repeat'])) : ?>
                    <small><?= $_SESSION['_flash']['errors']['password_repeat'][0] ?></small>
                <?php endif; ?>
            </div>
            <div>
                <button type="submit">Изменить</button>
            </div>
        </form>
    </div>
</div>
<br>
<br>
<br>
<form action="/logout" method="POST">
    <input type="hidden" name="_token" value="<?= $_SESSION['_token'] ?? '' ?>">
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit" class="outline">Выйти</button>
</form>

<?php include view_path('partials/footer.php'); ?>
