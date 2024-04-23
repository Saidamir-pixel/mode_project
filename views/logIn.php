<?php
session_start();
include '../control/authController.php';
login();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/style/loginScreen.css">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const messages = document.querySelectorAll('.alert');
            messages.forEach(msg => {
                setTimeout(() => {
                    msg.style.display = 'none';
                }, 5000);
            });
        });
    </script>

    <title>Let's f*cking GO!</title>

</head>
<body>
    <div class="message-container">
        <?php
            if (!empty($_SESSION['errors'])) {
                foreach ($_SESSION['errors'] as $error) {
                    echo '<div class="alert alert-danger">' . $error . '</div>';
                    echo '<br>';
                }
                unset($_SESSION['errors']); // Очистка сообщений об ошибках после их отображения
            }
        ?>
    </div>

    <div class="login-container">
        <div class="login-content">
            <h2>Authorization</h2>
            
           <form action="" method="post">
                <div class="form-group">
                <label for="username">Name of user:</label>
                    <div id="username">
                        <input type="text" id="username" name="nameOfUser" required>
                    </div>
                </div>

                <div class="form-group">
                <label for="password">Password:</label>
                <div id="password">
                    <input type="password" id="password" name="password" required>
                </div>
                </div>

                <div class="buttons">
                    <button type="submit" class="button-49">Log In</button>

                    
                    <button type="submit" class="button-49" role="button"><a href="registration.php">Sign In</a></button>
                    
                </div>

            </form>
        </div>
    </div>
</div>


<script src="../assets/scripts/warningPass.js"></script>

</body>
</html>