<?php

if (!isset($_SESSION["id"]))
{
    die('<h1>Для виконання даної операції потрібно здійснити вхід</h1>');
}
elseif (!$_SESSION['is_admin'])
{
    die('<h1>Ти не адмін!</h1>');
}

if(array_key_exists('errors', $_GET))
{
    $errors = explode('@', $_GET['errors']);
}
else
{
    $errors = [];
}

require 'configs/dbconf.php';

$id = $conn->real_escape_string($_GET['id']);

$sql = 'SELECT * FROM ' . $dbname . ' .books WHERE book_id = ' . $id .';';
$result = $conn->query($sql);

if ($result->num_rows > 0)
{
    $row = $result->fetch_assoc();
}
else
{
    header('HTTP/1.0 404 Not Found');
    echo '<h1>404</h1><p>Object Not Found</p>';
    exit();
}

?>
<form enctype="multipart/form-data" action="/index.php?action=update_book&id=<?= $id ?>" method="post" class="mt-2">
<?php 
require 'views/crud/form_book.php';
bookForm($errors, $row);
?>
    <button type="submit" class="btn btn-warning pull-right">Змінити</button>
</form>