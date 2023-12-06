<?php
    // EntryController
    use Controllers\EntryController;
    $EntryController = new EntryController();

    $entries = $EntryController->getAll();
?>

    


<h1>Manage Entries</h1>

<?php if(isset($errorEntry)): ?>
    <p class="errorMessage">There was an error while inserting the entry</p>
<?php endif; ?>

<div class="tableCategories">
    <table >
        <?php if(count($entries) == 0):?>
            <p style="margin: 20px">There are not entries yet.</p>
        <?php else:?>
            <tr>
                <th>ID</th>
                <th>TITLE</th>
                <th>CATEGORY</th>
                <th>DATE</th>
                <th></th>
            </tr>
            <?php foreach($entries as $entry): ?>
                <tr>
                    <td><?=$entry['id']?></td>
                    <td><?=$entry['title']?></td>
                    <td><?= $CategoryController->getCategoryFromId($entry['category_id'])?></td>
                    <td><?=$entry['date']?></td>
                    <td>
                        <form action="<?=BASE_URL?>Entry/editEntry/" method="POST">
                            <input type="hidden" name="editEntry[id]" value="<?=$entry['id']?>">
                            <input type="hidden" name="editEntry[title]" value="<?=$entry['title']?>">
                            <input type="hidden" name="editEntry[description]" value="<?=$entry['description']?>">
                            <input type="hidden" name="editEntry[category_id]" value="<?=$entry['category_id']?>">
                            <input type="submit" value="Edit">
                        </form>
                        <form action="<?=BASE_URL?>Entry/deleteEntry/" method="POST">
                            <input type="hidden" name="idEntry" value="<?=$entry['id']?>">
                            <input type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</div>


<form class="addCategorieForm" action="<?=BASE_URL?>Entry/addEntry/" method="POST">
    <input type="submit" value=" + Add Entry">
</form>