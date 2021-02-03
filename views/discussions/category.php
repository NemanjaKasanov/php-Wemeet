<section class="blog_area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="blog_left_sidebar" id="discussions_display_box">

                    <!-- POSTS -->
                    <?php
                    include_once 'models/discussions/functions.php';
                    create_discussions("WHERE category=".$_GET['id']);
                    ?>

                </div>
            </div>

            <!-- SIDE BAR -->
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <!-- SEARCH -->
                    <?php
                    include 'views/discussions/search_section.php';
                    ?>
                    <!-- SEARCH END -->

                    <!-- CATEGORIES -->
                    <?php
                    include 'views/discussions/list_categories.php';
                    ?>
                    <!-- CATEGORIES END -->

                    <!-- TOP CATEGORIES -->
                    <?php
                    include 'views/discussions/top_categories.php';
                    ?>
                    <!-- TOP CATEGORIES END -->

                </div>
            </div>
            <!-- SIDE BAR END -->

        </div>
    </div>
</section>