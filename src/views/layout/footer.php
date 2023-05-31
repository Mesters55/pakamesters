<div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
            <span class="mb-3 mb-md-0 text-muted">© <?= date('Y') ?> Paka</span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3"><a href="https://www.lvt.lv"><img class="footer-icon" src="/pakagaladarbs/public/img/instagram.svg"></a></li>
            <li class="ms-3"><a href="https://www.lvt.lv"><img class="footer-icon" src="/pakagaladarbs/public/img/facebook.svg"></a></li>
            <li class="ms-3"><a href="https://www.lvt.lv"><img class="footer-icon" src="/pakagaladarbs/public/img/linkedin.svg"></a></li>
        </ul>
  </footer>
</div>
</div>

<button onclick="topFunction()" class="primary-button" id="scrollToTop">Uz augšu</button>

<script>
    // Pogas parādīšanas skripts, pēc noteikta attāluma no mājaslapas augšas
    let scrollToTop = document.getElementById("scrollToTop");

    window.addEventListener('scroll', scrollFunction);

    function scrollFunction() {
        if (document.body.scrollTop > 1000 || document.documentElement.scrollTop > 1000) {
            scrollToTop.style.display = "block";
        } else {
            scrollToTop.style.display = "none";
        }
    }

    // Funkcija, lietotāju aizved uz mājaslapas augšu
    function topFunction() {
        document.documentElement.scrollTop = 0; 
    }
</script>

</body>
</html>