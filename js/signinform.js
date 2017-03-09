/* 
 * Handles forms validation and processing
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {

    $('#signinForm').submit(function (event) {
        
        var data  = $('#signinForm').serialize();
        
        $.post('./login.php', data, loginResponce);

        //window.location = "./templateActivationEmail.php";

        return false;
        
    });

    
    
    function loginResponce(data, status) {
        
        if (data != 'exists') {
            $('#failAlert2').addClass('short');
            $('#failAlert2').css("display", "block");
            $('#failAlert2').html("Failed: Invalid login");
            $('html, body').animate({scrollTop: $("#failAlert2").offset().top}, 2000);
        } else {
            //redirect to dashboard
           
            window.location = "/investor/backoffice.php";
        }
    }
    
    $('#adminForm').submit(function (event) {
        
        var data  = $('#adminForm').serialize();
        
        $.post('./login.php', data, adminLoginResponce);

        //window.location = "./templateActivationEmail.php";

        return false;
        
    });

    
    
    function adminLoginResponce(data, status) {
//        alert(data);
        if (data != 'exists') {
            $('#failAlert2').addClass('short');
            $('#failAlert2').css("display", "block");
            $('#failAlert2').html("Failed: Invalid login");
            $('html, body').animate({scrollTop: $("#failAlert2").offset().top}, 2000);
        } else {
            //redirect to dashboard
           
            window.location = "/backend/dashboard.php";
        }
    }

});

