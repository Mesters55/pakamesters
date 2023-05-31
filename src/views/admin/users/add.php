<?php
require_once("../../../../config/database.php");

//Tiek definēti formas errori, kas tālāk tiek izmantoti formā (1.)
$formErrors["username"] = $formErrors["password"] = $formErrors["passwordVerify"] = "";
//Nodefinētas vērtības, kas tiek ievietotas formas sākumā, kā tukši lauki
$username = "";

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    if (empty($username)) { //Ja lietotāja vārds tukšs
        $formErrors["username"] = "Lūdzu ievadi lietotājvārdu.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) { //Ja tiek izmantoti simboli lietotājvārdā, pārbaude notiek ar php iebūvēto preg_match
        $formErrors["username"] = "Lietotājavārds var saturēt tikai burtus, ciparus un apakšsvītras";
    } else { //Pārbauda vai jau datubāzē nav lietotājs ar ievadīto lietotājvārdu
        $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
        $query = $db->prepare($sql);

        if ($query->rowCount() == 1) {
            $formErrors["username"] = 'Šāds lietotājvārds jau pastāv!';
        }
    }

    $password = trim($_POST['password']);
    if (empty($password)) { //Pārbauda vai parole nav tukša.
        $formErrors["password"] = "Lūdzu ievadiet paroli.";
    } elseif (strlen($password) < 6) { //Pārbauda paroles garumu.
        $formErrors["password"] = "Parolei ir jābūt garākai par 6 simboliem.";
    }

    $passwordVerify = trim($_POST['passwordVerify']);
    if (empty($passwordVerify)) { //Pārbauda vai atkārtoti tiek ievadīta parole.
        $formErrors["passwordVerify"] = "Lūdzu ievadiet paroli atkārtoti.";
    } else { //Pārbauda vai abas ievadītās paroles ir vienādas.
        if (empty($formErrors["password"]) && ($password !== $passwordVerify)) {
            $formErrors["passwordVerify"] = "Paroles nav vienādās.}";
        }
    }

    if (empty(array_filter($formErrors))) { //Ja kāds no laukeim tukšs, izsauc erroru
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); //Izfiltrē paroli
        $query = $db->prepare("INSERT INTO users (username, password) 
                            VALUES ('$username', '$hashedPassword')"); // SQL vaicājums, dati tiek ievadītu datubāzē
        $query->execute();

        //Tiek izmantots $_SESSION globālais tags, kas izsauc iepriekš definēto 'flashMessage'.
        session_start();
        $_SESSION['flashMessage'] = ['message' => 'Lietotājs pievienots!', 'type' => 'success'];

        header("location: list.php");
        exit;
    }
}
?>

<?php require_once("../../layout/admin-sidebar.php"); ?>

<div class="card">
    <div class="card-header">
        <h2 class="m-0">Pievienot lietotāju</h2>
    </div>
    <form method='post'>
        <div class="card-body">
            <div class="form-group mb-3">
                <label for="username">Lietotājvārds <span class="text-danger">*</span></label>
                <input type="text" class="form-control <?php echo (! empty($formErrors["username"])) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" name="username" id="username" placeholder="Ievadi lietotājvārdu">
                <span class="invalid-feedback"><?php echo $formErrors["username"] ?></span>
                 <!-- Tiek izmantots iepriekš nodefinētais erorrs, savstarpēji strādā ar pārbaudi iekš (1)!-->
                 <!-- Attiecīgi tiek izvadīts error msg, no (2) kas iepriekš definēts !-->
            </div>
            <div class="form-group mb-3">
                <label for="password">Parole <span class="text-danger">*</span></label>
                <input type="password" class="form-control <?php echo (! empty($formErrors["password"])) ? 'is-invalid' : ''; ?>" name="password" id="password" placeholder="Ievadi paroli">
                <span class="invalid-feedback"><?php echo $formErrors["password"] ?></span>
            </div>
            <div class="form-group">
                <label for="passwordVerify">Apstiprini paroli <span class="text-danger">*</span></label>
                <input type="password" class="form-control <?php echo (! empty($formErrors["passwordVerify"])) ? 'is-invalid' : ''; ?>" name="passwordVerify" id="passwordVerify" placeholder="Ievadi paroli atkārtoti">
                <span class="invalid-feedback"><?php echo $formErrors["passwordVerify"] ?></span>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" name="submit" class="btn btn-success">Saglabāt</button>
            <a href="list.php" type="button" class="btn btn-secondary">Atcelt</a>
        </div>
    </form>
</div>

<?php require_once("../../layout/admin-footer.php"); ?>