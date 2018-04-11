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

require 'verify_fields.php';

$keys = ['isbn', 'name', 'author', 'genre', 'year',  'count_of_pages', 'price'];
$values = [];
foreach ($keys as $key)
{
    array_push($values, $conn->real_escape_string($_POST[$key]));
}
$is_admin = $_POST['visible'] ? '1' : '0';
$pairs = array_combine($keys, $values);
$pairs['visible'] = $is_admin;
$pairs['author_id'] = $_SESSION['id'];

$result = $conn->query('SELECT cover FROM ' . $dbname . ' .books WHERE book_id = ' . $id);

if ($result->num_rows > 0)
{
    $row = $result->fetch_assoc();
    if ($_FILES['cover']['name'] != '')
    {
        $pairs['cover'] = $uploadfile;
    }
}

$sql = 'UPDATE ' . $dbname . ' .books SET ';
foreach ($pairs as $key => $value)
{
    if (in_array($key, ['isbn', 'name', 'author', 'genre', 'publishing_house', 'cover']))
    {
        $sql .= $key . ' = "' . $value . '", ';    
    }
    else
    {
        $sql .= $key . ' = ' . $value . ', '; 
    }
}
$sql = substr($sql, 0, -2);
$sql .= ' WHERE book_id = ' . $id;

if (!$conn->query($sql)) {
    die("Error: " . $sql . "<br>" . $conn->error);
}

header('Location: /index.php?action=main');

?>
