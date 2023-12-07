<?php
    use Controllers\CategoryController;
    $CategoryController = new CategoryController();

    $categories = $CategoryController->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=BASE_URL?>Style/style.css">
    <script src="https://kit.fontawesome.com/8fd2dbd2a5.js" crossorigin="anonymous"></script>
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
                    <?php if($_SESSION['login']->email === "admin@admin.com"): ?>
                        <li><a href="<?=BASE_URL?>Category/manageCategories/">Manage Categories</a></li>
                    <?php endif; ?>
                    <li><a href="<?=BASE_URL?>Entry/manageEntries/">Manage Entries</a></li>
                    <li><a id="logout" href="<?=BASE_URL?>User/logout/">Log Out <i class="fa-solid fa-arrow-right-from-bracket"></i></a>  </li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="header-bottom">
            <nav>
                <ul>
                    <li><a href="<?=BASE_URL?>">Home</a></li>
                    <?php foreach($categories as $categorie): ?>
                        <li>
                        <a href="<?=BASE_URL?>Category/showEntriesFromCategorie/?category_id=<?=$categorie['id']?>&category_name=<?=$categorie['name']?>"><?=$categorie['name']?></a>
                        </li>

                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>

    </header>
    <main>

