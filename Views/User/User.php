<h1>Prueba de registro</h1>

<form action="<?=BASE_URL?>User/register/" method="POST">
    <p>
        <label>Name</label>
        <input type="text" name="data[name]">
    </p>
    <p>
        <label>Last Name</label>
        <input type="text" name="data[last_name]">
    </p>
    <p>
        <label>Email</label>
        <input type="email" name="data[email]">
    </p>
    <p>
        <label>Correo</label>
        <input type="password" name="data[password]">
    </p>
    <p>
        <label>Date of Birth</label>
        <input type="date" name="data[date]">
    </p>
    <p>
        <input type="submit">
    </p>
</form>