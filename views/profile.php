<?php

session_start();

if (!isset($_SESSION['nameOfUser'])) {
    header("Location: registration.php");
    exit();
}

require_once '../control/authController.php';
timerData();

global $dbh;
if($_SESSION['time']){
    $timerDataValue = $_SESSION['time'];
}else {
    $timerDataValue = 0;    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/profile.css">
    <title><?= $_SESSION['nameOfUser']?> mode</title>
</head>
<body>
    <div class="parallax-container">    
        <header class="header">
            
    
            <div class="logo"><?= $_SESSION['nameOfUser']?> mode</div>
            <div class="links">
                <a id="a1" href="../index.php">Back</a>
                <a id="a2" href="../models/logout.php">Exit</a>
            </div>


            <div class="burger-menu">
                <div></div>
                <div></div>
                <div></div>
            </div>
            
        </header>
    <div class="parallax-bg"></div>

    <div class="body-content">
        <div class="main-content">
            <div class="user-progress">
                <?php
                
                    echo '<p style="color:white">Your current progress: </p>';
                    echo '<h4 style="color:white">' . $timerDataValue . ' minutes </h4>';
                
                ?>
            </div>
        </div>
    </div>

    <script src="../assets/scripts/script.js"></script>

</body>
</html>