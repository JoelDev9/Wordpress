<?php include "inc/header.php"; ?>
<?php 
    $task = 'get_message';
    if(isset($_GET['task'])) {
        $task = $_GET['task'];
    }
    $partner_notification->process($task);
?>
<?php include "inc/footer.php"; ?>