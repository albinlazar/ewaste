<?php
session_start();

function check_login() {
    if(!isset($_SESSION["user_id"])) {
        header("Location: ../../login.php");
        exit();
    }
}

function check_admin_login() {
    if(!isset($_SESSION["admin_id"])) {
        header("Location: ../../login.php");
        exit();
    }
}
?>
