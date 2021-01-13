<div class="col-12 d-flex justify-content-center mt-5 mb-5 pt-5 pb-5">
    <div class="col-lg-6 col-sm-12 mt-5 mb-5 ">
        <form id="register_form" action="models/logging/register.php" method="POST" class="col-12" name="registerForm" onsubmit="return registerFormCheck()">
            <div class="col-12 mb-5">
                <p class="h4 text-center">Fill in the form to register a new account. All fields are required.</p>
            </div>

            <div class="mt-10">
                <input type="text" name="name" id="name" placeholder="First Name" class="single-input"/>
                <p class="red text-center text-danger" id="_name">Invalid format, name must begin with a capital letter.</p>
            </div>

            <div class="mt-10">
                <input type="text" name="lname" id="lname" placeholder="Last Name" class="single-input"/>
                <p class="red text-center text-danger" id="_lname">Invalid format, last name must begin with a capital letter.</p>
            </div>

            <div class="mt-10">
                <input type="email" name="email" id="email" placeholder="Email address" class="single-input">
                <p class="red text-center text-danger" id="_email">Email address in an invalid format.</p>
            </div>
            
            <div class="mt-10">
                <input type="password" name="pass" id="pass" placeholder="Password" class="single-input"/>
                <p class="red text-center text-danger" id="_pass">Password must contain at least one cappital letter, lower case letter, number and a special symbol.</p>
            </div>
            
            <div class="mt-10">
                <input type="password" name="rpass" id="rpass" placeholder="Repeat Password" class="single-input"/>
                <p class="red text-center text-danger" id="_rpass">Passwords do not match.</p>
            </div>
            
            <div class="input-group-icon mt-10">
                <div class="icon"><i class="fa fa-globe" aria-hidden="true"></i></div>
                <div class="form-select" id="default-select">
                    <select name="country" id="country">
                        <option value="0">Country</option>
                        
                        <?php
                        $countries = executeQuery("SELECT * FROM country");
                        foreach($countries as $cnt): ?>

                            <option value="<?= $cnt->id ?>"><?= $cnt->name ?></option>

                        <?php endforeach; ?>

                    </select>
                </div>
                <p class="red text-center text-danger mb-3" id="_country">Country must be selected.</p>
            </div>
            
            <div class="mt-10">
                <input type="text" name="city" id="city" placeholder="City" class="single-input"/>
                <p class="red text-center text-danger" id="_city">Invalid format, city name must begin with a capital letter.</p>
            </div>

            <div class="col-12 text-center mt-5">
                <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Submit"/>
                <p class="red text-center text-danger" id="_form">All data entered into the form must be in a valid format.</p>
            </div>

        </form>
    </div>
</div>