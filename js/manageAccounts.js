/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {


    $('#search').keyup(function () {
        var formData = {'src': this.value};
        $.post('/backend/fetchInvestor.php', formData, searchResponce, 'text');
    });

    document.getElementById('search').addEventListener('paste', function () {
        var formData = {'src': this.value};
        $.post('/backend/fetchInvestor.php', formData, searchResponce, 'text');
    });



    function searchResponce(data, status) {

        document.getElementById('putit').innerHTML = data;


        var classnameDelete = document.getElementsByClassName("mADelete");
        var classnameChange = document.getElementsByClassName("mAChange");
        var classnamePriv = document.getElementsByClassName("mPriv");

        var myFunction = function (evt) {
            var attribute = this.getAttribute("name");
//            alert(attribute);

            var ref = attribute.split("/")[0];
            var status = attribute.split("/")[1];

            var formData = {'ref': ref, 'status': status};

            if (confirm('Are you sure you want to delete investor: ' + ref + '?')) {

                $.ajax({
                    url: '/backend/deleteInvestor.php',
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
        
        var myFunction3 = function (evt) {
            var attribute = this.getAttribute("name");
//            alert(attribute);

            var ref = attribute.split("/")[0];
            var status = attribute.split("/")[1];

            var formData = {'ref': ref, 'priviledges': status};

            if (confirm('Are you sure you want to change the admin privileges for: ' + ref + '?')) {

                $.ajax({
                    url: '/backend/privInvestor.php',
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
        
        for (var i = 0; i < classnamePriv.length; i++) {
            classnamePriv[i].addEventListener('click', myFunction3);
        }



        var myFunction2 = function (evt) {
            var attribute = this.getAttribute("name");
//            alert(attribute);

            var ref = attribute.split("/")[0];
            var status = attribute.split("/")[1];
            
            var formData = {'ref': ref, 'status': status};

            if (confirm('Are you sure you want to change the status of investor: ' + ref + '?')) {
                $.ajax({
                    url: '/backend/changeInvestorStatus.php',
                    type: 'post',
                    data: formData,
                    success: matchResponce2,
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

    }


    function matchResponce(data, status) {

        document.getElementById('search').value = data;
        $("#search").keyup();


    }

    function matchResponce2(data, status) {
        document.getElementById('search').value = data;
        $("#search").keyup();

    }




});

