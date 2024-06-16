<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}

$data = [
    'pageTitle' => 'Liên Hệ'
];
layouts('headersp', $data);
?>


<div style="margin-top: 150px; margin-bottom:150px;" class="container">
    <div class="row">
        <div class="offset-lg-2 col-lg-8 col-12">
            <div class="title-contact">
                <h1>Liên hệ chúng tôi</h1>
            </div>
            <div class="list-contact">
                <div class="row">
                    <div class="col-lg-3 col-12">
                        <div class="single-contact">
                            <div class="icon-contact">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div class="summary-contact">
                                Tầng 1-Toàn AAA- 111 Hà Nội
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="single-contact">

                            <div class="icon-contact">
                                <i class="fa-solid fa-phone-volume"></i>
                            </div>
                            <div class="summary-contact">
                                036327XXXX
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="single-contact">

                            <div class="icon-contact">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div class="summary-contact">
                                <a title="quachduy1762003@gmail.com"
                                    href="mailto:quachduy1762003@gmail.com">quachduy1762003@....</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="single-contact">

                            <div class="icon-contact">
                                <i class="fa-brands fa-facebook-messenger"></i>
                            </div>
                            <div class="summary-contact">
                                <a href="">Messenger</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



<?php
// Include footer file
layouts('footersp');
?>