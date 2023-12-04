<?php
    use Controllers\CategoryController;
    $CategoryController = new CategoryController();

    $categories = $CategoryController->getAll();
?>

    


<h1>Manage Categories</h1>


<div class="tableCategories">
    <table >
        <?php if(count($categories) == 0):?>
            <p style="margin: 20px">There are not categories yet.</p>
        <?php else:?>
            <tr>
                <th>ID</th>
                <th>CATEGORY</th>
                <th></th>
            </tr>
            <?php foreach($categories as $categorie): ?>
                <tr>
                    <?php if(isset($idCategoryEdit) && $idCategoryEdit==$categorie['id']):?>
                        <form action="<?=BASE_URL?>Category/editedCategory/" method="POST">
                            <input type="hidden" name="idCategory" value="<?=$categorie['id']?>">
                            <td><?=$categorie['id']?></td>
                            <td>
                                <input type="hidden" name="idCategory" value="<?=$categorie['id']?>">
                                <input type="text" name="nameCategory" value="<?=$categorie['name']?>">
                            </td>
                            <td>
                                <input type="submit" value="Confirm">
                            </td>
                        </form>
                    <?php else: ?>
                        <td><?=$categorie['id']?></td>
                        <td><?=$categorie['name']?></td>
                        <td>
                            <form action="<?=BASE_URL?>Category/editCategory/" method="POST">
                                <input type="hidden" name="idCategory" value="<?=$categorie['id']?>">
                                <input type="submit" value="Edit">
                            </form>
                            <form action="<?=BASE_URL?>Category/deleteCategory/" method="POST">
                                <input type="hidden" name="idCategory" value="<?=$categorie['id']?>">
                                <input type="submit" value="Delete">
                            </form>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</div>



<?php if(isset($errorCategory)): ?>
    <p class="errorMessage">There was an error while inserting the category</p>
<?php endif; ?>


<form class="addCategorieForm" action="<?=BASE_URL?>Category/saveCategory/" method="POST">
    <label for="newCategory">Add New Categorie: </label>
    <input type="text" name="newCategory" id="newCategory">
    <input type="submit" value="Add">
</form>