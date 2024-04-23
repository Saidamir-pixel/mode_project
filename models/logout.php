<?php
session_start(); // Начинаем сессию

// Удаляем все данные сессии
session_unset();
session_destroy();

// Перенаправляем пользователя на страницу авторизации
header('Location: /views/logIn.php');
exit;
?>
