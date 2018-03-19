<?php
$errors = '';
$pattern = '/[A-Za-zА-Яа-яЇїІіЄє0-9-\.\,-_]+/u';

if (!preg_match('/[\d-]{17}/', $_POST['isbn']))
{
    $errors .= 'isbn@';
}
if(!preg_match('/\d{4}/', $_POST['year']))
{
    $errors .= 'year@';
}
if(!preg_match('/\d{1,4}/', $_POST['count_of_pages']))
{
    $errors .= 'pages@';
}
if(!preg_match('/\d+[\.\,]*\d*/', $_POST['price']))
{
    $errors .= 'price@'; 
}
if(!preg_match($pattern, $_POST['name']))
{
    $errors .= 'name@';
}
if(!preg_match($pattern, $_POST['author']))
{
    $errors .= 'author@';
}
if(!preg_match($pattern, $_POST['genre']))
{
    $errors .= 'genre@';
}
if(!preg_match($pattern, $_POST['publishing_house']))
{
    $errors .= 'publ@';
}

if ($_FILES['cover']['name'] != '')
{
    try {
        if (
            !isset($_FILES['cover']['error']) ||
            is_array($_FILES['cover']['error'])
        ) {
            throw new RuntimeException('Invalid parameters.');
        }

        switch ($_FILES['cover']['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                throw new RuntimeException('Exceeded filesize limit.');
            default:
                throw new RuntimeException('Unknown errors.');
        }

        if ($_FILES['cover']['size'] > 2000000) {
            throw new RuntimeException('Exceeded filesize limit.');
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        if (false === $ext = array_search(
            $finfo->file($_FILES['cover']['tmp_name']),
            array(
                'jpg' => 'image/jpeg',
                'png' => 'image/png',
                'gif' => 'image/gif',
            ),
            true
        )) {
            throw new RuntimeException('Invalid file format.');
        }

        $uploadfile = sprintf('./uploads/%s.%s',
            sha1_file($_FILES['cover']['tmp_name']),
            $ext
        );

        if (!move_uploaded_file(
            $_FILES['cover']['tmp_name'],
            $uploadfile
        )) {
            throw new RuntimeException('Failed to move uploaded file.');
        }

        echo 'File is uploaded successfully.';

    } catch (RuntimeException $e) {
        $errors .= 'cover@';
        // die($e->getMessage());
    }
}

if ($errors !== '')
{
    header('Location: /index.php?action=add_book&errors=' . $errors);
    exit();
}

?>
