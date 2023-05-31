<?php
require_once("../../../../config/database.php");

$formErrors["name"] = $formErrors["description"] = "";

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $id = $_POST['id'];

    if (empty($name)) {
        $formErrors['name'] = "Lūdzu ievadiet vārdu.";
    }

    if (empty($description)) {
        $formErrors['description'] = "Lūdzu ievadiet pakalpojuma aprakstu.";
    }

    $customImageDir = dirname(__FILE__, 5) . "/public/img/uploads/services/";
    require_once("../../../helpers/imageUpload.php");

    if (empty(array_filter($formErrors))) {
        if ($targetFileName) {
            $query = $db->prepare("UPDATE services SET name = '$name', description = '$description',
                            image = '$targetFileName' WHERE id = '$id'");
        } else {
            $query = $db->prepare("UPDATE services SET name = '$name', description = '$description' WHERE id = '$id'");
        }
        $query->execute();

        session_start();
        $_SESSION['flashMessage'] = ['message' => 'Pakalpojums labots!', 'type' => 'success'];

        header("location: list.php");
        exit;
    }
}

if (!isset($_GET['id'])) {
    header("location: list.php");
    exit;
}

$id = $_GET['id'];
$query = $db->prepare("SELECT * FROM services WHERE id = '$id'");
$query->execute();
if ($query->rowCount() == 0) {
    header("location: list.php");
    exit;
} else {
    $service = $query->fetch();
}
?>

<?php require_once("../../layout/admin-sidebar.php"); ?>

<div class="card">
    <div class="card-header">
        <h2 class="m-0">Rediģēt pakalpojumu</h2>
    </div>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
        <div class="card-body">
            <div class="form-group mb-3">
                <label for="name">Pakalpojums <span class="text-danger">*</span></label>
                <input type="text" class="form-control <?php echo (! empty($formErrors['name'])) ? 'is-invalid' : ''; ?>" name="name" id="name" placeholder="Ievadi pakalpojumu" value="<?php echo $service['name'] ?>">
                <span class="invalid-feedback"><?php echo $formErrors['name'] ?></span>
            </div>
            <div class="form-group mb-3">
                <label for="description">Apraksts <span class="text-danger">*</span></label>
                <textarea class="form-control <?php echo (! empty($formErrors['description'])) ? 'is-invalid' : ''; ?>" name="description" id="description" placeholder="Ievadi pakalpojuma aprakstu"><?php echo $service['description'] ?></textarea>
                <span class="invalid-feedback"><?php echo $formErrors['description'] ?></span>
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
                    <img class="small-img" src="<?php echo '../../../../public/img/uploads/services/' . $service['image'] ?>" />
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