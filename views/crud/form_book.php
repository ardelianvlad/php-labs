<?php 
function bookForm($errors, $data=false)
{

if(in_array('isbn', $errors))
{
    echo '<div class="text-danger" role="alert">Неправильний ISBN</div>';
}
?> 
    <div class="form-group row">
        <label for="isbn" class="col-sm-4 col-form-label">ISBN: </label>
        <div class="col-sm-8">
            <input type="text" id="isbn" class="form-control" name="isbn" placeholder="isbn" value="<?= $data ? $data['isbn'] : '' ?>">
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
            <input type="text" id="name" class="form-control" name="name" placeholder="назва"  value="<?= $data ? $data['name'] : '' ?>">
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
            <input type="text" id="author" class="form-control" name="author" placeholder="автор" value="<?= $data ? $data['author'] : '' ?>">
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
            <input type="text" id="genre" class="form-control" name="genre" placeholder="жанр" value="<?= $data ? $data['genre'] : '' ?>">
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
            <input type="text" id="year" class="form-control" name="year" placeholder="рік видавництва" value="<?= $data ? $data['year'] : '' ?>">
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
            <input type="text" id="publishing_house" class="form-control" name="publishing_house" placeholder="видавництво"  value="<?= $data ? $data['publishing_house'] : '' ?>">
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
            <input type="text" id="pages-count" class="form-control" name="count_of_pages" placeholder="кількість сторінок" value="<?= $data ? $data['count_of_pages'] : '' ?>">
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
            <input type="text" id="price" class="form-control" name="price" placeholder="ціна"  value="<?= $data ? $data['price'] : '' ?>">
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
<?php
    if($data)
    {
?>
    <div class="form-group row">
        <div class="col-sm-4"></div>
        <div class="col-sm-8">
            <input <?php if ($data['visible']) { echo "checked"; } ?> type="checkbox" id="visible" name="visible" value="1">
            <label for="visible">Видимий?</label>
        </div>
    </div>
<?php
    }
}
?>
