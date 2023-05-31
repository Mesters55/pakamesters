<?php
require_once("../../../../config/database.php");

//Sagatavots mysql vaicājums, kas tiek izmantots pārējos failos iekš employees mapes.
//Definē vērtības.
$query = $db->prepare("
    SELECT e.id, e.name, e.surname, e.image, p.name as position_name
    FROM employees as e 
    LEFT JOIN positions as p ON e.position_id = p.id
");
$query->execute();
$employees = $query->fetchAll();
?>

<?php require_once("../../layout/admin-sidebar.php"); ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="m-0">Darbinieki</h2>
        <a href="add.php" class="btn btn-sm btn-success">
            <i class="fa fa-plus"></i>
            Pievienot darbinieku
        </a>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover m-0">
            <thead>
                <tr>
                    <th>Attēls</th>
                    <th>Vārds</th>
                    <th>Uzvārds</th>
                    <th>Amats</th>
                    <th width="20%">Darbības</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td>
                            <?php if ($employee['image'] != null): ?>
                                <img class="small-img" src="<?php echo '../../../../public/img/uploads/employees/' . $employee['image'] ?>" />
                            <?php endif; ?>
                        </td>
                        <td><?php echo $employee['name'] ?></td>
                        <td><?php echo $employee['surname'] ?></td>
                        <td><?php echo $employee['position_name']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $employee['id'] ?>" class="btn btn-sm btn-primary">
                                <i class="fa fa-pencil"></i>
                                Rediģēt
                            </a>
                            <a href="delete.php?id=<?php echo $employee['id'] ?>" onClick="return confirm('Vai tiešām vēlaties dzēst?')" class="btn btn-sm btn-danger">
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
        Skaits: <?php echo count($employees) ?>
    </div>
</div>

<?php require_once("../../layout/admin-footer.php"); ?>