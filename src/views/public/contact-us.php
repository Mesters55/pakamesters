<?php require_once('../layout/header.php'); ?>

<div class="container-fluid container pb-4">
    <div class="row">
        <h1 class="text-center my-5">Sazinies ar mums</h1>
    </div>
    <div class="row mb-5 mt-4">
        <div class="col-12 col-md-6">
            <div class="p-3">
                <h2 class="text-center small">Aizpildiet formu un mūsu komanda sazināsies ar jums 24 stundu laikā</h2>
                <form id="contact-form" class="d-flex flex-column">
                    <input class="mb-2" type="text" name="name" placeholder="Jūsu vārds">
                    <input class="mb-2" type="email" name="email" placeholder="Jūsu e-pasts">
                    <input class="mb-2" type="text" name="phone" placeholder="Jūsu telefona numurs">
                    <textarea name="message" placeholder="Jūsu ziņa"></textarea>
                    <button onclick="messageSendFunction()" class="mt-4 primary-button" type="button" >Sūtīt ziņu</button>
                    <p class="message-send" id="messageSendID">Ziņa nosūtīta!</p>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <iframe class="w-100 h-100 mt-4 mt-md-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d69596.37055387479!2d24.041132971764775!3d56.96787529925161!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46eecfb428d80b1f%3A0xd5cb3d7449809fc3!2zS3JpxaFqxIHFhmEgVmFsZGVtxIFyYSBpZWxhIDYyLCBDZW50cmEgcmFqb25zLCBSxKtnYSwgTFYtMTAxMw!5e0!3m2!1sen!2slv!4v1681830127913!5m2!1sen!2slv" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>
<script>
    // Pēc ziņas nosūtīšanas parādās texts
    let messageSend=document.getElementById("messageSendID");

    function messageSendFunction() {
        messageSend.style.display="block";
    }
</script>

<?php require_once('../layout/footer.php'); ?>