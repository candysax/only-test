<?php include view_path('partials/header.php'); ?>

<div style="text-align: center">
<h1>Тестовое задание</h1>
<?php if (isset($_SESSION['user'])):?>
    <a href="/profile"><button>Профиль</button></a>
<?php else: ?>
<div>
    <a href="/login"><button>Вход</button></a>
    <a href="/register"><button>Регистрация</button></a>
</div>
<?php endif; ?>

<?php include view_path('partials/footer.php'); ?>
</div>
