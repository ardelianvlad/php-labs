<?php

if (!isset($_SESSION["id"]))
{
    die('<h1>Для виконання даної операції потрібно здійснити вхід</h1>');
}
elseif (!$_SESSION['is_admin'])
{
    die('<h1>Ти не адмін!</h1>');
}

require './configs/dbconf.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset('utf8');

$id = $conn->real_escape_string($_GET['id']);

$errors = '';
$pattern = '/[A-Za-zА-Яа-яЇїІіЄє0-9-\.\,-_]+/u';

if (!preg_match('/[\d-]{17}/', $_POST['isbn']))
{
    $errors .= 'isbn@';
}
if(!preg_match('/\d{4}/', $_POST['year']))
{
    $errors .= 'year@';
}
if(!preg_match('/\d{1,4}/', $_POST['count_of_pages']))
{
    $errors .= 'pages@';
}
if(!preg_match('/\d+[\.\,]*\d*/', $_POST['price']))
{
    $errors .= 'price@'; 
}
if(!preg_match($pattern, $_POST['name']))
{
    $errors .= 'name@';
}
if(!preg_match($pattern, $_POST['author']))
{
    $errors .= 'author@';
}
if(!preg_match($pattern, $_POST['genre']))
{
    $errors .= 'genre@';
}
if(!preg_match($pattern, $_POST['publishing_house']))
{
    $errors .= 'publ@';
}

if ($errors !== '')
{
    header('Location: /index.php?action=edit_book&id=' . $id . '&errors=' . $errors);
    exit();
}

$uploadfile = './img/' . $_FILES['cover']['name'];
move_uploaded_file($_FILES['cover']['tmp_name'], $uploadfile);

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

$result = $conn->query('SELECT cover FROM bookshop.books WHERE book_id = ' . $id);

if ($result->num_rows > 0)
{
    $row = $result->fetch_assoc();
    if ($_FILES['cover']['name'] != '')
    {
        $pairs['cover'] = $uploadfile;
    }
}


$sql = 'UPDATE bookshop.books SET ';
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

echo $sql;

if (!$conn->query($sql)) {
    die("Error: " . $sql . "<br>" . $conn->error);
}

header('Location: /index.php?action=main');

?>
