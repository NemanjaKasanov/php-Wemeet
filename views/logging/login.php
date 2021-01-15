<div class="col-12 d-flex justify-content-center mt-5 mb-5 pt-5 pb-5">
    <div class="col-lg-6 col-sm-12 mt-5 mb-5 ">
        <form id="register_form" action="models/logging/login.php" method="POST" class="col-12" name="registerForm" onsubmit="return loginFormCheck()">
            <div class="col-12 mb-5">
                <p class="h4 text-center">Fill in the form to Log In to your account.</p>
            </div>

            <div class="mt-10">
                <input type="email" name="email" id="email" placeholder="Email address" class="single-input">
                <p class="red text-center text-danger" id="_email">Email address in an invalid format.</p>
            </div>
            
            <div class="mt-10">
                <input type="password" name="pass" id="pass" placeholder="Password" class="single-input"/>
                <p class="red text-center text-danger" id="_pass">Password must contain at least one cappital letter, lower case letter and at least one number.</p>
            </div>

            <div class="col-12 text-center mt-5">
                <input type="submit" class="btn btn-primary" name="submit_login" id="submit" value="Submit"/>
                <p class="red text-center text-danger" id="_form">All data entered into the form must be in a valid format.</p>
            </div>

            <div class="col-12 mt-3">
                <?php 
                    if(isset($_SESSION['errors'])){
                        include 'models/logging/functions.php';
                        show_errors_array($_SESSION['errors']);
                        $_SESSION['errors'] = [];
                    }
                ?>
            </div>

        </form>
    </div>
</div>