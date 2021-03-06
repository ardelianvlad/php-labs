<?php

    require 'configs/dbconf.php';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    } 

    $conn->set_charset('utf8');

    $username = $conn->real_escape_string($_POST['username']);

    $sql = 'SELECT * FROM ' . $dbname . ' .users WHERE username = "' . $username . '";';
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        if (password_verify($_POST['pass'], $row['password']))
        {
            $_SESSION['id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['is_admin'] = $row['admin'];
            header("Location: /index.php?action=main");
            exit();
        }
    }

    header('Location: /index.php?action=login&error=1');


?>