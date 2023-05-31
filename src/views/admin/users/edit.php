<?php
require_once("../../../../config/database.php");

$formErrors["username"] = $formErrors["password"] = $formErrors["passwordVerify"] = "";

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    if (empty($username)) {
        $formErrors["username"] = "Please enter a username.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $formErrors["username"] = "Username can only contain letters, numbers, and underscores.";
    } else {
        $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
        $query = $db->prepare($sql);

        if ($query->rowCount() == 1) {
            $formErrors["username"] = 'Šāds lietotājvārds jau pastāv!';
        }
    }

    $password = trim($_POST['password']);
    if (!empty($password) && strlen($password) < 6) {
        $formErrors["password"] = "Password must have atleast 6 characters.";
    }

    $passwordVerify = trim($_POST['passwordVerify']);
    if (!empty($password)) {
        if (empty($passwordVerify)) {
            $formErrors["passwordVerify"] = "Please confirm password.";
        } else {
            if (empty($formErrors["password"]) && ($password !== $passwordVerify)) {
                $formErrors["passwordVerify"] = "Password did not match.";
            }
        }
    }

    if (empty(array_filter($formErrors))) {
        $id = $_POST['id'];
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = $db->prepare("UPDATE users SET username = '$username', password = '$hashedPassword' WHERE id = '$id'");
        } else {
            $query = $db->prepare("UPDATE users SET username = '$username' WHERE id = '$id'");
        }
        $query->execute();

        session_start();
        $_SESSION['flashMessage'] = ['message' => 'Lietotājs labots!', 'type' => 'success'];

        header("location: list.php");
        exit;
    }
}

$id = $_GET['id'];
$query = $db->prepare("SELECT username FROM users WHERE id = '$id'");
$query->execute();
if ($query->rowCount() == 0) {
    header("location: list.php");
    exit;
} else {
    $user = $query->fetch();
}
?>

<?php require_once("../../layout/admin-sidebar.php"); ?>

<div class="card">
    <div class="card-header">
        <h2 class="m-0">Rediģēt lietotāju</h2>
    </div>
    <form method="post">
        <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
        <div class="card-body">
            <div class="form-group mb-3">
                <label for="username">Lietotājvārds <span class="text-danger">*</span></label>
                <input type="text" class="form-control <?php echo (! empty($formErrors["username"])) ? 'is-invalid' : ''; ?>" value="<?= $user['username'] ?>" name="username" id="username" placeholder="Ievadi lietotājvārdu">
                <span class="invalid-feedback"><?php echo $formErrors["username"] ?></span>
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