<?php
require_once("../../../../config/database.php");

//No nospiestās pogas list.php paņem id
$id = $_GET['id'];

//Dzēš ierakstu
$sql = "DELETE FROM positions WHERE id='$id'";
$query = $db->prepare($sql);
$query->execute();

//Izmantojot globālo tagu $_SESSION parādam msg, ka darbinieks dzēst, taču pirms tā vajag sākt sessiju, lai varam izmantot.
session_start();
$_SESSION['flashMessage'] = ['message' => 'Amats dzēsts!', 'type' => 'danger'];

header("location: list.php");
?>