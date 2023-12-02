<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=BASE_URL?>Style/style.css">
    <title>VideoGames - Blog</title>
</head>
<body>
    <header>
        <div class="header-top">
            <h1><a href="#">VideoGames - Blog</a></h1>
            <ul>
                <?php if(!isset($_SESSION['login'])): ?>
                    <li><a href="<?=BASE_URL?>User/Login/">Log in</a></li>
                    <li><a href="<?=BASE_URL?>User/Register/">Sing Up</a></li>
                <?php else: ?>
                    <li><h2><?=$_SESSION['login']->name?> <?=$_SESSION['login']->last_name?></h2></li>
                    <li><a href="<?=BASE_URL?>User/logout/">Log Out</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="header-bottom">
            <nav>
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">Action</a></li>
                    <li><a href="">Rol</a></li>
                    <li><a href="">Sports</a></li>
                    <li><a href="">Contact</a></li>
                    <li><a href="<?=BASE_URL?>Category/manageCategories/">Probar Categorias</a></li>
                </ul>
            </nav>
        </div>

    </header>
    <main>

