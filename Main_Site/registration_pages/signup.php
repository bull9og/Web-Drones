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

    // Retrieve the form data and perform necessary validation
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $query = "SELECT * FROM Users_Registrations WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($query);

    // Validate the form inputs (e.g. check for empty fields, validate email format, etc.)
    if (empty($name) || empty($email) || empty($password)) {
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
        // Sanitize the form inputs before inserting into the database
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);

        // Execute the query to insert data into the database
        $query = "INSERT INTO Users_Registrations (name, email, password) VALUES ('$name', '$email', '$password')";
        $result = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($result) {
            // Redirect to the main page after successful insertion
            header("Location: ../index.html");
            exit();
        } else {
            echo "Error while inserting data into the database: " . mysqli_error($conn);
        }
    }

    // Close the connection
    $conn->close();
?>