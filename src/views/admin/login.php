<?php
session_start();

if (isset($_SESSION["user"])) {
    header("location: users/list.php");
    exit;
}

require_once("../../../config/database.php");

//Nodefinētas vērtības, kas tiek ievietotas formas sākumā, kā tukši lauki
$username = "";
$usernameError = $passwordError = $loginError = "";

//isset forma, paņem datus no formas un savieno tos ar datubāzi
if (isset($_POST['submit'])) {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    //(2)
    if (empty($username)) {
        $usernameError = "Lūdzu ievadiet savu lietotājvārdu.";
    }

    if (empty($password)) {
        $passwordError = "Lūdzu ievadiet savu paroli.";
    }

    if (empty($usernameError) && empty($passwordError)) {
        $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
        $query = $db->prepare($sql);
        $query->execute();
        //Ar cikla palīdzību pārbauda vai lietotājavārds ir datubāzē
        // Pārbauda lietotāja paroli
        if ($query->rowCount() == 1) {
            $user = $query->fetch();
            $id = $user["id"];
            $username = $user["username"];
            $hashed_password = $user["password"];
            if (password_verify($password, $hashed_password)) {
                // Tiek saglabāts sessijas lietotājavārds
                $_SESSION["user"] = $user;
                header("location: users/list.php");
            } else {
                $loginError = "Nederīgs lietotājvārds vai parole.";
            }
        } else {
            $loginError = "Nederīgs lietotājvārds vai parole.";
        }
        unset($query);
    }
    unset($db);
}
?>

<?php require_once("../layout/header.php"); ?>
<div class="container login-container">
    <div class="card">
        <div class="card-body">
            <h2>Pieslēgšanās</h2>
            <p class="text-muted">Lūdzu, aizpildiet savus sistēmas lietotāja datus, lai pieslēgtos.</p>
            <?php
            if (!empty($loginError)) {
                echo '<div class="alert alert-danger">' . $loginError . '</div>';
            }
            ?>

            <form method="post">
                <div class="form-group mb-3">
                    <label>Lietotājvārds <span class="text-danger">*</span></label>
                    <input type="text" name="username" class="form-control <?php echo (!empty($usernameError)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $usernameError; ?></span>
                 <!-- Tiek izmantots iepriekš nodefinētais erorrs, savstarpēji strādā ar pārbaudi iekš (1)!-->
                 <!-- Attiecīgi tiek izvadīts error msg, no (2) kas iepriekš definēts !-->
                </div>
                <div class="form-group mb-3">
                    <label>Parole <span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control <?php echo (!empty($passwordError)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $passwordError; ?></span>
                </div>
                <div class="form-group">
                    <button class="primary-button" type="submit" name="submit" class="btn btn-primary">Pieslēgties</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once("../layout/footer.php"); ?>