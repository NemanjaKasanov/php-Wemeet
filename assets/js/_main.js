var switchArray = [false, false, false, false, false, false, false]

$(document).ready(function(){
    // Hide field alerts
    $('.red').hide();

    const regexNameLastName = /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/;

    // Checks for validity
    $('#name').blur(function(){ regexCheck(regexNameLastName, $("#name"), $("#_name"), 0) });
    $('#lname').blur(function(){ regexCheck(regexNameLastName, $("#lname"), $("#_lname"), 1) });
    $('#email').blur(function(){ regexCheck(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/, $("#email"), $("#_email"), 2) });
    $('#pass').blur(function(){ regexCheck(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/, $("#pass"), $("#_pass"), 3) });
    $('#rpass').blur(function(){
        let pass = $(this).val();
        let _pass = $('#pass').val();

        if(pass == _pass){
            $('#_rpass').hide();
            switchArray[4] = true;
        }
        else{
            $('#_rpass').show();
            switchArray[4] = false;
        }
    });
    $('#country').change(function(){
        const value = $(this).val();
        
        if(value != 0){
            $('#_country').hide();
            switchArray[5] = true;
        }
        else{
            $('#_country').show();
            switchArray[5] = false;
        }
    });
    $('#city').blur(function(){ regexCheck(regexNameLastName, $("#city"), $("#_city"), 6) });
    
});

function regexCheck(regex, address, alert, switchNum){
    let value = address.val();

    if(regex.test(value)){
        alert.hide();
        switchArray[switchNum] = true;
    }
    else{
        alert.show();
        switchArray[switchNum] = false;
    }
}

function registerFormCheck(){
    if(!switchArray.includes(false)) return true;
    $('#_form').show();
    return false;
}

function loginFormCheck(){
    if(switchArray[2] == true && switchArray[3] == true) return true;
    $('#_form').show();
    return false;
}