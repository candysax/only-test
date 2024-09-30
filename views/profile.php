<?php include view_path('partials/header.php'); ?>

<h1>Привет, <?= $user['username'] ?></h1>
<form action="/logout" method="POST">
    <input type="hidden" name="_token" value="<?= $_SESSION['_token'] ?? '' ?>">
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit">Выйти</button>
</form>

<?php include view_path('partials/footer.php'); ?>
