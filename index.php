<?php

session_start();

$action = $_GET['action'] ? $_GET['action'] : 'main';
$dirs = ['views', 'actions', 'views/crud', 'actions/crud'];

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    include_once './layout/header.php';
    include_once './layout/left_menu.php';
}

foreach ($dirs as $dir)
{
    $page = './' . $dir . '/' . $action . '.php';
    if (file_exists($page))
    {
        include_once $page;
        break;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{   
    include_once './layout/footer.php';
}

?>