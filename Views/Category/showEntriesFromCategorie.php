

<?php

use Controllers\UserController;
$userController = new UserController();

?>

<?php if(isset($entries)) : ?>

    <h1><?=$category_name?></h1>



        <div class="showEntries">
            <div class="entries">
                <?php foreach($entries as $entry) : ?>
                    <div class="entry">
                        <div>
                            <h2><?=$entry['title']?></h2>
                            <p><?=$entry['description']?></p>
                        </div>
                        
                        <div class="entry-dateUser">
                            <p>Edited by: <?= $userController->getUserFromId($entry['user_id'])[0]["name"]?></p>
                            <p><?=$entry['date']?></p>
                        </div>
                        
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="aside">
                <p>See others:</p>
                <ul>
                    <?php foreach($categories as $categorie): ?>
                        <li>
                        <a href="<?=BASE_URL?>Category/showEntriesFromCategorie/?category_id=<?=$categorie['id']?>&category_name=<?=$categorie['name']?>"><?=$categorie['name']?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

<?php else : ?>

<?php endif; ?>