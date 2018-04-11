<?php

if (!isset($_SESSION["id"]))
{
    die('<h1>Для виконання даної операції потрібно здійснити вхід</h1>');
}

require './configs/dbconf.php';

require 'verify_fields.php';

$keys = ['isbn', 'name', 'author', 'genre', 'year', 'publishing_house', 'count_of_pages', 'price'];
$values = [];
foreach ($keys as $key)
{
    array_push($values, $conn->real_escape_string($_POST[$key]));
}
$is_admin = $_SESSION['is_admin'] ? '1' : '0';
array_push($values, $is_admin);
array_push($values, $_SESSION['id']);
array_push($values, $uploadfile);

$sql = 'INSERT INTO ' . $dbname . ' .books(' . implode(', ' , $keys) . ', visible, author_id, cover) VALUES'
        . vsprintf('("%s", "%s", "%s", "%s", %d, "%s", %d, %f, %d, %d, "%s") ', $values);

if (!$conn->query($sql)) {
    die("Error: " . $sql . "<br>" . $conn->error);
}

header('Location: /index.php?action=main');

?>
