<?php
require_once("../../../../config/database.php");

$formErrors["title"] = $formErrors["text"] = "";
$title = $text = "";

if (isset($_POST['submit'])) {
    $title = trim($_POST['title']);
    $text = trim($_POST['text']);

    if (empty($title)) {
        $formErrors['title'] = "Lūdzu ievadiet atsauksmes virsrakstu.";
    }

    if (empty($text)) {
        $formErrors['text'] = "Lūdzu ievadiet atsauksmes tekstu.";
    }

    $customImageDir = dirname(__FILE__, 5) . "/public/img/uploads/reviews/";
    require_once("../../../helpers/imageUpload.php");

    if (empty(array_filter($formErrors))) {
        $query = $db->prepare("INSERT INTO reviews (title, text, image)
                           VALUES ('$title', '$text', '$targetFileName')");
        $query->execute();

        session_start();
        $_SESSION['flashMessage'] = ['message' => 'Atsauksme pievienota!', 'type' => 'success'];

        header("location: list.php");
        exit;
    }
}
?>

<?php require_once("../../layout/admin-sidebar.php"); ?>

<div class="card">
    <div class="card-header">
        <h2 class="m-0">Pievienot atsauksmi</h2>
    </div>
    <form method='post' enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group mb-3">
                <label for="title">Virsraksts <span class="text-danger">*</span></label>
                <input type="text" class="form-control <?php echo (! empty($formErrors['title'])) ? 'is-invalid' : ''; ?>" value="<?php echo $title; ?>" name="title" id="title" placeholder="Ievadi atsauksmes virsrakstu">
                <span class="invalid-feedback"><?php echo $formErrors['title'] ?></span>
            </div>
            <div class="form-group mb-3">
                <label for="text">Teksts <span class="text-danger">*</span></label>
                <textarea class="form-control <?php echo (! empty($formErrors['text'])) ? 'is-invalid' : ''; ?>" value="<?php echo $text; ?>" name="text" id="text" placeholder="Ievadi atsauksmes tekstu"></textarea>
                <span class="invalid-feedback"><?php echo $formErrors['text'] ?></span>
            </div>
            <div class="form-group">
                <label for="fileToUpload" class="form-label">Attēls</label>
                <input class="form-control <?php echo (! empty($formErrors['img'])) ? 'is-invalid' : ''; ?>" type="file" id="fileToUpload" name="fileToUpload">
                <span class="invalid-feedback"><?php echo $formErrors['img'] ?></span>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" name="submit" class="btn btn-success">Saglabāt</button>
            <a href="list.php" type="button" class="btn btn-secondary">Atcelt</a>
        </div>
    </form>
</div>

<?php require_once("../../layout/admin-footer.php"); ?>