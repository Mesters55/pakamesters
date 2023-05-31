<?php


//Globāli tiek nodefinēts errora msg, kas pēc tam var tikt izmantots jebkurā failā izmantojot $_SESSION
if (isset($_SESSION['flashMessage'])) {
    echo sprintf('
        <div class="alert alert-%s alert-dismissible fade show" role="alert">
            %s
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>',
        $_SESSION['flashMessage']['type'],
        $_SESSION['flashMessage']['message']
    );

    unset($_SESSION['flashMessage']);
}