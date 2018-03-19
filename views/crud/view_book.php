<?php
require 'configs/dbconf.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
} 

$conn->set_charset('utf8');

$id = $conn->real_escape_string($_GET['id']);

$sql = 'SELECT * FROM bookshop.books WHERE book_id = ' . $id .';';
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

$img = $row['cover'] ?: './img/nocover.png';

?>

<script type="text/javascript">
    function onClick() {
        var txt;
        var r = confirm("Ви точно хочете видалити цей товар?");
        if (r == true) {
            document.location.href = '/index.php?action=delete_book&id=' + <?= $id ?>;
        }
    }
</script>

<div class="container">
    <div class="row">
        <div class="col-sm-10">
            <p><?= $row['author'] ?></p>
            <h4><?= $row['name'] ?></h4>
            <div class="fluid pb-3">
<?php 
    if (isset($_SESSION["id"]) and $_SESSION['is_admin'])
    {
        echo '<a href="/index.php?action=edit_book&id=' . $id . '" class="btn btn-warning btn-sm mr-3">Редагувати</a>'
            .'<a href="javascript: onClick()" class="btn btn-danger btn-sm mr-3">Видалити</a>';
    }
?>
            </div>
            <img src="<?= $img ?>" alt="Cover" style="width: 75%">
            <h3 class="text-info text-center mt-4"><?= $row['price'] ?>₴</h3>
            <div class="fluid text-center mt-3 mb-3">
                <a href="#" class="btn btn-warning">Купити</a>
            </div>
        </div>
    </div>
    <div class="row">
        <h5>Характеристики</h5>
    </div>
    <div class="row">
        <table class="table table-striped col-sm-10">
            <tbody>     
<?php 
$info = [
    'isbn' => 'ISBN:',
    'name' => 'Назва:',
    'author' => 'Автор:',
    'genre' => 'Жанр:',
    'year' => 'Рік видання:',
    'publishing_house' => 'Видавництво:',
    'count_of_pages' => 'Кількість сторінок',
];
foreach ($info as $key => $value) {
    echo '<tr><td><strong>' . $value . '</strong></td><td>' . $row[$key] . '</td></tr>';
}
?>
            </tbody>
        </table>
    </div>
</div>