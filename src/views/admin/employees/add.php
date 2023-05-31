<?php
//Savienojas ar datubāzi.
require_once("../../../../config/database.php");

//Tiek definēti formas errori, kas tālāk tiek izmantoti formā (1.)
$formErrors["name"] = $formErrors["surname"] = $formErrors["position"] = "";
//Nodefinētas vērtības, kas tiek ievietotas formas sākumā, kā tukši lauki
$name = $surname = $email = $showOnFirstPage = "";

//isset forma, paņem datus no formas un savieno tos ar datubāzi
if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $email = trim($_POST['email']);
    $positionId = trim($_POST['position']);
    $showOnFirstPage = trim($_POST['showOnFirstPage']);
    //(2)
    if (empty($name)) {
        $formErrors['name'] = "Lūdzu ievadiet vārdu.";
    }

    if (empty($surname)) {
        $formErrors['surname'] = "Lūdzu ievadiet uzvārdu.";
    }

    if (empty($positionId)) {
        $formErrors['position'] = "Lūdzu izvēlieties amatu.";
    }
    //Tiek pielietots attēlu augšupieladētājs
    $customImageDir = dirname(__FILE__, 5) . "/public/img/uploads/employees/";
    require_once("../../../helpers/imageUpload.php");

    //SQL vaicājums, ievadītie dati no formas tiek ievietoti datubāzē
    if (empty(array_filter($formErrors))) { //Ja, kāds no laukiem tukšs, tiek izsaukts formErrors
        $query = $db->prepare("INSERT INTO employees (name, surname, email, position_id, image, show_on_first_page)
                           VALUES ('$name', '$surname', '$email', '$positionId', '$targetFileName', '$showOnFirstPage')");
        $query->execute();
    
    //Tiek izmantots $_SESSION globālais tags, kas izsauc iepriekš definēto 'flashMessage'.
        session_start();
        $_SESSION['flashMessage'] = ['message' => 'Darbinieks pievienots!', 'type' => 'success'];
        
        header("location: list.php");
        exit;
    }
}

$query = $db->prepare("SELECT * FROM positions");
$query->execute();
$positions = $query->fetchAll();
?>

<?php require_once("../../layout/admin-sidebar.php"); ?>

<div class="card">
    <div class="card-header">
        <h2 class="m-0">Pievienot darbinieku</h2>
    </div>
    <form method='post' enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group mb-3">
                <label for="name">Vārds <span class="text-danger">*</span></label> <!-- text-danger automātiski iedod sarkanu krāsu tekstam !-->
                <input type="text" class="form-control <?php echo (! empty($formErrors['name'])) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>" name="name" id="name" placeholder="Ievadi vārdu">
                <span class="invalid-feedback"><?php echo $formErrors['name'] ?></span>
                 <!-- Tiek izmantots iepriekš nodefinētais erorrs, savstarpēji strādā ar pārbaudi iekš (1)!-->
                 <!-- Attiecīgi tiek izvadīts error msg, no (2) kas iepriekš definēts !-->
            </div>
            <div class="form-group mb-3">
                <label for="surname">Uzvārds <span class="text-danger">*</span></label>
                <input type="text" class="form-control <?php echo (! empty($formErrors['surname'])) ? 'is-invalid' : ''; ?>" value="<?php echo $surname; ?>" name="surname" id="surname" placeholder="Ievadi uzvārdu">
                <span class="invalid-feedback"><?php echo $formErrors['surname'] ?></span>
            </div>
            <div class="form-group mb-3">
                <label for="email">E-pasts</label>
                <input type="email" class="form-control" value="<?php echo $email; ?>" name="email" id="email" placeholder="Ievadi e-pastu">
            </div>
            <div class="form-group mb-3">
                <label for="position">Amats <span class="text-danger">*</span></label>
                <select id="position" name="position" class="form-select <?php echo (! empty($formErrors['position'])) ? 'is-invalid' : ''; ?>">
                    <?php foreach($positions as $position): ?>
                        <option value="<?php echo $position['id'] ?>"><?php echo $position['name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <span class="invalid-feedback"><?php echo $formErrors['position'] ?></span>
            </div>
            <div class="form-group mb-3">
                <label for="showOnFirstPage">Rādīt sākumlapā</label>
                <select id="showOnFirstPage" name="showOnFirstPage" class="form-select">
                    <option <?php echo ! $showOnFirstPage ? 'selected' : '' ?> value="0">Nē</option>
                    <option <?php echo $showOnFirstPage ? 'selected' : '' ?> value="1">Jā</option>
                </select>
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