<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {
        //Crear el objeto de email

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'e5f00ebb994edc';
        $mail->Password = '6b7b869b93a268';
        $mail->SMTPSecure = 'tls';

        //Configurar el contenido de mail 
        //Quien envia el correo, evitar bandeja de no deseados 
        $mail->setFrom('cuentas@ceveterinaria.com');
        //A que correo va a llegar el email
        $mail->addAddress('cuentas@ceveterinaria.com', 'CdEVeterinaria');
        //Asunto
        $mail->Subject = 'Confirma tu cuenta';
        //Habilitar HTML o sin formato
        $mail->isHTML(true);
        //Para mostrar los acentos de manera correcta 
        $mail->CharSet = 'UTF-8';

        //Definir el contenido
        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . " </strong> Has creado una cuenta en CdE Veterianaria, debes confirmarla utilizando el siguiente enlace </p>";
        $contenido .= "<p>Presiona aquí : <a href='http://localhost:3000/confirmar?token=" . $this->token . "'>Enlace</a> </p>";
        $contenido .= "<p>Si no solicitaste esta cuenta, puede ignorar este mensaje </p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;
        //Alternativo cuando no soporta html
        $mail->AltBody = 'texto alternativo';

        $mail->send();
    }

    public function enviarRecuperar()
    {
        //Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'e5f00ebb994edc';
        $mail->Password = '6b7b869b93a268';
        $mail->SMTPSecure = 'tls';

        //Configurar el contenido de mail 
        //Quien envia el correo, evitar bandeja de no deseados 
        $mail->setFrom('cuentas@ceveterinaria.com');
        //A que correo va a llegar el email
        $mail->addAddress('cuentas@ceveterinaria.com', 'CdEVeterinaria');
        //Asunto
        $mail->Subject = 'Restablecer contraseña';

        //Habilitar HTML o sin formato
        $mail->isHTML(true);
        //Para mostrar los acentos de manera correcta 
        $mail->CharSet = 'UTF-8';

        //Definir el contenido 
        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . " </strong> Has solicitado un cambio de contraseña en tu cuenta de CdE Veterinaria, utiliza el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/restablecer?token=" . $this->token . "'>Enlace</a> </p>";
        $contenido .= "<p> Si no solicitaste el cambio de contraseña, puedes ignorar este mensaje </p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;
        //Alternativo cuando no soporta html
        $mail->AltBody = 'texto alternativo';

        $mail->send();
    }
}
