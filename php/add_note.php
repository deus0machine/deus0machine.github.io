<?php 
    session_start();
    require_once 'DB.php';
    $dsf = new DB();
    $noteText = $_POST['noteText'];
    $author = $_POST['author'];
    $data = array(
        'head' => $author,
        'body' => $noteText
    );
    if ($dsf->insert('notes', $data)) {
        echo "Note added successfully";
    } else {
        echo "Error adding note";
    }
?>