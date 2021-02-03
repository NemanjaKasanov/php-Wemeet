<header>
    <div class="header-area ">
        <div id="sticky-header" class="main-header-area ">
            <div class="container-fluid p-0">
                <div class="row align-items-center justify-content-between no-gutters">
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo-img">
                            <a href="index.php">
                                <img src="assets/img/logo.png" alt="Wemeet social platform">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8">
                        <div class="main-menu  d-none d-lg-block">
                            <nav>
                                <ul id="navigation">
                                    <?php

                                    require 'models/nav/functions.php';
                                    
                                    if(isset($_SESSION['userId'])) $query = "SELECT * FROM nav_elements WHERE parent=0 AND (login_status=0 OR login_status=2) ORDER BY position ASC";
                                    else $query = "SELECT * FROM nav_elements WHERE parent=0 AND login_status=0 OR login_status=1 ORDER BY position ASC";

                                    $rows = executeQuery($query);

                                    foreach($rows as $row):
                                    echo '<li>';
                                    ?>

                                    <a href="<?= $row->href ?>"><?= $row->name ?>
                                    <?php if(check_for_children($row->id_nav)) echo '<i class="ti-angle-down"></i>'; ?>
                                    </a>

                                    <?php 
                                    if(check_for_children($row->id_nav)){
                                        echo '<ul class="submenu">';
                                        show_nav_elements($row->id_nav);
                                        echo '</ul>';
                                    }
                                    echo '</li>';
                                    endforeach;
                                    ?>

                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 d-none d-lg-block">
                        <div class="buy_ticket">
                            <a href="index.php?page=chat" class="boxed-btn-white">Chat</a>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>