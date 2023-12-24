<?php
require_once 'DB.php';

$dsf = new DB();
$sql = "SELECT * FROM notes";
$result = $dsf->select($sql);

echo json_encode($result);
?>