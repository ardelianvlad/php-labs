<?php

if (!isset($_SESSION["id"]))
{
    die('<h1>Для виконання даної операції потрібно здійснити вхід</h1>');
}
elseif (!$_SESSION['is_admin'])
{
    die('<h1>Дану дію може виконати лише адміністратор</h1>');
}

require './configs/dbconf.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset('utf8');

$id = $conn->real_escape_string($_GET['id']);

$sql = 'DELETE FROM bookshop.books WHERE book_id = ' . $id;

echo $sql;

if (!$conn->query($sql)) {
    die("Error: " . $sql . "<br>" . $conn->error);
}

header('Location: /index.php?action=main');

?>
