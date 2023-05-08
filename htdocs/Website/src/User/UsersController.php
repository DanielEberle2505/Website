<?php

namespace App\User;

use App\Core\AbstractController;
use PDO;

//Klasse zum Kontrollieren der "Games" (verwalten)
class UsersController extends AbstractController {

    public function __construct(UsersRepository $usersRepository) {
        //das Dazugehörige Repository, die die Datensätze aus der Datenbank verwaltet
        $this->usersRepository = $usersRepository;
    }

    /**
     * Funktion, die den Loginprozess darstellt.
     * holt sich alle "User" und rendert die view login
     * Wenn etwas über die view Login übergeben wurde,
     * wird überprüft, ob das Password und der name stimmt, wenn dies zutrifft,
     * wird eine Session gestartet und die Id sowohl auch die Id der Rolle des Users,
     * wird in der Session Variable zwischengespeichert und der user wird auf die Homepage weitergeleitet,
     * wenn das password oder der name nicht stimmt, wird der User zurück auf die loginpage geleitet
     */
    public function login() {

        if (isset($_POST['loginButton'])) {
            $name = $_POST['username'];
            $pass = $_POST['pw'];
            $user = $this->usersRepository->findByName($name);


            if (password_verify($pass, $user['password']) && $name == $user->name) {
                session_start();
                $_SESSION['id'] = $user['id'];
                $_SESSION['role'] = $user['userroleid'];
                header('location:/Website/public/index.php/index');
            } else {
                echo "Your username or password has not been found";
            }
        }


        $users = $this->usersRepository->all();
        $this->render("user/login", [
            'users' => $users
        ]);
    }


    /**
     *Funktion, die dafür da ist, den Registrierungsprozess darzustellen.
     * holt sich alle "User" und rendert die view register
     * Wenn ein Userinput von der view register erfasst wurde wird überprüft,
     * ob der Userinput(name && passwort) mit einem existierenden Eintrag übereinstimmen,
     * wenn ja, wird der User eingeloggt("coder sehr ähnlich zu login(), mehr dazu da")
     */
    public function register() {
        if (isset($_POST['registerButton'])) {
            $name = $_POST['username'];
            $pass = $_POST['pw'];
            $users = $this->usersRepository->all();
            foreach ($users as $user) {
                if ($user->name == $name && $user->password == password_hash($pass, PASSWORD_DEFAULT)) {
                    session_start();

                    $_SESSION['id'] = $user->id;
                    $_SESSION['role'] = $user->userroleid;

                    header('location:/Website/public/index.php/index');
                    die();
                } else {
                    session_start();
                    $this->usersRepository->addUser($name, password_hash($pass, PASSWORD_DEFAULT));
                    session_start();
                    $_SESSION['id'] = $user->id;
                    $_SESSION['role'] = $user->userroleid;
                    header('location:/Website/public/index.php/index');
                }
                die();


            }
        }
        $users = $this->usersRepository->all();
        $this->render("user/register", [
            'users' => $users
        ]);

    }

    /**
     * Funktion, die sich alle "User" holt die view userlist rendert
     */
    public function ShowUserlist()
    {

        $users = $this->usersRepository->all();

        $this->render("user/userlist", [
            'users' => $users,

        ]);


    }
    /*Funktion, die den Logoutprozess modelliert**/
    public function logout() {
        session_start();
        session_unset();
        header('location:/Website/public/index.php/login');
    }
    /*Funktion, die das Password, wenn der Username mit einem in der datenbank eingetragenen User übereinstimmt, umändert**/
    public function newPass() {
        if (isset($_POST['updatePassword'])) {
            $newPass =password_hash($_POST['newPassword'],PASSWORD_DEFAULT);
            $name = $_POST['name'];
            if ($this->usersRepository->findByName($name)) {
                $this->usersRepository->updatePassword($newPass,$name);
                session_start();
                $user = $this->usersRepository->findByName($name);
                $_SESSION['id'] = $user->id;
                $_SESSION['role'] = $user->userroleid;
                header('location:/Website/public/index.php/index');
            }else {
                echo "The User wasnt found";
            }
        }
        $this->render("user/pass", "");
    }

    /*Funktion, die einen User und seine Rolle (0=Admin,1=Mod,2=User*) in der showUser view rendert, wenn der submit Button in der view gedrückt wird, wird die Rolle umgeändert*/
    public function showUser() {
        $name=$_GET['name'];
        $user=$this->usersRepository->findByName($name);
        $stmt=true;
        if(isset($_POST['changeRoleButton'])) {
            $role=$_POST['roles'];
            
              if($role=="Admin") {
                $this->usersRepository->updateRole(0, $user->name);
              }
              elseif($role=="Mod") {
                $this->usersRepository->updateRole(1, $user->name);
              }
              elseif($role=="User") {
                $this->usersRepository->updateRole(2, $user->name);
              }

            header('location:/Website/public/index.php/userlist');
        }
        $this->render("user/showUser",["user"=>$user, "stmt"=>$stmt]);
    }
}


