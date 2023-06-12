<?php 

$config = require_once(dirname(__FILE__, 3) . '/config/config.php');

$targetFileName = null;
$formErrors["img"] = "";

if ($_FILES["fileToUpload"]["error"] === 0) {
    if (isset($customImageDir)) {
        $imageDir = $customImageDir;
    } else {
        $imageDir = $config["imageUpload"]["directory"];
    }
    $targetFileName = basename($_FILES["fileToUpload"]["name"]);
    $targetFileDir = $imageDir . $targetFileName;
    $allowedImgExtensions = $config["imageUpload"]["allowedExtensions"];
    $maxImgSize = $config["imageUpload"]["maxSize"];
    $imgFileType = strtolower(pathinfo($targetFileDir, PATHINFO_EXTENSION));

    // Pārbauda vai fails, kas tiek augšupielādēts ir attēls
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check === false) {
        $formErrors["img"] .= "Fails nav attēls. <br />";
    }

    if (file_exists($targetFileDir)) {
        $formErrors["img"] .= "Fails jau pastāv. <br />";
    }

    // Pārbauda attēla izmēru
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        $formErrors["img"] .= "Fails ir pārāk liels. <br />";
    }

    // Atļaujam tikai noteiktus attēlu paplašinājumus
    if (! in_array($imgFileType, $allowedImgExtensions)) {
        $allowedImgExtensionsStr = implode(", ", $allowedImgExtensions);
        $formErrors["img"] .= "Tikai " . $allowedImgExtensionsStr . " faili ir atļauti. <br />";
    }

    // Ja nav error, tad mēģinam saglabāt attēlu
    if (empty(array_filter($formErrors))) {
        if (! move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFileDir)) {
            $formErrors["img"] .= "Augšupielādējot failu, radās kļūda. <br />";
        }
    }
}
