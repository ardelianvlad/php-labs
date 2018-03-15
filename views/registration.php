<?php
if (!isset($_SESSION["id"]))
{
?>

<div class="container text-center">
    <h2 class="mb-3 mt-1">Реєстрація</h2>
<?php
    if(array_key_exists('errors', $_GET))
    {
        echo '<div class="alert alert-danger" role="alert">';
        $errors = explode('@', $_GET['errors']);
        if(in_array('username', $errors))
        {
            echo 'Логін - не менше 4 літер, може містити лише латинські літери (великі та малі), цифри, нижнє підкреслення та дефіс.<br>';
        }
        if(in_array('pass', $errors))
        {
            echo 'Пароль - не менше 7 літер, обов’язково має містити великі та малі літери, а також цифри.<br>';
        }
        if(in_array('pass2', $errors))
        {
            echo 'Значення паролів мають співпадати.<br>';
        }
        if(in_array('email', $errors))
        {
            echo 'Неправильна пошта.<br>';
        }
        if(in_array('region', $errors))
        {
            echo 'Виберіть регіон.<br>';
        }
        echo '</div>';

    } 
?>
    <form action="/flab/index.php?action=register" method="post">
        <div class="form-group row">
            <label for="username">Логін</label>
            <input type="text" placeholder="логін" name="username" class="form-control rounded"/>
        </div>
        <div class="form-group row">
            <label for="pass">Пароль</label>
            <input type="password" placeholder="пароль" name="pass" class="form-control rounded"/>
        </div>
        <div class="form-group row">
            <label for="pass2">Повторіть пароль</label>
            <input type="password" placeholder="повторіть пароль" name="pass2" class="form-control rounded"/>
        </div>
        <div class="form-group row">
            <label for="email">Електронна пошта</label>
            <input type="email" placeholder="e-mail" name="email" class="form-control rounded"/>
        </div>
        <div class="form-group row">
            <label for="region">Область</label>
            <select name="region" id="region" class="form-control rounded">
            <option value="0">Оберіть область</option>
<?php
    $str = file_get_contents("res/regions.json");
    $regions = json_decode($str);
    foreach ($regions as $region) {
        echo '<option value="' . $region->id . '">' . $region->name . '</option>';
    }
?>
            </select>
        </div>
        
        <div class="form-group row">
            <button type="submit" class="btn btn-block rounded mt-2" style="color: #333">Зареєструватися</button>
        </div>
    </form>
</div>

<?php 
}
else
{
    header("Location: /flab/index.php?action=alert");
}
?>