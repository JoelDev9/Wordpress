<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require ("../config/MyDB.php");
require ("../includes//Admin.php");
$admin = new Admin();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Safe Spaces</title>
        <meta name="description" content="Safe Spaces Hubs plugin">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="../admin/css/base.css">
        <link rel="stylesheet" href="../admin/css/custom.css">
        <link rel="stylesheet" href="../admin/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../admin/css/jquery.dataTables.min.css">
        <script src="../admin/js/slim.min.js"></script>
        <script src="../admin/js/popper.min.js"></script>
        <script src="../admin/js/bootstrap.min.js"></script>
        <script src="../admin/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../admin/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../admin/js/dataTables.buttons.min.js"></script>
    </head>

    <body>
