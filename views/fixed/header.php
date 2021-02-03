<div class="slider_area slider_bg_1">
    <div class="slider_text">
        <div class="container">
            <div class="position_relv">
                <div class="row">
                    <div class="col-xl-8">
                        <div class="title_text title_text2 ">
                            <?php
                            include_once 'models/functions.php';
                            $page = $_GET['page'];

                            if($page == 'register') echo '<h3>Register here:</h3>';
                            else if($page == 'login') echo '<h3>Log In:</h3>';
                            else if($page == 'post') echo '<h3>Post a Discussion:</h3>';
                            else if($page == 'discussion'){
                                if(isset($_GET['id'])){
                                    $discussion_id = $_GET['id'];
                                    $discussion = executeQuery("SELECT * FROM discussion WHERE id=$discussion_id");
                                    if($discussion){
                                        $discussion = $discussion[0]->name;
                                        echo '<p class="h1 text-white">'.$discussion.'</p>';
                                    }
                                    else{
                                        echo '<h3>No Such Discussion, Wrong Id</h3>';
                                    }
                                }
                                else{
                                    echo '<h3>No Such Discussion, Wrong Id</h3>';
                                }
                            }
                            else if($page == 'account' && isset($_SESSION['userId'])){
                                $user_data = getUserData($_SESSION['userId'])[0];
                                $user_name = $user_data->name.' '.$user_data->last_name;
                                echo '<h3>'.$user_name.'</h3>';
                            }
                            else if($page == 'user'){
                                $user_data = getUserData($_GET['id'])[0];
                                $user_name = $user_data->name.' '.$user_data->last_name;
                                echo '<h3>'.$user_name.'</h3>';
                            }
                            else if($page == 'category' && isset($_GET['id'])){
                                if(isset($_GET['id'])){
                                    $ctg_id = $_GET['id'];
                                    $ctg = executeQuery("SELECT * FROM category WHERE id=$ctg_id");
                                    if($ctg){
                                        $ctg = $ctg[0]->name;
                                        echo '<h3 class="h1 text-white">'.$ctg.'</h3>';
                                    }
                                    else{
                                        echo '<h3>No Such Category, Wrong Id</h3>';
                                    }
                                }
                                else{
                                    echo '<h3>No Such Category, Wrong Id</h3>';
                                }
                            }


                            else if($page == 'aboutAuthor') echo '<h3>About Author.</h3>';
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
                        <?php
                        if($page == 'account' && isset($_SESSION['userId'])){
                            $user_id = $user_data->id;
                            $user_country = getUserCountry($user_id);
                            $user_city = $user_data->city;

                            echo '<span>'.$user_city.', '.$user_country.'</span>';
                        }
                        else{
                            echo '<span>All Around the World</span>';
                        }
                        ?>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-lg-3">
                    <div class="single_date">
                        <i class="ti-alarm-clock"></i>
                        <span><?= date('d.m.Y') ?></span>
                    </div>
                </div>
                <div class="col-xl-5 col-md-12 col-lg-5">
                    <span id="clock"></span>
                </div>
            </div>
        </div>
    </div>
</div>