<?php 

function user_login() {
    if (isset($_POST['nameOfUser']) && isset($_POST['password'])) {
        global $dbh;

        $nameOfUser = htmlspecialchars($_POST['nameOfUser']);
        $password = $_POST['password'];

        $errors = [];

        $stmtData = $dbh->prepare("SELECT * FROM users WHERE nameOfUser = :nameOfUser");
        $stmtData->execute(['nameOfUser' => $nameOfUser]);
        $user = $stmtData->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION["nameOfUser"] = $user['nameOfUser'];
            // Перенаправление на index.php
            header("Location: /index.php");
            exit();
            
        }else{
            $errors[] = "Check your data again";
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors; // Сохраняем ошибки в сессии
            header('Location: logIn.php');
            exit();
        }
    }
}



function user_reg() {

    if (isset($_POST['nameOfUser']) && isset($_POST['password'])) {
        global $dbh;
        $nameOfUser = htmlspecialchars($_POST['nameOfUser']);
        $password = $_POST['password'];
        $errors = [];

        // Проверяем длину имени пользователя и пароля
        if (strlen($nameOfUser) < 6 || strlen($nameOfUser) > 10) {
            $errors[] = "The username min 6 characters and max 10.";
        }
        if (strlen($password) < 6 || strlen($password) > 20) {
            $errors[] = "The password min 6 characters and max 20.";
        }
        $stmtUid = $dbh->prepare("SELECT * FROM users WHERE nameOfUser = ?");
        $stmtUid->execute([$nameOfUser]);
        if ($stmtUid->rowCount() > 0) {
            $errors[] = "This username is already taken.";
        }

        if (!preg_match('/^[a-zA-Z0-9]+$/', $password)) {
            $errors[] = "The password can only contain letters and numbers.";
        }

        // Проверяем, есть ли ошибки
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors; // Сохраняем ошибки в сессии
            header('Location: registration.php');
            exit();
        }else{
            // Регистрация нового пользователя
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (nameOfUser, password) VALUES (?, ?)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([$nameOfUser, $hash]);

            $sql = "INSERT INTO timer_data (userName, time) VALUES (?, ?)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([$nameOfUser, 0.1]);

            header('Location: logIn.php');
            exit();
        }
    }
}


function saveTimerTime() {
    if(isset($_POST['timer'])){
        global $dbh;
        // Получаем имя пользователя из сессии
        $userName = $_SESSION['nameOfUser'];
        
        // Получаем новые данные таймера из POST запроса
        $timer = $_POST['timer'];
        
        // Проверяем, существует ли запись для данного пользователя в таблице timer_data
        $sql = "SELECT COUNT(*) FROM timer_data WHERE userName = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$userName]);
        $count = $stmt->fetchColumn();
        
        if ($count > 0) {
            // Если запись существует, получаем текущие данные таймера из базы данных
            $sql = "SELECT time FROM timer_data WHERE userName = ?";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([$userName]);
            $currentTimerData = $stmt->fetchColumn();
        
            // Выполняем сложение текущих данных с новыми данными
            $result = $currentTimerData + $timer;
        
            // Обновляем данные таймера в базе данных
            $sql = "UPDATE timer_data SET time = ? WHERE userName = ?";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([$result, $userName]);
        } else {
            // Если запись не существует, создаем новую запись с начальным значением данных таймера
            $sql = "INSERT INTO timer_data (userName, time) VALUES (?, ?)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([$userName, $timer]);
        }
    }
}


function getData() {
    global $dbh;
    // Получаем имя пользователя из сессии
    $userName = $_SESSION['nameOfUser'];

    // SQL-запрос для извлечения данных таймера для данного пользователя
    $sql = "SELECT time FROM timer_data WHERE userName = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$userName]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    // Проверяем, найдены ли данные для данного пользователя
    if ($data) {
        // Установка значения в сессии
        $_SESSION['time'] = $data['time'];

    }

}

?>
