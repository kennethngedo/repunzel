/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {

    if (document.getElementById('loginBt'))
        document.getElementById('loginBt').addEventListener('click', myLoginfunction);
    if (document.getElementById('newsBt'))
        document.getElementById('newsBt').addEventListener('click', myNewsfunction);
    if (document.getElementById('homeBt'))
        document.getElementById('homeBt').addEventListener('click', myHomefunction);
    if (document.getElementById('upgradeBt'))
        document.getElementById('upgradeBt').addEventListener('click', myUpgradefunction);
    

    function myLoginfunction() {
        window.location = '/login.php';
    }

    function myNewsfunction() {
        window.location = '/news.php';
    }

    function myHomefunction() {
        window.location = '/index.php';
    }
    
   

    function myUpgradefunction() {
        var package = document.getElementById('upgradeBt').getAttribute('name');
        var user = document.getElementById('upgradeBt').getAttribute('id');
        if (confirm('Continue with this action to upgrade to ' + package + ' package')) {
            window.location = 'processUpgrade.php?package=' + package + '&user=' + user;
        }
    }
    
 


});


