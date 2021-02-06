var switchArray = [false, false, false, false, false, false, false];
var switchArrayForPost = [false, false, false];

$(document).ready(function(){
    $('.preventDefault').click(function(e){
       e.preventDefault();
    });

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
    });

    // Search Functionality
    $('#search_btn').click(function(e){
        let value = $('#search').val();

        $.ajax({
            url: "models/discussions/search.php",
            dataType: "json",
            method: "POST",
            data: {
                value: value
            },
            success: function(data){
                displayDiscussions(data.discussions, data.categories, data.users);
            },
            error: function(err){
                console.log(err);
            }
        });
    });

    // Like Functionality
    $('#likeButton').click(function(){
        let user = $('#userL').val();
        let discussion = $('#discussionL').val();

        $.ajax({
            url: "models/discussions/like.php",
            dataType: "json",
            method: "POST",
            data: {
                user: user,
                discussion: discussion
            },
            success: function(data){
                $('.likeConfirmation').show();
                showLikes(discussion);
            },
            error: function(err, textStatus){
                console.log(textStatus, err);
            }
        });
    });

    // Search Functionality
    $('#search_btn').click(function(e){
        let value = $('#search').val();

        $.ajax({
            url: "models/discussions/search.php",
            dataType: "json",
            method: "POST",
            data: {
                value: value
            },
            success: function(data){
                displayDiscussions(data.discussions, data.categories, data.users);
            },
            error: function(err){
                console.log(err);
            }
        });
    });

    // Friend Request Functionality
    $('#friend_request').click(function(e){
        let sender = $('#sender').val();
        let receiver = $('#receiver').val();

        $.ajax({
            url: "models/account/friend_request.php",
            dataType: "json",
            method: "POST",
            data: {
                sender: sender,
                receiver: receiver
            },
            success: function(data){
                if(data == 0) $('#friendRequestNotificationText').text('Friend request sent.');
                else if(data == 1) $('#friendRequestNotificationText').text('Friend request already sent and pending.');
            },
            error: function(err, textStatus){
                console.log(textStatus);
            }
        });
    });


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

function displayDiscussions(discussions, categories, users){
    let html = "<p class=\"h2\">No Discussions to show.</p>";

    if(discussions.length > 0){
        discussions.sort(function(a, b){
            if(a.timestamp < b.timestamp) return 1;
            else if(a.timestamp > b.timestamp) return -1;
            else return 0;
        });

        html = "";

        discussions.forEach(disc => {
            let user, user_id, category, ctg_id;
            const date = new Date();
            const day = date.getDate();
            const month = date.getMonth();
            const year = date.getFullYear();

            categories.forEach(ctg => {
                if(ctg.id == disc.category) {
                    category = ctg.name;
                    ctg_id = ctg.id;
                }
            });

            users.forEach(usr => {
                if(usr.id == disc.user_id) {
                    user = usr.name + " " + usr.last_name;
                    user_id = usr.id;
                }
            });

            html += `
                <article class="blog_item">
                    <div class="blog_details">
                        <a class="d-inline-block" href="index.php?page=discussion&id=${disc.id}">
                            <h2>${disc.name}</h2>
                        </a>
                        <p>${disc.content}</p>
                        <ul class="blog-info-link">
                            <li><a href="index.php?page=user&id=${user_id}"><i class="fa fa-user"> ${user}</i></a></li>
                            <li><a href="index.php?page=category&id=${ctg_id}"><i class="fa fa-globe"> ${category}</i></a></li>
                            <li><a href="index.php?page=discussion&id=${disc.id}">${day}.${month + 1}.${year}</a></li>
                        </ul>
                    </div>
                </article>
            `;
        });
    }

    $('#discussions_display_box').html(html);
}

function showLikes(discussion){
    $.ajax({
        url: "models/discussions/like_count.php",
        dataType: "json",
        method: "POST",
        data: {
            discussion: discussion
        },
        success: function(data){
            $('#numberOfLikes').html(data.count);
        },
        error: function(err, textStatus){
            console.log(textStatus, err);
        }
    });
}






