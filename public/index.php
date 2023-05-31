<?php 
// Liek piespiedu kārtā izmantot attiecīgos failus
require_once("../src/views/layout/header.php"); 
require_once("../config/database.php");

//Vaicājums kas sagatavo datus no datu bāzes, tabulas service
$query = $db->prepare("SELECT * FROM services");
$query->execute();
$services = $query->fetchAll();


//SQL vaicājums, kas izvēlas datus no tabulas employes, kuru ID ir iesetots 1 rada majaslapa 0 nerada
$query = $db->prepare("
    SELECT e.id, e.name, e.surname, e.email, e.image, p.name as position_name
    FROM employees as e 
    LEFT JOIN positions as p ON e.position_id = p.id
    WHERE show_on_first_page = '1'
");

//Vaicājums tiek palaists
$query->execute();
$employees = $query->fetchAll();

//Vaicājums kas izvēlas datus no tabulas reviews
$query = $db->prepare("SELECT * FROM reviews");
$query->execute();
$reviews = $query->fetchAll();
?>


<section id="home">
    <div class="home-banner">
        <div class="container-fluid container h-100">
            <div class="row align-items-center h-100">
                <div class="col-12 col-lg-6">
                    <h1 class="mb-4">Labākais <span class="primary-color-tr">loģistikas</span> pakalpojumu sniedzējs</h1>
                    <a href="../src/views/public/contact-us.php" class="primary-button">Sazinies ar mums</a>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid container my-5 py-4">
    <section id="about-us">
        <div class="row">
            <div class="col-12 col-lg-5">
                <img src="img/about-us.jpg" class="img-square w-100">
            </div>
            <div class="col-12 col-lg-7">
                <div class="about-us__wrapper h-100 py-4 d-flex align-items-center">
                    <div>
                        <h1 class="small-primary mb-3">Par mums</h1>
                        <h2>Uzticams & ātrs loģistikas pakalpojumu sniedzējs</h2>
                        <p class="my-3">SIA "jaizdoma" ir pilna servisa loģistikas uzņēmums,
                            kas piedāvā dažādus starptautiskos un vietējos kravu pārvadājumus,
                            un visus ar tiem saistītos pakalpojumus. Kopš 2008. gada transporta
                            uzņēmums SIA "jaizdoma" ir nodrošinājis augstas kvalitātes pakalpojumus
                            vairāk kā 2500 uzņēmumiem un individuālajiem kravu sūtītājiem,
                            piedāvājot visu veidu kravu pārvadājuma pakalpojumus uz un no vairāk kā 120 pasaules valstīm</p>
                        <div class="row">
                            <div class="col-4">
                                <h2 class="primary-color-tr">135</h2>
                                <b>Kvalificēti profesionāļi</b>
                            </div>
                            <div class="col-4">
                                <h2 class="primary-color-tr">2500+</h2>
                                <b>Apmierināti klienti</b>
                            </div>
                            <div class="col-4">
                                <h2 class="primary-color-tr">1350+</h2>
                                <b>Realizēti projekti</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="services">
        <h1 class="text-center small-primary mt-5 pt-4 mb-4">Mūsu pakalpojumi</h1>
        <h2 class="text-center">Piedāvājam augstākās kvalitātes pakalpojumus</h2>
        <div class="row justify-content-center mt-4">
            <!-- Cikls, kas izvada visus datus no tabulas services !-->
            <?php foreach ($services as $service) : ?>
                <div class="col-12 col-md-6 col-lg-4 pb-4">
                    <div class="card-square position-relative">
                        <div class="card-txt position-absolute">
                            <h2 class="card-title"><?= $service['name'] ?></h2>
                            <p class="card-description"><?= $service['description'] ?></p>
                        </div>
                        <img src="img/uploads/services/<?= $service['image'] ?>">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <section id="employees" class="d-flex align-items-center flex-column">
        <h1 class="text-center small-primary mt-5 mb-4">Komanda</h1>
        <h2 class="text-center">Iepazīsties ar mūsu komandu</h2>
        <div class="row justify-content-center mt-4">
            <!-- Cikls, kas izvada visus datus no tabulas employess !-->
            <?php foreach ($employees as $employee) : ?>
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <div class="card-square position-relative">
                        <img src="img/uploads/employees/<?= $employee['image'] ?>">
                    </div>
                    <div class="d-flex flex-column align-items-center bg-light employee-info text-center">
                        <h5 class="employee-name mt-3 mb-0"><?= $employee['name'] ?> <?= $employee['surname'] ?></h5>
                        <p class="mt-3"><?= $employee['position_name'] ?></p>
                        <p><a href="mailto:<?= $employee['email'] ?>"><?= $employee['email'] ?></a></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <a href="../src/views/public/employees.php" class="secondary-button mt-4">Apskatīt visu komandu</a>
    </section>
    <section id="reviews">
        <h1 class="text-center small-primary mt-5 pt-4 mb-4">Atsauksmes</h1>
        <h2 class="text-center">Ko citi saka par mums</h2>
        <div id="reviewCarousel" class="carousel slide carousel-dark text-center" data-bs-ride="carousel">
            <div class="carousel-inner py-4">
                <!-- Cikls, kas izvada visus datus no tabulas reviews !-->
                <?php $reviewCount = count($reviews); ?>
                <?php foreach ($reviews as $key => $review) : ?>
                    <?php if ($key === 0) : ?>
                        <div class="carousel-item active" data-bs-interval="6000">
                            <div class="container">
                                <div class="row justify-content-center">
                    <?php endif; ?>
                    <div class="col-12 col-md-12 col-lg-4">
                        <img class="rounded-circle object-fit-cover mb-4"
                                    src="img/uploads/reviews/<?= $review['image'] ?>" alt="logo"
                                    style="width: 150px; height: 150px;" />
                        <h5 class="mb-3"><?= $review['title'] ?></h5>
                        <p class="text-muted">
                            <i class="fa fa-quote-left pe-2"></i>
                            <?= $review['text'] ?>
                        </p>
                    </div>
                    <?php if (($key + 1) % 3 === 0 || $reviewCount === $key + 1) : ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (($key + 1) % 3 === 0 && $reviewCount !== $key + 1) : ?>
                        <div class="carousel-item" data-bs-interval="6000">
                            <div class="container">
                                <div class="row justify-content-center">
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="d-flex justify-content-center mb-4">
                <button class="carousel-control-prev position-relative" type="button"
                        data-bs-target="#reviewCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next position-relative" type="button"
                        data-bs-target="#reviewCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>
</div>

<?php require_once("../src/views/layout/footer.php"); ?>

<script>
    const sections = document.querySelectorAll("section");
    const navLi = document.querySelectorAll(".navbar-nav .nav-link");
    window.onscroll = () => {
        var current = "";

        sections.forEach((section) => {
            const sectionTop = section.offsetTop;
            const screenCenter = window.innerHeight / 2;
            if (pageYOffset + screenCenter >= sectionTop) {
                current = section.getAttribute("id");
            }
        });

        navLi.forEach((li) => {
            li.classList.remove("active");
            if (li.classList.contains(current)) {
                li.classList.add("active");
            }
        });
    };
</script>