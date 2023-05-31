<?php
require_once("../../../../config/database.php");

$query = $db->prepare("SELECT * FROM users");
$query->execute();
$users = $query->fetchAll();
?>

<?php require_once("../../layout/admin-sidebar.php"); ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="m-0">Lietotāji</h2>
        <a href="add.php" class="btn btn-sm btn-success">
            <i class="fa fa-plus"></i>
            Pievienot lietotāju
        </a>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover m-0">
            <thead>
                <tr>
                    <th>Lietotājvārds</th>
                    <th width="20%">Darbības</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['username'] ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $user['id'] ?>" class="btn btn-sm btn-primary">
                                <i class="fa fa-pencil"></i>
                                Rediģēt
                            </a>
                            <a href="delete.php?id=<?php echo $user['id'] ?>" onClick="return confirm('Vai tiešām vēlaties dzēst?')" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                                Dzēst
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        Skaits: <?php echo count($users) ?>
    </div>
</div>

<?php require_once("../../layout/admin-footer.php"); ?>