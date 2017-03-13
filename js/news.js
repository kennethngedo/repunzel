/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {

    $('#newsForm').submit(function (event) {

        var dataSet = $('#newsForm').serialize();


        $.ajax({
            url: '/backend/createNews.php',
            type: 'post',
            data: dataSet,
            success: function (data, status) {
                alert(data);
//                window.location = "/investor/backoffice.php";
            },
            error: function (xhr, desc, err) {
                alert(xhr);
                return false;
            }
        }); // end ajax call

        return true;

    });

    var classnameDelete = document.getElementsByClassName("newsdelete");

    var newsdelete = function (evt) {
        var attribute = this.getAttribute("name");
        var formData = {'id': attribute};

        if (confirm('Are you sure you want to remove this news?')) {

            $.ajax({
                url: '/backend/newsdelete.php',
                type: 'post',
                data: formData,
                success: matchResponce,
                error: function (xhr, desc, err) {
                    alert(xhr);
                    return false;
                },
                dataType: 'text'
            });
            
        }

        return false;
    };
    
    
    for (var i = 0; i < classnameDelete.length; i++) {
        classnameDelete[i].addEventListener('click', newsdelete);
    }
    
    
    
    function matchResponce(data, status) {
        
        alert(data);
//        work();
window.location = '/backend/dashboard.php';


    }


});