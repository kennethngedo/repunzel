/* 
 * Handles forms validation and processing
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {

    $('#signupForm').submit(function (event) {

        var data = $('#signupForm').serialize();//get all the form the data

        var password1 = $('input[name=password1]').val();
        var password2 = $('input[name=retype_password]').val();

        var emailWatcher = $('input[name=eatcher]').val();

        if (password1 != password2) {
            $('#failAlert').addClass('short')
            $('#failAlert').css("display", "block");
            $('#failAlert').html("Passwords did not match");
            $('html, body').animate({scrollTop: $("#failAlert").offset().top}, 2000);
        } else if (emailWatcher === 'This email is already in use') {
            $('#failAlert').addClass('short')
            $('#failAlert').css("display", "block");
            $('#failAlert').html("The email provided has been used by another investor.");
            $('html, body').animate({scrollTop: $("#failAlert").offset().top}, 2000);
        } else {
            $.post('./signup.php', data, signupResponce);
        }

        return false;
    });



    function signupResponce(data, status) {
        if (data != 'success') {
            $('#failAlert').addClass('short')
            $('#failAlert').css("display", "block");
            $('#failAlert').html(data);
            $('html, body').animate({scroll: $("#failAlert").offset().top}, 2000);
        } else {
            window.location = "./signupSuccess.php";
        }
    } 


});

