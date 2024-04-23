<?php
session_start();
require_once 'control/authController.php';
lastWord();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["timer"])) {

    header("Location: views/profile.php");
    exit();
}

?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style/mainScreen.css">
    <title>Mode</title>
    
</head>
<body>

    <div id="modal-con" class="modal-con">
        <div class="modal-content-con">
            <span class="close-con" onclick="hideModal()">&times;</span>
            <h1>Time is over!</h1>
            <p>You did well, beast!</p>
            <div id="timer-data-sub">
                <form action="" method="post">
                    <input type="text" name="timer" id="timer_data" readonly></input>
                    <button type="submit" role="button">Save your timer data.</button>
                </form>
            </div>
        </div>
    </div>

    <div class="parallax-container">    
        <header class="header">    
            <div class="logo">GOD MODE</div>
            <div class="links">
                <?php 
                    if (!isset($_SESSION['nameOfUser'])) {
                        echo '<a href="views/logIn.php">Log In</a>';

                    } else {
                        echo '<a href="views/profile.php">Profile</a>';
                    }
                ?>
            </div>


        </header>
        <div class="parallax-bg"></div>
            <div class="content">
                <button class="bubbly-button" id="timerButton" data-state="start">Start Timer</button>
            </div>

            <div id="formContainer" style="display: none;">
                <?php 
                    if (isset($_SESSION['nameOfUser'])) {
                        echo '<form method="POST">
                            <div id="timer" style="display: none;">
                                <p id="timerDisplay"></p>
                            </div>

                        </form>';
                    }   
                ?>
                
                    <?php 

                        if(!isset($_SESSION['nameOfUser'])){
                            echo '<p id="secondText" style="display: none;">You must be logged in.</p>';
                        }else{
                            echo '<p id="secondText" style="display: none;">Someday you will outgrow your god mode.</p>';
                        }


                    ?>
            </div>

    </div>


    <script src="assets/scripts/script.js"></script>
    <script src="assets/scripts/timer.js"></script>
    
</body>
</html>
