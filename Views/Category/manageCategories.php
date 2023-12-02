<?php
    use Controllers\CategoryController;
    $CategoryController = new CategoryController();

    $categories = $CategoryController->getAll();
?>

<h1>Manage Categories</h1>



<table>
    <?php if(count($categories) == 0):?>
        <p>There are not categories yet</p>
    <?php else:?>
        <?php foreach($categories as $categorie): ?>
            <tr>
                <td><?=$categorie['id']?></td>
                <td><?=$categorie['name']?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>

<form action="<?=BASE_URL?>Category/saveCategory/" method="POST">
    <label for="newCategory">Add New Categorie: </label>
    <input type="text" name="newCategory" id="newCategory">
    <input type="submit" value="Add">
</form>