<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('ru', 'phpmailer/language/');
	$mail->IsHTML(true);

	// От кого письмо
	$mail->setFrom('message@gmail.com');
	// Кому отправить
	$mail->addAddress('crovex@swdteam.ru');
	// Тема письма
	$mail->Subject = 'Здравствуйте!';

	$body = '';
	if(!empty(trim($_POST['email']))) {
    $body .= '<p><strong>E-mail: </strong>' . $_POST['email'] . '</p>';
	}
	if(!empty(trim($_POST['message']))) {
		$body .= '<p><strong>Сообщение: </strong>' . $_POST['message'] . '</p>';
	}


	$mail->Body = $body;

	// Отправка
	if (!$mail->send()) {
		$message = 'Ошибка';
	} else {
		$message = 'Данные отправлены!';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>



















