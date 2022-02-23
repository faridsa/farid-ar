<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /");
    exit();
}
require_once('vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logger = new Logger('contact');
$logger->pushHandler(new StreamHandler('./contact-form.log', Logger::WARNING));

session_start();
ini_set('display_errors', 0);
ini_set('log_errors', 1);


$errors = array();      // array to hold validation errors
$data = array();      // array to pass back data


if (!$_POST['token']) {
    $data =  ['result' => 'error', 'message' => 'No se puede enviar el mensaje porque falta el token de seguridad, por favor refresque la pagina y vuelva a intentarlo'];
    header('Content-type:application/json;charset=utf-8');
    http_response_code(400);
    echo json_encode($data);
    exit();
}

$token = $_POST['token'];
$action = $_POST['action'];
$secret = '6LeWU88ZAAAAAG805_xRjesHVfdLN3ERD1CGVM_i';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => $secret, 'response' => $token)));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$logger->info($response);

$arrResponse = json_decode($response, true);

var_dump($arrResponse);

if ($arrResponse["success"] != '1' || $arrResponse["action"] != $action || $arrResponse["score"] < 0.5) {
    $data = ['result' => 'error', 'message' => 'Google considera que su mensaje es inconveniente'];
    header('Content-type:application/json;charset=utf-8');
    http_response_code(406);
    echo json_encode($data);
    exit();
}


$logger->info($_POST);

// validate the variables ======================================================
// if any of these variables don't exist, add an error to our $errors array
if (empty($_POST['name'])) {
    $errors['name'] =  '<p> Debe indicar su nombre.</p>';
} else {
    $datos['name'] = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
}

if (empty($_POST['email'])) {
    $errors['email'] =  '<p> Debe indicar su email.</p>';
} else {
    $datos['email'] = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
}

if (empty($_POST['phone'])) {
    $errors['phone'] =  '<p> Debe indicar telefono de contacto.</p>';
} else {
    $datos['phone'] = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
}

if (empty($_POST['message'])) {
    $errors['message'] = '<p> Debe ingresar su mensaje.</p>';
} else {
    $datos['message'] = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
}


// return a response ===========================================================

if (!empty($errors)) :
    $data =  implode(' ', $errors);
    header('Content-type:application/json;charset=utf-8');
    http_response_code(403);
    echo json_encode($data);
    exit();
endif;

$data = enviarMail($datos);
header('Content-type:application/json;charset=utf-8');
if($data['result'] == 'success') {
    http_response_code(202);
    echo json_encode($data);
}
if($data['result'] == 'error') {
    http_response_code(503);
    echo json_encode($data);
}
exit();

///////////////////////////////////////////
function enviarMail($datos)
{
    $logger = new Logger('contact');
    $logger->pushHandler(new StreamHandler('contact-form.log', Logger::WARNING));

    $mail = new PHPMailer(true);
    $mail->isSMTP();    // send via SMTP
    $mail->Host = 'zeus.servidoraweb.net';   // SMTP servers
    $mail->SMTPSecure = 'ssl'; //tls / ssl o la configuracion que el hosting use
    $mail->Port = 465; // 465 / 587 /995 segun diga el proveedor
    $mail->SMTPDebug  = 0;
    $mail->SMTPAuth = true;
    $mail->Username = '_mainaccount@farid.ar'; // SMTP username
    $mail->Password = 'zustEs-fijvi5-sujfit'; // SMTP password
    $mail->CharSet = 'UTF-8';
    $mail->setLanguage('es');
    $mail->isHTML(true);
    $mail->setFrom('web@farid.ar', 'Formulario de Contacto');
    $mail->addReplyTo($datos['email'], $datos['name']);
    $mail->addAddress('faridsilva@gmail.com');
    $mail->Subject = 'Consulta desde farid.ar';
    $html = '<p>Datos del formulario:</p>';
    $html .= '<p>Nombre: ' . $datos['name'] . '</p>';
    $html .= '<p>Email: ' . $datos['email'] . '</p>';
    if (!is_null($datos['message'])) {
        $html .= '<p>Mensaje: ' . $datos['message'] . '</p>';
    }

    $mail->msgHTML($html);

    try {
        $mail->send();
        $result = ['result' => 'success', 'message' => 'Tu mensaje ha sido enviado, muchas gracias.'];
    } catch (phpmailerException $e) {
        $result = ['result' => 'error', 'message' => $e->errorMessage()];
        $logger->error($e->errorMessage());

    } catch (Exception $e) {
        $result = ['result' => 'error', 'message' => $e->errorMessage()];
        $logger->error($e->errorMessage());
    }
    return $result;
}
