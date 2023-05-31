<?php
require_once("../../../../config/database.php");

$query = $db->prepare("SELECT * FROM reviews");
$query->execute();
$reviews = $query->fetchAll();
?>

<?php require_once("../../layout/admin-sidebar.php"); ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="m-0">Atsauksmes</h2>
        <a href="add.php" class="btn btn-sm btn-success">
            <i class="fa fa-plus"></i>
            Pievienot atsauksmi
        </a>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover m-0">
            <thead>
                <tr>
                    <th>Attēls</th>
                    <th>Virsraksts</th>
                    <th>Teksts</th>
                    <th width="20%">Darbības</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reviews as $review): ?>
                    <tr>
                        <td>
                            <?php if ($review['image'] != null): ?>
                                <img class="small-img" src="<?php echo '../../../../public/img/uploads/reviews/' . $review['image'] ?>" />
                            <?php endif; ?>
                        </td>
                        <td><?php echo $review['title'] ?></td>
                        <td><?php echo $review['text'] ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $review['id'] ?>" class="btn btn-sm btn-primary">
                                <i class="fa fa-pencil"></i>
                                Rediģēt
                            </a>
                            <a href="delete.php?id=<?php echo $review['id'] ?>" onClick="return confirm('Vai tiešām vēlaties dzēst?')" class="btn btn-sm btn-danger">
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
        Skaits: <?php echo count($reviews) ?>
    </div>
</div>

<?php require_once("../../layout/admin-footer.php"); ?>