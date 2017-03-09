/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {

    var ramount0, ramount1, ramount2, ramount3;
    var rc0, rc1, rc2, rc3;
    var pr;
    var amount;
    var ctc;

    $('#matchForm0').submit(function (event) {

        var st = srvTime();
        var sDate = new Date(st);
        var eDate = new Date(st);
        eDate.setHours(eDate.getHours() + (24));

        var formData = {'cprovider': pr, 'camount': amount, 'ctc': ctc, 'creceiver': rc0, 'ramount': ramount0, 'sDate':sDate, 'eDate':eDate};

        $.ajax({
            url: '/backend/matchForm.php',
            type: 'post',
            data: formData,
            success: matchResponce,
            error: function (xhr, desc, err) {
                alert(xhr);
                return false;
            },
            dataType: 'text'
        });

        return false;

    });


    function matchResponce(data, status) {

        var h = parseInt(data);
//        alert(h);
        if (data == 0) {
            $('#upnotif').addClass('short');
            $('#upnotif').html("Cant match a provider with itself, please choose another receiver.");
            $('#upnotif').fadeIn(3000);
            $('#upnotif').fadeOut(10000);
        } else if (data == 2) {
            $('#upnotif').addClass('short');
            $('#upnotif').html("Amount to be provided is higher than amount to be received. Get a correct match for this provider");
            $('#upnotif').fadeIn(3000);
            $('#upnotif').fadeOut(10000);
        } else {
            window.location = "/backend/dashboard.php";
        }

    }




    $('#creceiver0').change(function () {

        var full = $('#creceiver0').val();
        ramount0 = full.split("/")[1];
        rc0 = full.split("/")[0];

    });

    $('#cprovider0').change(function () {

        var full2 = $(this).val();
        pr = full2.split("/")[0];
        amount = full2.split("/")[1];
        ctc = full2.split("/")[2];

//        alert(ctc);
    });


    var xmlHttp;
    function srvTime() {
        try {
            //FF, Opera, Safari, Chrome
            xmlHttp = new XMLHttpRequest();
        }
        catch (err1) {
            //IE
            try {
                xmlHttp = new ActiveXObject('Msxml2.XMLHTTP');
            }
            catch (err2) {
                try {
                    xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
                }
                catch (eerr3) {
                    //AJAX not supported, use CPU time.
                    alert("AJAX not supported");
                }
            }
        }
        xmlHttp.open('HEAD', window.location.href.toString(), false);
        xmlHttp.setRequestHeader("Content-Type", "text/html");
        xmlHttp.send('');
        return xmlHttp.getResponseHeader("Date");
    }





});


