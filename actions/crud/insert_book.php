<?php

if (!isset($_SESSION["id"]))
{
    die('<h1>Для виконання даної операції потрібно здійснити вхід</h1>');
}

require './configs/dbconf.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$conn->set_charset('utf8');

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

if ($_FILES['cover']['name'] != '') 
{
    $uploadfile = './img/' . $_FILES['cover']['name'];
    move_uploaded_file($_FILES['cover']['tmp_name'], $uploadfile);
}

if ($errors !== '')
{
    header('Location: /index.php?action=add_book&errors=' . $errors);
    exit();
}

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

$sql = 'INSERT INTO bookshop.books(' . implode(', ' , $keys) . ', visible, author_id, cover) VALUES'
        . vsprintf('("%s", "%s", "%s", "%s", %d, "%s", %d, %f, %d, %d, "%s") ', $values);

echo $uploadfile;
echo $sql;

if (!$conn->query($sql)) {
    die("Error: " . $sql . "<br>" . $conn->error);
}

header('Location: /index.php?action=main');

?>
