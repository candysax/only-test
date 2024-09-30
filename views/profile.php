<?php include view_url('partials/header.php'); ?>

<h1>Привет, <?= $user['username'] ?></h1>
<form action="/logout" method="POST">
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit">Выйти</button>
</form>

<?php include view_url('partials/footer.php'); ?>
