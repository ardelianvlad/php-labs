function onClick(id) {
    var txt;
    var r = confirm("Ви точно хочете видалити цей товар?");
    if (r == true) {
        document.location.href = '/index.php?action=delete_book&id=' + id;
    }
}
