<?php

namespace App\apps\Register\MVC;



use App\apps\PHPMailer\Exception;
use App\apps\PHPMailer\PHPMailer;
use App\apps\PHPMailer\SMTP;
use App\apps\User\UserDatabase;
use App\apps\Util\AbstractMVC\AbstractController;

class RegisterController extends AbstractController
{
    private UserDatabase $userDatabase;
    private LoginAuthenticator $loginAuthenticator;

    public function __construct(
        UserDatabase $userDatabase,
        LoginAuthenticator $loginAuthenticator,
        Exception $exception,
        PHPMailer $PHPMailer,
        SMTP $SMTP
    )
    {
        $this->userDatabase = $userDatabase;
        $this->loginAuthenticator = $loginAuthenticator;
        $this->exception = $exception;
        $this->PHPMailer = $PHPMailer;
        $this->SMTP = $SMTP;
    }

    function buildStayIn($userid){

        try {
            $identifier = bin2hex(time() . random_bytes(8));
        } catch (\Exception $e) {
            echo "identifier gone wrong";
        }

        try {
            $securityToken = bin2hex(time() . random_bytes(10));
        } catch (\Exception $e) {
            echo "token gone wrong";
        }
        $this->userDatabase->newStayIn($userid, $identifier, password_hash($securityToken, PASSWORD_DEFAULT));

        setcookie("identifier", $identifier, time() + (3600*24*356));
        setcookie("securityToken", $securityToken, time() + (3600*24*356));
    }


    public function action()
    {
        $fail = null;
        $wrongPassword = null;
        $userid = null;

        if(isset($_POST['submitLogin']))
        {
            $email = $_POST["email"];
            $password = $_POST["password"];



            $user = $this->userDatabase->getUser("",$email);
            $hash = $user->password;
            $userid = $user->userid;
            $username = $user->username;

            if ($this->loginAuthenticator->checkLogin($password, $hash))
            {
                if(isset($_POST["stayin"]))
                {
                    $this->buildStayIn($userid);
                }

                session_regenerate_id(true);

                $_SESSION["username"] = $username;
                $_SESSION["userid"] = $userid;
                $_SESSION["login"] = true;

                echo '<script> window.location="/?App=UserDashboard"; </script>';
            }
            else
            {
                $wrongPassword = "sorry, wrong password";
                $this->pageload("Register", "registration",['wrongPassword' => $wrongPassword]);
            }

        }


        if(isset($_POST['submitRegistration']))
        {
            $firstName = $_POST["firstName"];
            $lastName = $_POST["lastName"];
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

            $user = $this->userDatabase->getUser('',$email);
            if (empty($user))
            {
                //$this->userDatabase->newUser($firstName, $lastName, $username, $email, $password);

                try {
                    //Server settings
                    $this->PHPMailer->SMTPDebug = SMTP::DEBUG_SERVER;           //Enable verbose debug output
                    $this->PHPMailer->isSMTP();                                 //Send using SMTP
                    $this->PHPMailer->Host       = 'smtp.gmail.com';            //Set the SMTP server to send through
                    $this->PHPMailer->SMTPAuth   = true;                        //Enable SMTP authentication
                    $this->PHPMailer->Username   = 'php.sauron@gmail.com';      //SMTP username
                    $this->PHPMailer->Password   = '';          //SMTP password
                    $this->PHPMailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
                    $this->PHPMailer->Port       = 587;                         //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $this->PHPMailer->setFrom('php.sauron@gmail.com', 'Sauron');
                    $this->PHPMailer->addAddress('php.sauron@gmail.com', "$username"); //Name is optional
                    $this->PHPMailer->addReplyTo('php.sauron@gmail.com', 'Information');
                    $this->PHPMailer->addCC('php.sauron@gmail.com');

                    //Content
                    $this->PHPMailer->isHTML(true);            //Set email format to HTML
                    $this->PHPMailer->Subject = 'Here is the subject';
                    $this->PHPMailer->Body    = 'This is the HTML message body <b>in bold!</b>';
                    $this->PHPMailer->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    $this->PHPMailer->send();
                    echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$this->PHPMailer->ErrorInfo}";
                }

            }else{
                $fail = "A User with this email address already exists";
            }
        }

        $this->pageload("Register", "registration",['fail' => $fail]);
    }

    public function logout(){

        session_unset();

        $this->pageload("Register", "registration",[]);
    }


}