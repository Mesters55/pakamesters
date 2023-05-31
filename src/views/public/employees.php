<?php
require_once('../layout/header.php'); 
require_once("../../../config/database.php");

//Sagatavots mysql vaicājums
$query = $db->prepare("
    SELECT e.id, e.name, e.surname, e.email, e.image, p.name as position_name
    FROM employees as e 
    LEFT JOIN positions as p ON e.position_id = p.id
");
$query->execute();
$employees = $query->fetchAll();
?>

<div class="container-fluid container pb-4">
    <div class="row">
        <h1 class="text-center my-5">Iepazīsties ar mūsu komandu</h1>
    </div>
    <div class="row justify-content-center mt-4 mb-5">
        <?php foreach ($employees as $employee) : ?>
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <div class="card-square position-relative">
                    <img src="../../../public/img/uploads/employees/<?= $employee['image'] ?>">
                </div>
                <div class="d-flex flex-column align-items-center bg-light employee-info">
                    <h5 class="employee-name mt-3 mb-0"><?= $employee['name'] ?> <?= $employee['surname'] ?></h5>
                    <p class="mt-3"><?= $employee['position_name'] ?></p>
                    <p><a href="mailto:<?= $employee['email'] ?>"><?= $employee['email'] ?></a></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once('../layout/footer.php'); ?>