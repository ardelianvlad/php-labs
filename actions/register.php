<?php

$errors = '';

if(!preg_match('/^[\da-zA-Z-_]{4,}$/', $_POST['username']))
{
    $errors .= 'username@';
}
if(!preg_match('/^[\da-zA-Z-_]{7,}$/', $_POST['pass']) ||
   !preg_match('/[0-9]/', $_POST['pass']) ||
   !preg_match('/[A-Z]/', $_POST['pass']))
{
    $errors .= 'pass@';
}
if($_POST['pass'] !== $_POST['pass2'])
{
    $errors .= 'pass2@';
}
if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
{
    $errors .= 'email@';
}
if($_POST['region'] <= 0 || $_POST['region'] > 27)
{
    $errors .= 'region';
}

$location = 'Location: /index.php?action=registration';
if ($errors != '') {
    $location .= '&errors=' . $errors;
    header($location);
}
else
{
    require 'configs/dbconf.php';
    require 'scripts/password_crypt.php';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $conn->set_charset('utf8');

    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['pass']);
    $email = $conn->real_escape_string($_POST['email']);
    $region = $conn->real_escape_string($_POST['region']);

    $sql = 'INSERT INTO ' . $dbname . ' .users(username, password, email, region) VALUES'
        . sprintf('("%s", "%s", "%s", "%d");', $username, hashPassword($password), $email, $region);

    if (!$conn->query($sql)) {
        die("Error: " . $sql . "<br>" . $conn->error);
    }

    header('Location: /index.php?action=success');

}

?>