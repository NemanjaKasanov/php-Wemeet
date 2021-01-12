<!-- slider_area_start -->
<div class="slider_area slider_bg_1">
    <div class="slider_text">
        <div class="container">
            <div class="position_relv">
                <h1 class="opcity_text d-none d-lg-block">Wemeet</h1>
                <div class="row">
                    <div class="col-xl-9">
                        <div class="title_text">
                            <h3>Wemeet<br>Social Platform
                            </h3>
                            <a href="#about_us" class="boxed-btn-white">About Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="countDOwn_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-4 col-md-6 col-lg-4">
                    <div class="single_date">
                        <i class="ti-location-pin"></i>
                        <span>All around the world</span>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-lg-3">
                    <div class="single_date">
                        <i class="ti-alarm-clock"></i>
                        <span>Anytime</span>
                    </div>
                </div>

                <div class="col-xl-5 col-md-12 col-lg-5">
                    <span id="clock"></span>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- slider_area_end -->

<!-- about_area_start -->
<div class="about_area" id="about_us">
    <div class="shape-1 d-none d-xl-block">
        <img src="assets/img/about/shap1.png" alt="">
    </div>
    <div class="shape-2 d-none d-xl-block">
        <img src="assets/img/about/shap2.png" alt="">
    </div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-md-6">
                <div class="about_thumb">
                    <img src="assets/img/about/about.png" alt="">
                </div>
            </div>
            <div class="col-xl-5 offset-xl-1 col-md-6">
                <div class="about_info">
                    <div class="section_title">
                        <span class="sub_heading">Welcome To</span>
                        <h3>Wemeet <br>
                            Newest social media app
                    </div>
                    <p>Our goal is to provide a patform where people can speak freely, express their opinions in many fields, meet friends, chat and much more...</p>
                    <a href="index.php?page=register" class="boxed-btn-red">Join Us</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- about_area_end -->

<!-- faq_area_Start -->
<div class="faq_area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="serction_title_large mb-95">
                    <h3>
                        Frequently Asked Questions
                    </h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div id="accordion">

                    <?php 
                    $query = "SELECT * FROM faq";
                    $faq = executeQuery($query);
                    foreach($faq as $el):
                    ?>

                    <div class="card">
                        <div class="card-header" id="heading<?= $el->id ?>">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#collapse<?= $el->id ?>" aria-expanded="false" aria-controls="collapse<?= $el->id ?>">
                                    <img src="assets/img/barnd/info.png" alt="question"> <?= $el->title ?>
                                </button>
                            </h5>
                        </div>
                        <div id="collapse<?= $el->id ?>" class="collapse" aria-labelledby="heading<?= $el->id ?>" data-parent="#accordion"
                            style="">
                            <div class="card-body">
                                <?= $el->content ?>
                            </div>
                        </div>
                    </div>

                    <?php
                    endforeach;
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- faq_area_end -->
