<?php 

function addCard($id='', $title='', $author='', $price = '', $img='')
{
    global $uploadsdir;
    $img = $uploadsdir . $img;
    if(!file_exists($img))
    {
        $img = $uploadsdir . 'nocover.png';
    }
?>

    <div class="card mb-2 mr-2 pl-2 pr-2 border-primary" style="width: 32%">
        <img class="card-img-top mt-2" src="<?= $img ?>" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title"><?= $title ?></h5>
            <div class="fluid pb-2 text-center">
<?php 
    if (isset($_SESSION["id"]) and $_SESSION['is_admin'])
    {
        echo '<a href="/index.php?action=edit_book&id=' . $id . '" class="btn btn-warning btn-sm ml-1 mr-1 mt-2">Редагувати</a>'
            . '<a href="javascript: onClick(' . $id . ')" class="btn btn-danger btn-sm ml-1 mr-1 mt-2">Видалити</a>';
    }
?>
            </div>
            <p class="card-text"><?= $author ?></p>
            <p class="card-text"><?= $price ?></p>
            <a class="btn btn-primary" href="/index.php?action=view_book&id=<?= $id ?>">Детальніше</a>
        </div>
    </div>
<?php
}
?>


