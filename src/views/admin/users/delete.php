<?php
require_once("../../../../config/database.php");

$id = $_GET['id'];

$sql = "DELETE FROM users WHERE id='$id'";
$query = $db->prepare($sql);
$query->execute();

session_start();
$_SESSION['flashMessage'] = ['message' => 'Lietotājs dzēsts!', 'type' => 'danger'];

header("location: list.php");
?>