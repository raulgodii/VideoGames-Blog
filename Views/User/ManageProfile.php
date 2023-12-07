
<h1>Manage Profile</h1>

<?php if(isset($errorUpdateUser)) : ?>
        <p class="errorMessage">"Oops! Unable to update your profile. Check the details, and make sure the email isn't already in use. Please try again."</p>
<?php endif; ?>

<?php if(isset($_SESSION['login'])): ?>

    <?php if(isset($editProfile)): ?>
        <table class="tableManageProfile">
            <form action="<?=BASE_URL?>User/updateUser/" method="POST">
            <input type="hidden" name="updateUser[id]" value="<?=$_SESSION['login']->id?>">
            <input type="hidden" name="updateUser[password]" value="<?=$_SESSION['login']->password?>">
                <tr>
                    <th>Name</th>
                    <td><input type="text" name="updateUser[name]" value="<?=$_SESSION['login']->name?>"> </td>
                </tr>

                <tr>
                    <th>Last Name</th>
                    <td><input type="text" name="updateUser[last_name]" value="<?=$_SESSION['login']->last_name?>"></td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td><input type="text" name="updateUser[email]" value="<?=$_SESSION['login']->email?>"></td>
                </tr>

                <tr>
                    <th>Date</th>
                    <td><input type="date" name="updateUser[date]" value="<?=$_SESSION['login']->date?>"></td>
                </tr>

                <tr>
                    <th colspan="2">
                        <input style="border: 1px solid white;" type="submit" value="Confirm">
            </form>
                        <form action="<?=BASE_URL?>User/manageProfile/"><input style="border: 1px solid white;" type="submit" value="Cancel"></form>
                    </th>
                </tr>
            
        </table>
    <?php else: ?>
        <table class="tableManageProfile">
            <tr>
                <th>Name</th>
                <td><?=$_SESSION['login']->name?></td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td><?=$_SESSION['login']->last_name?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?=$_SESSION['login']->email?></td>
            </tr>

            <tr>
                <th>Date</th>
                <td><?=$_SESSION['login']->date?></td>
            </tr>

            <tr>
                <th colspan="2">
                    <form action="<?=BASE_URL?>User/editProfile/" method="POST">
                        <input style="border: 1px solid white;" type="submit" value="Edit">
                    </form>
                </th>
            </tr>
            
        </table>
    <?php endif; ?>
    
<?php endif; ?>

