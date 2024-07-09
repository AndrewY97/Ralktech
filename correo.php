<?php
$maxlifetime = 3600;
$secure = true;
$httponly = true;
$samesite = 'Lax';

session_set_cookie_params([
    'lifetime' => $maxlifetime,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => $secure,
    'httponly' => $httponly,
    'samesite' => $samesite
]);
session_start();
// echo "tokensito:". $_SESSION['csrf_token'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // echo "Token enviado:". $_POST['csrf_token'];
    // echo "Token guardado:".$_SESSION['csrf_token'];
    if (!empty($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
        echo "Token guardado en sesion:". $_POST['csrf_token'];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $message = $_POST["message"];
        $encoded_name = mb_encode_mimeheader($name, "UTF-8");
        $encoded_email = mb_encode_mimeheader($email, "UTF-8");

        $to = "yero991@hotmail.com";
        $subject = "=?UTF-8?B?" . base64_encode("Solicitud de contacto de Pagina web Ralktech") . "?=";
        $boundary = md5(uniqid(time()));
        $headers = "From: $encoded_name <$email>\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n\r\n";
        $email_content = "--$boundary\r\n";
        $email_content .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $email_content .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
        $email_content .= "Nombre: $name\r\n";
        $email_content .= "Correo electrónico: $email\r\n";
        $email_content .= "Teléfono: $phone\r\n";
        $email_content .= "Mensaje: $message\r\n\r\n";

        if (isset($_FILES["userfile"]) && $_FILES["userfile"]["error"] == UPLOAD_ERR_OK) {
            $file_attached = $_FILES["userfile"]["tmp_name"];
            $file_name     = $_FILES["userfile"]["name"];
            $file_type     = $_FILES["userfile"]["type"];
            $file_size     = $_FILES["userfile"]["size"];
            $file_content = chunk_split(base64_encode(file_get_contents($file_attached)));

            $email_content .= "--$boundary\r\n";
            $email_content .= "Content-Type: $file_type; name=\"$file_name\"\r\n";
            $email_content .= "Content-Disposition: attachment; filename=\"$file_name\"\r\n";
            $email_content .= "Content-Transfer-Encoding: base64\r\n\r\n";
            $email_content .= $file_content . "\r\n\r\n";
        }

        $email_content .= "--$boundary--";

        // Enviar el correo electrónico
        if (mail($to, $subject, $email_content, $headers)) {
            // Redirigir a la página de éxito
            header("Location: index.php");
            exit;
        } else {
            echo "Hubo un error al enviar el correo electrónico.";
        }
        unset($_SESSION['csrf_token']);
    } else {
        echo "Error: Token CSRF inválido.";
    }
}
