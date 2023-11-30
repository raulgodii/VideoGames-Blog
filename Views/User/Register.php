<?php
use Utils\Utils; 
?>

<h1>Sing Up</h1>

<?php if(isset($_SESSION['register']) && $_SESSION['register'] === 'failed'): ?>
    <p>Ha ocurrido un error con el registro</p>
    <?php Utils::deleteSession('register');?>
<?php endif; ?>

<?php if(!isset($_SESSION['register'])): ?>
    

<form action="<?=BASE_URL?>User/register/" method="POST">
    <p>
        <label>Name</label>
        <input type="text" name="data[name]" required>
    </p>
    <p>
        <label>Last Name</label>
        <input type="text" name="data[last_name]" required>
    </p>
    <p>
        <label>Email</label>
        <input type="email" name="data[email]" required>
    </p>
    <p>
        <label>Date of Birth</label>
        <input type="text" name="data[date]" required>
    </p>
    <p>
        <label>Password</label>
        <input type="password" name="data[password]" required>
    </p>
    <p>
        <input type="submit" value="Register">
    </p>
</form>

<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] === 'complete') : ?>
    <p>Registro completado satisfactoriamente</p>
    <?php Utils::deleteSession('register');?>
    <?php header("Location:".BASE_URL) ?>
<?php endif; ?>