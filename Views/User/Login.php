
<h2>Log In</h2>

<?php if(!isset($_SESSION['login'])): ?>

<form action="<?=BASE_URL?>User/login/" method="POST">
    <label for="email">Email</label>
    <input type="email" name="data[email]" id="email" required/>

    <label for="password">Password</label>
    <input type="password" name="data[password]" id="password" required/>
    
    <input type="submit" value="Log in"/>
</form>

<?php elseif(isset($_SESSION['login'])): ?>
    <h3> Has iniciado sesión con exito como: <?= $_SESSION['login']->name?></h3>
<?php endif; ?>