<?php
    session_start();
    $servername = "localhost";
    $username = "cp41333_register";
    $password = "d91pcZj6";
    $dbname = "cp41333_register";

    // Создание подключения
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверка подключения
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Получение данных формы и выполнение необходимой проверки
    $name = $_POST['name'];
    $email = $_POST['email'];
    $passWord = $_POST['password'];
    $hashedPassword = $_POST['hashe_password'];


    $query = "SELECT * FROM Users_Registrations WHERE email = '$email' AND password = '$passWord'";
    $result = $conn->query($query);

    // Проверка валидации инпутов
    if (empty($name) || empty($email) || empty($passWord)) {
        $message = "Заполните все обязательные поля!"; // Ваше сообщение
        $url = "sign_up.html"; // URL другой страницы
        $jsCode = "alert('$message'); window.location.href = '$url';";
        // Вывод сгенерированного кода JavaScript
        echo "<script>{$jsCode}</script>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Неправильная электронная почта!"; // Ваше сообщение
        $url = "sign_up.html"; // URL другой страницы
        $jsCode = "alert('$message'); window.location.href = '$url';";
        // Вывод сгенерированного кода JavaScript
        echo "<script>{$jsCode}</script>";
    } elseif ($result->num_rows > 0) {
        $message = "Пользователь с таким email уже существует!"; // Ваше сообщение
        $url = "sign_up.html"; // URL другой страницы
        $jsCode = "alert('$message'); window.location.href = '$url';";
        // Вывод сгенерированного кода JavaScript
        echo "<script>{$jsCode}</script>";
    } else {

        // Хэширование пароля
        $hashedPassword = hash('sha256', $passWord);

        // Очистка входных данных формы перед вставкой в базу данных
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $passWord = mysqli_real_escape_string($conn, $passWord);

        // Выполнение запроса для вставки данных в базу данных
        $query = "INSERT INTO Users_Registrations (name, email, hashe_password) VALUES ('$name', '$email', '$hashedPassword')";
        $result = mysqli_query($conn, $query);

        // Проверить, был ли запрос успешным
        if ($result) {
            // Редирект на главную страницу после успешной вставки
            header("Location: sign_in.html");
            exit();
        } else {
            $message = "Ошибка при подключении к базе данных!"; // Ваше сообщение
            $url = "sign_up.html"; // URL другой страницы
            $jsCode = "alert('$message'); window.location.href = '$url';";
        }
    }

    // Закрытие соединения
    $conn->close();
?>