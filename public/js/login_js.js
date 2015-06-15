// JavaScript Document
function val()
{
    var flag = 1;
    var b = document.getElementById("password").value;
    if (b == '') {
        document.getElementById("password").className = "invalid";
        flag *= 0;
    }
    else {
        flag *= 1;
        document.getElementById("password").className = "";
    }
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var chk = re.test(document.getElementById("username").value);
    if (chk == '') {
        document.getElementById("username").value = null;
        document.getElementById("username").className = "invalid";
        flag *= 0;
    }
    else {
        flag *= 1;
        document.getElementById("username").className = "";
    }

    if (flag) {
        var incorrect_login_counter = add();
        if (incorrect_login_counter >= 3) {
            document.getElementById("captchenable").style.display = 'block';
        }        
        send(incorrect_login_counter, flag);
    }
    else
        return;
}

var add = (function() {
    var counter = 0;
    return function() {
        return counter += 1;
    }
})();

function send() {
    var incorrect_login_counter = arguments[0];
    var flag = arguments[1];
    if (incorrect_login_counter >= 3) {
        var captcha = document.getElementById("captcha").value;
        if (captcha == '') {
            flag *= 0;            
        }
        else {
            flag *= 1;
        }
    }
    if (flag)
    {
        document.getElementById("signin").disabled = true;
        $.ajax({
            type: 'post',
            url: 'http://localhost/ci/index.php/complaint/check_user',
            data: {
                email: $("#username").val(),
                captcha: $("#captcha").val(),
                password: $("#password").val()
            },
            success: function(data) {
                if (data != 0) {
                    //window.alert("login successful");
                    window.location.assign('http://localhost/ci/index.php/' + data);
                }
                else {
                    document.getElementById("signin").disabled = false;
                    document.getElementById("incorrect").style.display = 'block';
                    //document.getElementById("image").innerHTML='hello';
                    //document.getElementById("image").innerHTML='<img src="http://localhost/ci/public/images/captcha.php" height="50px" width="100px">';
                }
            }
        });
    }
}

