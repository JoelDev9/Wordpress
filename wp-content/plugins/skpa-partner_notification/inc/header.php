<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
$_SESSION['id']  = session_id();
require "config/MyDB.php";
require "inc/PartnerNotification.php";
$partner_notification = new PartnerNotification();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Partner Notification</title>
        <meta name="description" content="Partner Notification plugin">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="css/base.css">
        <link rel="stylesheet" href="css/custom.css">
        <link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
        <script src="js/slim.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery-3.1.1.min.js"></script>
    </head>

    <body>
