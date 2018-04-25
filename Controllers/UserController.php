<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 11/04/2018
 * Time: 23:32
 */
//$dirname = DIRNAME;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php'; //changer avec dirname
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
//require $dirname .'Public/Libraries/PHPMailer/src/SMTP.php';

class UserController
{
    public function indexAction($params)
    {
        echo "nothing";
    }

    public function addAction($params)
    {
        $user = new User();

        //$user->setId();
        $user->setEmail('domangejulien@gmail.com');
        $user->setToken();
        $user->setFirstName('Julien');
        $user->setLastName("DOMANGE");
        $user->setPassword("Testmdp01");

        $user->save();
    }

    public function connectAction($params)
    {
        $user = new User();
        $form = $user->configFormConnect();
        $errors = [];
        if(!empty($params["POST"])) {
            $errors = Validate::checkForm($form, $params["POST"]);
            if (empty($errors)) {
                $user->setPassword($params["POST"]["pwd"]);
                $target = [
                    "password"
                ];
                $parameter = [
                    "email" => $params["POST"]["email"]
                ];
                $user->selectSimpleResponse($target, $parameter);
                if(password_verify($params["POST"]["pwd"], $user->getPassword())){
                    $target = [
                        "email",
                        "token"
                    ];
                    $parameter = [
                        "email" => $params["POST"]["email"],
                        "password" => $user->getPassword()
                    ];
                    $user->selectSimpleResponse($target, $parameter);
                    if(!(empty($user->getToken()) && empty($user->getEmail()))){
                        $_SESSION['token'] = $user->getToken();
                        $_SESSION['email'] = $user->getEmail();
                        header("Location:".DIRNAME);
                    }

                }
            }
        }
        $View = new View("user", "User/connect");
        $View->setData("config", $form);
        $View->setData("errors", $errors);
    }

    public function registerAction($params) {
        echo "Register action";

        $user = new User();
        $form = $user->configFormAdd();
        $errors = [];
        if(!empty($params["POST"])) {
            $errors = Validate::checkForm($form, $params["POST"]);
            if (empty($errors)) {
                $user->setFirstName($params["POST"]["firstname"]);
                $user->setLastName($params["POST"]["lastname"]);
                $user->setEmail($params["POST"]["email"]); // voir pour le selectMultipleResponse + confirmEmail
                $user->setEmail($params["POST"]["emailConfirm"]);
                $user->setPassword($params["POST"]["pwd"]);
                $user->setPassword($params["POST"]["pwdConfirm"]);
                $user->save();

                if(!empty($user->getToken())){
                    $_SESSION['token'] = $user->getToken();
                }
            }
        }
        $View = new View("user", "User/register");
        $View->setData("config", $form);
        $View->setData("errors", $errors);

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'user@example.com';                 // SMTP username
            $mail->Password = 'secret';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('from@example.com', 'Mailer');
            $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
            $mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');

            //Attachments
            $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }


    }

    public function disconnectAction($params)
    {
        header("Location:".DIRNAME);
        $_SESSION["token"]=null;
        $_SESSION["email"]=null;
    }

    public function sendMailRegister($mail, $firstName, $lastName) {
        echo'sendMailRegister';

    }
}