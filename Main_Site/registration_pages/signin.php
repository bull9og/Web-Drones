<?php
    session_start();
    $servername = "localhost";
    $username = "cp41333_register";
    $password = "d91pcZj6";
    $dbname = "cp41333_register";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Проверить, была ли отправлена форма входа
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Продолжайте проверку учетных данных и вход в профиль
    }

    // Хэширование пароля
    $hashedPassword = hash('sha256', $password);

    // Выполнить запрос к базе данных, чтобы найти пользователя
    $query = "SELECT * FROM Users_Registrations WHERE email = '$email' AND hashe_password = '$hashedPassword'";
    $result = $conn -> query($query);

    // Проверить, найден ли пользователь
    if ($result->num_rows > 0) {
        // Пользователь найден, установить переменную сессии
        $_SESSION['id'] = $name;     
        // Перенаправить пользователя на страницу профиля
        header('Location: ../index.html');
        exit;
    } else {
        // Если пользователь с указанными учетными данными не найден, вывести сообщение об ошибке
        $message = "Неправильная почта или пароль!"; // Ваше сообщение
        $url = "sign_in.html"; // URL другой страницы
        $jsCode = "alert('$message'); window.location.href = '$url';";
        // Вывод сгенерированного кода JavaScript
        echo "<script>{$jsCode}</script>";
    }

    $conn->close();
?>