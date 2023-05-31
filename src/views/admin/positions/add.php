<?php
//Savienojas ar datubāzi.
require_once("../../../../config/database.php");

//Tiek definēti formas errori, kas tālāk tiek izmantoti formā (1.)
$formErrors["name"] = "";
//Nodefinētas vērtības, kas tiek ievietotas formas sākumā, kā tukši lauki
$name = "";

//isset forma, paņem datus no formas un savieno tos ar datubāzi
if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    //(2)
    if (empty($name)) {
        $formErrors['name'] = "Lūdzu ievadiet amatu.";
    }
    //SQL vaicājums, ievadītie dati no formas tiek ievietoti datubāzē
    if (empty(array_filter($formErrors))) {
        $query = $db->prepare("INSERT INTO positions (name) VALUES ('$name')");
        $query->execute();

        //Tiek izmantots $_SESSION globālais tags, kas izsauc iepriekš definēto 'flashMessage'.
        session_start();
        $_SESSION['flashMessage'] = ['message' => 'Amats pievienots!', 'type' => 'success'];

        header("location: list.php");
        exit;
    }   
}
?>

<?php require_once("../../layout/admin-sidebar.php"); ?>

<div class="card">
    <div class="card-header">
        <h2 class="m-0">Pievienot amatu</h2>
    </div>
    <form method='post'>
        <div class="card-body">
            <div class="form-group">
                <label for="name">Amats <span class="text-danger">*</span></label>
                <input type="text" class="form-control <?php echo (! empty($formErrors['name'])) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>" name="name" id="name" placeholder="Ievadi vārdu">
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