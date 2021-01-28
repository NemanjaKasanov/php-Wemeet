<div class="slider_area slider_bg_1">
    <div class="slider_text">
        <div class="container">
            <div class="position_relv">
                <div class="row">
                    <div class="col-xl-8">
                        <div class="title_text title_text2 ">
                            <?php

                            $page = $_GET['page'];

                            if($page == 'register') echo '<h3>Register here:</h3>';
                            else if($page == 'login') echo '<h3>Log In:</h3>';
                            else if($page == 'post') echo '<h3>Post a Discussion:</h3>';


                            else if($page == 'nologin') echo '<h3>You are not logged in or authorised to open this page.</h3>';
                            else echo '<h3>A page with this name does not exist.</h3>';
                            
                            ?>
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
                        <span>All Around the World</span>
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