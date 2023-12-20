<?php
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

$title = "Тема письма";
$file = $_FILES['file'];

$c = true;
// Формирование самого письма
$title = "Письмо с сайта переустановка windows";
foreach ( $_POST as $key => $value ) {
  if ( $value != "" && $key != "project_name" && $key != "admin_email" && $key != "form_subject" ) {
    $body .= "
    " . ( ($c = !$c) ? '<tr>':'<tr style="background-color: #f8f8f8;">' ) . "
      <td style='padding: 10px; border: #e9e9e9 1px solid;'><b>$key</b></td>
      <td style='padding: 10px; border: #e9e9e9 1px solid;'>$value</td>
    </tr>
    ";
  }
}

$body = "<table style='width: 100%;'>$body</table>";

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();

try {
  $mail->isSMTP();
  $mail->CharSet = "UTF-8";
  $mail->SMTPAuth   = true;

  $mail->Host       = 'smtp.yandex.ru'; // SMTP сервера вашей почты
  $mail->Username   = 'servera-center@yandex.ru'; // Логин на почте
  $mail->Password   = 'mjbgjocylusnkxbv'; // Пароль на почте
  $mail->SMTPSecure = 'ssl';
  $mail->Port       = 465;
  $mail->setFrom('servera-center@yandex.ru', 'Дмитрий'); // Адрес самой почты и имя отправителя
  
  // Получатель письма
  $mail->addAddress('servera-center@yandex.ru');  
  $mail->addAddress('serveracenter@gmail.com'); // Ещё один, если нужен




  // Отправка сообщения
  $mail->isHTML(true);
  $mail->Subject = $title;
  $mail->Body = $body;

  $mail->send();

} catch (Exception $e) {
  $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}
