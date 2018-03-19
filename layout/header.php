<!-- Start of page. -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <title>YaEBook</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <style>
        .pull-right {
            float: right !important;
        }
        .rounded {
            border-radius: 2rem !important;
        }
</style>
</head>
<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/index.php?action=main">EBook</a>
            </div>
            <ul class="nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Товари</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Доставка</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Бонуси</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Контакти</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
<?php
    if(isset($_SESSION["id"]))
    { 
        echo '<a class="nav-link" href="/index.php?action=logout"><span class="glyphicon glyphicon-log-in"></span>Вихід</a>';
    } 
    else
    {
        echo '<a class="nav-link" href="/index.php?action=login"><span class="glyphicon glyphicon-log-in"></span>Вхід</a>';
    }

?>
                </li>
            </ul>
        </div>
    </div>
    </nav>
	
