<?php
require_once("../../../../config/database.php");

$id = $_GET['id'];

$sql = "DELETE FROM services WHERE id='$id'";
$query = $db->prepare($sql);
$query->execute();

session_start();
$_SESSION['flashMessage'] = ['message' => 'Pakalpojums dzēsts!', 'type' => 'danger'];

header("location: list.php");
?>