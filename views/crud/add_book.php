<?php

if (!isset($_SESSION["id"]))
{
    die('<h1>Для виконання даної операції потрібно здійснити вхід</h1>');
}

if(array_key_exists('errors', $_GET))
{
    $errors = explode('@', $_GET['errors']);
}
else
{
    $errors = [];
}

?>
<form enctype="multipart/form-data" action="/index.php?action=insert_book" method="post" class="mt-2">
<?php 
if(in_array('isbn', $errors))
{
    echo '<div class="text-danger" role="alert">Неправильний ISBN</div>';
}
?> 
    <div class="form-group row">
        <label for="isbn" class="col-sm-4 col-form-label">ISBN: </label>
        <div class="col-sm-8">
            <input type="text" id="isbn" class="form-control" name="isbn" placeholder="isbn">
        </div>
    </div>
<?php 
if(in_array('name', $errors))
{
    echo '<div class="text-danger" role="alert">Невірна назва</div>';
}
?> 
    <div class="form-group row">
        <label for="name" class="col-sm-4 col-form-label">Назва: </label>
        <div class="col-sm-8">
            <input type="text" id="name" class="form-control" name="name" placeholder="назва">
        </div>
    </div>
<?php 
if(in_array('author', $errors))
{
    echo '<div class="text-danger" role="alert">Автор вказаний невірно</div>';
}
?> 
    <div class="form-group row">
        <label for="author" class="col-sm-4 col-form-label">Автор: </label>
        <div class="col-sm-8">
            <input type="text" id="author" class="form-control" name="author" placeholder="автор">
        </div>
    </div>
<?php 
if(in_array('genre', $errors))
{
    echo '<div class="text-danger" role="alert">Неправильний жанр</div>';
}
?> 
    <div class="form-group row">
        <label for="genre" class="col-sm-4 col-form-label">Жанр: </label>
        <div class="col-sm-8">
            <input type="text" id="genre" class="form-control" name="genre" placeholder="жанр">
        </div>
    </div>
<?php 
if(in_array('year', $errors))
{
    echo '<div class="text-danger" role="alert">Рік видання вказано невірно</div>';
}
?> 
    <div class="form-group row">
        <label for="year" class="col-sm-4 col-form-label">Рік видавництва: </label>
        <div class="col-sm-8">
            <input type="text" id="year" class="form-control" name="year" placeholder="рік видавництва">
        </div>
    </div>
<?php 
if(in_array('publ', $errors))
{
    echo '<div class="text-danger" role="alert">Неправильно вказане видавництво</div>';
} 
?> 
    <div class="form-group row">
        <label for="publishing_house" class="col-sm-4 col-form-label">Видавництво: </label>
        <div class="col-sm-8">
            <input type="text" id="publishing_house" class="form-control" name="publishing_house" placeholder="видавництво">
        </div>
    </div>
<?php 
if(in_array('pages', $errors))
{
    echo '<div class="text-danger" role="alert">Невірна кількість сторінок</div>';
}  
?> 
    <div class="form-group row">
        <label for="count_of_pages" class="col-sm-4 col-form-label">Кількість сторінок: </label>
        <div class="col-sm-8">
            <input type="text" id="pages-count" class="form-control" name="count_of_pages" placeholder="кількість сторінок">
        </div>
    </div>
<?php 
if(in_array('price', $errors))
{
    echo '<div class="text-danger" role="alert">Неправильна ціна</div>';
}
?> 
    <div class="form-group row">
        <label for="price" class="col-sm-4 col-form-label">Ціна: </label>
        <div class="col-sm-8">
            <input type="text" id="price" class="form-control" name="price" placeholder="ціна">
        </div>
    </div>
<?php
if(in_array('cover', $errors))
{
    echo '<div class="text-danger" role="alert">Некорректний файл</div>';
}
?>
    <div class="form-group row">
        <label for="cover" class="col-sm-4 col-form-label">Обкладинка: </label>
        <div class="col-sm-8">
            <input type="file" id="cover" class="form-control" name="cover" accept=".jpg, .jpeg, .png, .gif">
        </div>
    </div>
    <button type="submit" class="btn btn-primary pull-right">Зберегти</button>
</form>