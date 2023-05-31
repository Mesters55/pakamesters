<?php
require_once("../../../../config/database.php");

$query = $db->prepare("SELECT * FROM services");
$query->execute();
$services = $query->fetchAll();
?>

<?php require_once("../../layout/admin-sidebar.php"); ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="m-0">Pakalpojumi</h2>
        <a href="add.php" class="btn btn-sm btn-success">
            <i class="fa fa-plus"></i>
            Pievienot pakalpojumu
        </a>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover m-0">
            <thead>
                <tr>
                    <th>Attēls</th>
                    <th>Pakalpojums</th>
                    <th width="20%">Darbības</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $service): ?>
                    <tr>
                        <td>
                            <?php if ($service['image'] != null): ?>
                                <img class="small-img" src="<?php echo '../../../../public/img/uploads/services/' . $service['image'] ?>" />
                            <?php endif; ?>
                        </td>
                        <td><?php echo $service['name'] ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $service['id'] ?>" class="btn btn-sm btn-primary">
                                <i class="fa fa-pencil"></i>
                                Rediģēt
                            </a>
                            <a href="delete.php?id=<?php echo $service['id'] ?>" onClick="return confirm('Vai tiešām vēlaties dzēst?')" class="btn btn-sm btn-danger">
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
        Skaits: <?php echo count($services) ?>
    </div>
</div>

<?php require_once("../../layout/admin-footer.php"); ?>