<div class="container text-center" style="width: 60%">
    <h2 class="mb-3 mt-1">Вхід</h2>
<?php
    if(array_key_exists('error', $_GET))
    {
        echo '<div class="alert alert-danger" role="alert">Невірний логін або пароль.</div>';
    }
?>
    <form action="/index.php?action=check_user" method="post">
        <div class="form-group row">
            <label for="username">Логін</label>
            <input type="text" placeholder="логін" name="username" class="form-control rounded"/>
        </div>
        <div class="form-group row">
            <label for="pass">Пароль</label>
            <input type="password" placeholder="пароль" name="pass" class="form-control rounded"/>
        </div>
        <div class="form-group row">
            <button type="submit" class="btn btn-block rounded mt-2" style="color: #333">Увійти</button>
        </div>
    </form>
</div>
