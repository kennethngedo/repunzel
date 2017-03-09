/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {


    function work() {

        // datepart: 'y', 'm', 'w', 'd', 'h', 'n', 's'
        function dateDiff(datepart, fromdate, todate) {
            datepart = datepart.toLowerCase();
            var diff = todate - fromdate;
            var divideBy = {w: 604800000,
                d: 86400000,
                h: 3600000,
                n: 60000,
                s: 1000};

            return Math.floor(diff / divideBy[datepart]);
        }

        var st = srvTime();
        var today = new Date(st);

        fullStack = new Array();
        var output = '';
        $.ajax({
            url: '/backend/failedHelps.php',
            type: "POST",
            success: function (msg) {
                fullStack = msg;
                for (var i = 0; i < fullStack.length; i++) {
//                alert(fullStack[i].provider);

                    var endDate = new Date(fullStack[i].completion_date);

                    var hoursDiff = dateDiff('h', today, endDate);

                    if (hoursDiff < 0) {

                        output = output + '<div class="row bg-danger" >' +
                                '<div class="col-sm-10 ">' +
                                '<div class="row" >' +
                                '<div class="col-sm-8 ">' +
                                '<label id="tName">PROVIDER: ' + fullStack[i].provider + '</label><br>' +
                                '<label id="tRefferer">RECIEVER: ' + fullStack[i].reciever + '</label><br>' +
                                '<label id="tCode">AMOUNT: ' + fullStack[i].amount + '</label><br>' +
                                '<label id="tCode">TRNS. CODE: ' + fullStack[i].transaction_code + '</label><br>' +
                                '<label id="tStatus">STATUS: ' + fullStack[i].status + '</label><br>' +
                                '</div>' +
                                '<div class="col-sm-4 "><img  src="' + fullStack[i].pop + '"/></div>' +
                                '</div>' +
                                '</div>' +
                                '<div class="col-sm-2 ">' +
                                '<span style="cursor:pointer" name="' + fullStack[i].provider_ref + '/' + fullStack[i].reciever_ref + '/' + fullStack[i].transaction_code + '" id="' + fullStack[i].provider_ref + '/' + fullStack[i].reciever_ref + '/' + fullStack[i].transaction_code + '" class="details badge fpop">fake pop</span>' +
                                '<span style="cursor:pointer" name="' + fullStack[i].provider_ref + '/' + fullStack[i].reciever_ref + '/' + fullStack[i].transaction_code + '" id="' + fullStack[i].provider_ref + '/' + fullStack[i].reciever_ref + '/' + fullStack[i].transaction_code + '" class="details badge tup">time up</span>' +
                                '</div>' +
                                '</div><br>';
                    }
                }
//            alert(output);
                $("#putmore").html(output);


                var classnameDelete = document.getElementsByClassName("fpop");
                var classnameChange = document.getElementsByClassName("tup");

                var myFunction = function (evt) {
                    var attribute = this.getAttribute("name");
//            alert(attribute);

                    var pref = attribute.split("/")[0];
                    var rref = attribute.split("/")[1];
                    var tcode = attribute.split("/")[2];

                    var formData = {'pref': pref, 'rref': rref, 'tcode': tcode};

                    if (confirm('This action will remove the investor who made the ph: ' + tcode + '?')) {

                        $.ajax({
                            url: '/backend/fakePop.php',
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
                    classnameDelete[i].addEventListener('click', myFunction);
                }



                var myFunction2 = function (evt) {
                    var attribute = this.getAttribute("name");
//            alert(attribute);

                    var pref = attribute.split("/")[0];
                    var rref = attribute.split("/")[1];
                    var tcode = attribute.split("/")[2];

                    var formData = {'pref': pref, 'rref': rref, 'tcode': tcode};

                    if (confirm('Thia action will reset the gh and remove the ph: ' + tcode + '?')) {
                        $.ajax({
                            url: '/backend/timeUp.php',
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

                for (var i = 0; i < classnameChange.length; i++) {
                    classnameChange[i].addEventListener('click', myFunction2);
                }

            },
            dataType: "json"
        });

    }

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


    function matchResponce(data, status) {
        
        alert(data);
        work();


    }

    work();

});


