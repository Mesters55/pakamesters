<?php
require_once("../../../../config/database.php");
//Tiek definēti formas errori, kas tālāk tiek izmantoti formā (1.)
$formErrors["name"] = "";

//isset forma, paņem datus no formas un savieno tos ar datubāzi
if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $id = $_POST['id'];
    //Definētie formas erroriem tike iedotas tekstuālas vērtības (2.)
    if (empty($name)) {
        $formErrors['name'] = "Lūdzu ievadiet amatu.";
    }

    //Iepriekš sagatavotais vaicājums, tiek atjaunoti dati
    if (empty(array_filter($formErrors))) {
        $query = $db->prepare("UPDATE positions SET name = '$name' WHERE id = '$id'");
        $query->execute();

        //Tiek izmantots $_SESSION globālais tags, kas izsauc iepriekš definēto 'flashMessage'.
        session_start();
        $_SESSION['flashMessage'] = ['message' => 'Amats labots!', 'type' => 'success'];

        header("location: list.php");
        exit;
    }
}

//No nospiestās pogas list.php paņem id
$id = $_GET['id'];
$query = $db->prepare("SELECT * FROM positions WHERE id = $id");
$query->execute();
if ($query->rowCount() == 0) {
    header("location: list.php");
} else {
    $position = $query->fetch();
}
?>

<?php require_once("../../layout/admin-sidebar.php"); ?>

<div class="card">
    <div class="card-header">
        <h2 class="m-0">Rediģēt amatu</h2>
    </div>
    <form method="post">
        <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
        <div class="card-body">
            <div class="form-group mb-3">
                <label for="name">Amats <span class="text-danger">*</span></label>
                <input type="text" class="form-control <?php echo (! empty($formErrors['name'])) ? 'is-invalid' : ''; ?>" name="name" id="name" placeholder="Ievadi vārdu" value="<?php echo $position['name'] ?>">
                <span class="invalid-feedback"><?php echo $formErrors['name'] ?></span>
                <!-- Tiek izmantots iepriekš nodefinētais erorrs, savstarpēji strādā ar pārbaudi iekš (1)!-->
                <!-- Attiecīgi tiek izvadīts error msg, no (2) kas iepriekš definēts !-->
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" name="submit" class="btn btn-success">Saglabāt</button>
            <a href="list.php" type="button" class="btn btn-secondary">Atcelt</a>
        </div>
    </form>
</div>

<?php require_once("../../layout/admin-footer.php"); ?>