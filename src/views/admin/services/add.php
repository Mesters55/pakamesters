<?php
require_once("../../../../config/database.php");

$formErrors["name"] = $formErrors["description"] = "";
$name = $description = "";

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);

    if (empty($name)) {
        $formErrors['name'] = "Lūdzu ievadiet pakalpojumu.";
    }

    if (empty($description)) {
        $formErrors['description'] = "Lūdzu ievadiet aprakstu.";
    }

    $customImageDir = dirname(__FILE__, 5) . "/public/img/uploads/services/";
    require_once("../../../helpers/imageUpload.php");

    if (empty(array_filter($formErrors))) {
        $query = $db->prepare("INSERT INTO services (name, description, image)
                           VALUES ('$name', '$description', '$targetFileName')");
        $query->execute();

        session_start();
        $_SESSION['flashMessage'] = ['message' => 'Pakalpojums pievienots!', 'type' => 'success'];

        header("location: list.php");
        exit;
    }
}
?>

<?php require_once("../../layout/admin-sidebar.php"); ?>

<div class="card">
    <div class="card-header">
        <h2 class="m-0">Pievienot pakalpojumu</h2>
    </div>
    <form method='post' enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group mb-3">
                <label for="name">Pakalpojums <span class="text-danger">*</span></label>
                <input type="text" class="form-control <?php echo (! empty($formErrors['name'])) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>" name="name" id="name" placeholder="Ievadi pakalpojumu">
                <span class="invalid-feedback"><?php echo $formErrors['name'] ?></span>
            </div>
            <div class="form-group mb-3">
                <label for="description">Apraksts <span class="text-danger">*</span></label>
                <textarea class="form-control <?php echo (! empty($formErrors['description'])) ? 'is-invalid' : ''; ?>" value="<?php echo $description; ?>" name="description" id="description" placeholder="Ievadi pakalpojuma aprakstu"></textarea>
                <span class="invalid-feedback"><?php echo $formErrors['description'] ?></span>
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