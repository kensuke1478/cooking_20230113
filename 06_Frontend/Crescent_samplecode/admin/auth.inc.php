<?php
function authConfirm ()
{
    if ($_SESSION['admin_login'] != true) {
        header('Location: login.php');
        exit;
    }
}
