<div class="container text-center mt-4">

    <div class="row">
<?php 
if(!isset($_SESSION["id"]))
{
    echo '<a class="btn btn-primary btn-lg mb-3" href="/flab/index.php?action=registration">Реєстрація</a>';
}
if (isset($_SESSION["id"]))
{
    echo '<a class="btn btn-primary btn-lg mb-3" href="/flab/index.php?action=add_book">Додати товар</a>';
}
?>
    </div>

    <div class="row">
<?php 

    require 'scripts/cards.php';
    require 'configs/dbconf.php';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    } 

    $conn->set_charset('utf8');

    $sql = 'SELECT * FROM bookshop.books ORDER BY date DESC';
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc())
        {
            if ($row['visible'])
            {
                addCard($row['book_id'], $row['name'], $row['author'], '<strong>' . $row['price'] . '₴</strong>', $row['cover']);
            }
        }
    }

?>
    </div>
</div>

