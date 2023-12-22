<?php 
    session_start();
    require_once 'DB.php';
    $dsf = new DB();
    $noteId = $_POST['noteId'];

    $sql = "DELETE FROM notes WHERE id = :noteId";

    if ($dsf->delete('notes', $noteId)) {
        echo "Note deleted successfully";
    } else {
        echo "Error deleting note";
    }
?>