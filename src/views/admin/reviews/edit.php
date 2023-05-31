<?php
require_once("../../../../config/database.php");

$formErrors["title"] = $formErrors["text"] = "";

if (isset($_POST['submit'])) {
    $title = trim($_POST['title']);
    $text = trim($_POST['text']);
    $id = $_POST['id'];

    if (empty($title)) {
        $formErrors['title'] = "Lūdzu ievadiet atsauksmes virsrakstu.";
    }

    if (empty($text)) {
        $formErrors['text'] = "Lūdzu ievadiet atsauksmes tekstu.";
    }

    $customImageDir = dirname(__FILE__, 5) . "/public/img/uploads/reviews/";
    require_once("../../../helpers/imageUpload.php");

    if (empty(array_filter($formErrors))) {
        if ($targetFileName) {
            $query = $db->prepare("UPDATE reviews SET title = '$title', text = '$text',
                            image = '$targetFileName' WHERE id = '$id'");
        } else {
            $query = $db->prepare("UPDATE reviews SET title = '$title', text = '$text' WHERE id = '$id'");
        }
        $query->execute();

        session_start();
        $_SESSION['flashMessage'] = ['message' => 'Atsauksme labota!', 'type' => 'success'];

        header("location: list.php");
        exit;
    }
}

if (!isset($_GET['id'])) {
    header("location: list.php");
    exit;
}

$id = $_GET['id'];
$query = $db->prepare("SELECT * FROM reviews WHERE id = '$id'");
$query->execute();
if ($query->rowCount() == 0) {
    header("location: list.php");
    exit;
} else {
    $review = $query->fetch();
}
?>

<?php require_once("../../layout/admin-sidebar.php"); ?>

<div class="card">
    <div class="card-header">
        <h2 class="m-0">Rediģēt atsauksmi</h2>
    </div>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
        <div class="card-body">
            <div class="form-group mb-3">
                <label for="title">Virsraksts <span class="text-danger">*</span></label>
                <input type="text" class="form-control <?php echo (! empty($formErrors['title'])) ? 'is-invalid' : ''; ?>" name="title" id="title" placeholder="Ievadi atsauksmes virsrakstu" value="<?php echo $review['title'] ?>">
                <span class="invalid-feedback"><?php echo $formErrors['title'] ?></span>
            </div>
            <div class="form-group mb-3">
                <label for="text">Teksts <span class="text-danger">*</span></label>
                <textarea class="form-control <?php echo (! empty($formErrors['text'])) ? 'is-invalid' : ''; ?>" name="text" id="text" placeholder="Ievadi atsauksmes tekstu"><?php echo $review['text'] ?></textarea>
                <span class="invalid-feedback"><?php echo $formErrors['text'] ?></span>
            </div>
            <div class="row">
                <div class="col-10">
                    <div class="form-group">
                        <label for="fileToUpload" class="form-label">Attēls</label>
                        <input class="form-control <?php echo (! empty($formErrors['img'])) ? 'is-invalid' : ''; ?>" type="file" id="fileToUpload" name="fileToUpload">
                        <span class="invalid-feedback"><?php echo $formErrors['img'] ?></span>
                    </div>
                </div>
                <div class="col-2 align-self-center">
                    <img class="small-img" src="<?php echo '../../../../public/img/uploads/reviews/' . $review['image'] ?>" />
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" name="submit" class="btn btn-success">Saglabāt</button>
            <a href="list.php" type="button" class="btn btn-secondary">Atcelt</a>
        </div>
    </form>
</div>

<?php require_once("../../layout/admin-footer.php"); ?>