<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../../../public/css/admin.css">
    <link rel="icon" type="image/x-icon" href="/pakagaladarbs/public/img/favicon.ico">
    <title>SIA "PAKA"</title>
</head>



<body>
    <div class="d-flex">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white  vh-100 sticky-top" style="width: 280px; background-color: #EF820D;">
            <a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4">SIA "PAKA"</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li>
                    <a href="../../admin/services/list.php" class="nav-link <?= str_contains($currentPage, 'admin/services') ? "active" : 'text-white' ?>">
                        <i class="fa fa-wrench"></i>
                        Pakalpojumi
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../../admin/users/list.php" class="nav-link <?= str_contains($currentPage, 'admin/users') ? "active" : 'text-white' ?>">
                        <i class="fa fa-user"></i>
                        Lietotāji
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../../admin/employees/list.php" class="nav-link <?= str_contains($currentPage, 'admin/employees') ? "active" : 'text-white' ?>">
                        <i class="fa fa-users"></i>
                        Darbinieki
                    </a>
                </li>
                <li>
                    <a href="../../admin/positions/list.php" class="nav-link <?= str_contains($currentPage, 'admin/positions') ? "active" : 'text-white' ?>">
                        <i class="fa fa-id-card-o"></i>
                        Amati
                    </a>
                </li>
                <li>
                    <a href="../../admin/reviews/list.php" class="nav-link <?= str_contains($currentPage, 'admin/reviews') ? "active" : 'text-white' ?>">
                        <i class="fa fa-star"></i>
                        Atsauksmes
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <strong><?php echo "Administrācijas" ?></strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="../logout.php">Izrakstīties</a></li>
                </ul>
            </div>
        </div>
        <div class="container py-4">
            <?php require_once("../../../helpers/flashMessage.php"); ?>