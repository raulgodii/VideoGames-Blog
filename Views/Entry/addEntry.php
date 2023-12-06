<?php
    // EntryController
    use Controllers\EntryController;
    $EntryController = new EntryController();

    $entries = $EntryController->getAll();
?>

<h1>Add New Entry</h1>

<?php if(isset($editEntry)): ?>
    <form class="addCategorieForm" action="<?=BASE_URL?>Entry/updateEntry/" method="POST">
        <input type="hidden" name="updateEntry[id]" value="<?=$editEntry['id']?>">
        <label for="tileEntry">Title: </label>
        <input type="text" name="updateEntry[title]" id="titleEntry" value="<?=$editEntry['title']?>">
        <label for="descriptionEntry">Description: </label>
        <textarea name="updateEntry[description]" id="descriptionEntry" cols="30" rows="10"><?=$editEntry['description']?></textarea>
        <label for="categoryEntry">Category: </label>
        <select name="updateEntry[category_id]" id="categoryEntry">
            <?php foreach($categories as $categorie):?>
                <option value="<?=$categorie['id']?>" <?php if($categorie['id'] == intval($editEntry['category_id'])) echo "selected" ?> > <?=$categorie['name']?></option>
            <?php endforeach;?>
        </select>
        <input type="submit" value="Add">
    </form>
<?php else: ?>
    <form class="addCategorieForm" action="<?=BASE_URL?>Entry/saveEntry/" method="POST">
        <label for="tileEntry">Title: </label>
        <input type="text" name="newEntry[title]" id="titleEntry">
        <label for="descriptionEntry">Description: </label>
        <textarea name="newEntry[description]" id="descriptionEntry" cols="30" rows="10"></textarea>
        <label for="categoryEntry">Category: </label>
        <select name="newEntry[category_id]" id="categoryEntry">
            <?php foreach($categories as $categorie):?>
                <option value="<?=$categorie['id']?>"><?=$categorie['name']?></option>
            <?php endforeach;?>
        </select>
        <input type="submit" value="Add">
    </form>
<?php endif; ?>

