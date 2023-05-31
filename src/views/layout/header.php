<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/pakagaladarbs/public/css/public.css">
    <link rel="icon" type="image/x-icon" href="/pakagaladarbs/public/img/favicon.ico">
    <title>Paka</title>
</head>

<?php $currentPage = $_SERVER['PHP_SELF']; ?>
<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid container">
            <a class="navbar-brand p-0" href="<?= str_contains($currentPage, 'public/index') ? "#home" : '/pakagaladarbs/public/index.php' ?>"><img src="/pakagaladarbs/public/img/logo.png"></a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <img src="/pakagaladarbs/public/img/open-navbar.png" class="open-navbar">
                <img src="/pakagaladarbs/public/img/close-navbar.png" class="close-navbar">
            </button>
            <div class="collapse navbar-collapse mt-2 mt-lg-0" id="navbarCollapse">
                <div class="navbar-nav">
                    <a class="nav-link home <?= str_contains($currentPage, 'public/index') ? "active" : '' ?>" href="<?= str_contains($currentPage, 'public/index') ? "#home" : '/pakagaladarbs/public/index.php' ?>">Sākums</a>
                    <a class="nav-link about-us" href="<?= str_contains($currentPage, 'public/index') ? "#about-us" : '/pakagaladarbs/public/index.php#about-us' ?>">Par mums</a>
                    <a class="nav-link services" href="<?= str_contains($currentPage, 'public/index') ? "#services" : '/pakagaladarbs/public/index.php#services' ?>">Pakalpojumi</a>
                    <a class="nav-link employees <?= str_contains($currentPage, 'public/employees') ? "active" : '' ?>" href="<?= str_contains($currentPage, 'public/index') ? "#employees" : '/pakagaladarbs/public/index.php#employees' ?>">Komanda</a>
                    <a class="nav-link reviews" href="<?= str_contains($currentPage, 'public/index') ? "#reviews" : '/pakagaladarbs/public/index.php#reviews' ?>">Atsauksmes</a>
                    <a class="nav-link <?= str_contains($currentPage, 'public/contact-us') ? "active" : '' ?>" href="/pakagaladarbs/src/views/public/contact-us.php">Kontakti</a>
                    <!-- Sesijas sākums, respektivi ja ielogojas tad navigācijas joslā parādas atsevišķi vēl viena sadaļa "Admin" !-->
                    <?php 
                    if (! isset($_SESSION)) {
                        session_start();
                    } ?>
                    <?php if (isset($_SESSION['user'])): ?>
                        <a class="nav-link" href="/pakagaladarbs/src/views/admin/users/list.php">Admin</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    <div class="content-wrapper">