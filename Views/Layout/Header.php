<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <ul>
            <?php if(!isset($_SESSION['login'])): ?>
                <li><a href="<?=BASE_URL?>User/Login/">Log in</a></li>
                <li><a href="<?=BASE_URL?>User/Register/">Sing Up</a></li>
                
            <?php else: ?>
                <h2><?=$_SESSION['login']->name?> <?=$_SESSION['login']->last_name?></h2>
                <a href="<?=BASE_URL?>User/logout/">Log Out</a>
            <?php endif; ?>
        </ul>
    </header>

