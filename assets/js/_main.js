var switchArray = [false, false, false, false, false, false, false];
var switchArrayForPost = [false, false, false];

$(document).ready(function(){
    // Hide field alerts
    $('.red').hide();

    // Checks for validity
    const regexNameLastName = /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/;
    const regexForTextTitle = /^[a-zA-Z0-9.,'-_:;?! ]{1,70}$/;
    const regexForTextContent = /^[a-zA-Z0-9.,'-_:;?! ]{1,500}$/;

    // Login and Registration
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

    // Posting a Discussion
    $('#title').blur(function(){ regexCheck(regexForTextTitle, $("#title"), $("#_title"), 0, 1) });
    $('#content').blur(function(){ regexCheck(regexForTextContent, $("#content"), $("#_content"), 2, 1) });
    $('#category').change(function(){
        const value = $(this).val();

        if(value != 0){
            $('#_content').hide();
            switchArrayForPost[1] = true;
        }
        else{
            $('#_content').show();
            switchArrayForPost[1] = false;
        }
    })

});

function regexCheck(regex, address, alert, switchNum, arrayForSwitch = 0){
    let value = address.val();

    if(regex.test(value)){
        alert.hide();
        if(arrayForSwitch == 0) switchArray[switchNum] = true;
        else if(arrayForSwitch == 1)switchArrayForPost[switchNum] = true;
    }
    else{
        alert.show();
        if(arrayForSwitch == 0) switchArray[switchNum] = false;
        else if(arrayForSwitch == 1)switchArrayForPost[switchNum] = false;
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

function postFormCheck(){
    if(!switchArrayForPost.includes(false)) return true;
    $('#_post').show();
    return false;
}
