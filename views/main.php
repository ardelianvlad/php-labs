<script src="/js/confirm_delete.js"></script>

<div class="container text-center mt-4">

    <div class="row">
<?php 
if(!isset($_SESSION["id"]))
{
    echo '<a class="btn btn-primary btn-lg mb-3" href="/index.php?action=registration">Реєстрація</a>';
}
if (isset($_SESSION["id"]))
{
    echo '<a class="btn btn-primary btn-lg mb-3" href="/index.php?action=add_book">Додати товар</a>';
}
?>
    </div>

    <div class="row">
<?php 

    require 'views/crud/cards.php';
    require 'configs/dbconf.php';

    $sql = 'SELECT * FROM ' . $dbname . ' .books ORDER BY date DESC';
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc())
        {
            if ($row['visible'] or isset($_SESSION["id"]) and $_SESSION['is_admin'])
            {
                addCard($row['book_id'], $row['name'], $row['author'], '<strong>' . $row['price'] . '₴</strong>', $row['cover']);
            }
        }
    }

?>
    </div>
</div>

