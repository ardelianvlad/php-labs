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

$id = $conn->real_escape_string($_GET['id']);

$sql = 'SELECT cover FROM ' . $dbname . ' .books WHERE book_id = ' . $id .';';
$result = $conn->query($sql);

if ($result->num_rows > 0)
{
    $row = $result->fetch_assoc();
    if(file_exists($row['cover']))
    {
        unlink($row['cover']);   
    }
}

$sql = 'DELETE FROM ' . $dbname . '.books WHERE book_id = ' . $id;

if (!$conn->query($sql)) {
    die("Error: " . $sql . "<br>" . $conn->error);
}

header('Location: /index.php?action=main');

?>
