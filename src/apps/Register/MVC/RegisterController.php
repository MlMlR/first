<?php

namespace App\apps\Register\MVC;



use App\apps\User\UserDatabase;
use App\apps\Util\AbstractMVC\AbstractController;

class RegisterController extends AbstractController
{
    private UserDatabase $userDatabase;
    private LoginAuthenticator $loginAuthenticator;

    public function __construct(UserDatabase $userDatabase,
                                LoginAuthenticator $loginAuthenticator)
    {
        $this->userDatabase = $userDatabase;
        $this->loginAuthenticator = $loginAuthenticator;
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
                $this->userDatabase->newUser($firstName, $lastName, $username, $email, $password);
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