<?php

if (!isset($_SESSION["id"]))
{
    die('<h1>Для виконання даної операції потрібно здійснити вхід</h1>');
}

if(array_key_exists('errors', $_GET))
{
    $errors = explode('@', $_GET['errors']);
}
else
{
    $errors = [];
}

?>
<form enctype="multipart/form-data" action="/index.php?action=insert_book" method="post" class="mt-2">
<?php 
require 'views/crud/form_book.php';
bookForm($errors);
?>
    <button type="submit" class="btn btn-primary pull-right">Зберегти</button>
</form>