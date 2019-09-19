<?php

require_once 'app/models/users.php';

class UsersController
{

    public $model;
    public $view;

    public function __construct($db, $view) 
    {
        $this->model = new Users($db);
        $this->view = $view;
    }

    public function renderUsers()
    {
        $users = $this->model->getUsers();
        if (isset($_SESSION['admin']))
        {
            echo $this->view->loadTemplate('adminMode/users.php')->render( ['session_user'=>$_SESSION['user'], 'session_admin'=>$_SESSION['admin'], 'users'=>$users] );;
        }
    }

    public function renderSettings()
    {
        $user = $_SESSION['user'];
        $user_info = $this->model->getUser($user);
		echo $this->view->loadTemplate('userMode/settings.php')->render( ['session_user'=>$user, 'user_info'=>$user_info] );
    }

    public function deleteUser($id)
    {
        $this->model->deleteUser($id);
        echo("<script>location.href = '/users';</script>");
    }

    
    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['changepassword'])) 
        {
            if (isset($_POST['id']) && !empty($_POST['old_pass']) && !empty($_POST['new_pass']) && !empty($_POST['confirm_pass'])) 
            {
                $id = $_POST['id'];
                $old_pass = md5(trim(strip_tags($_POST['old_pass'])));
                $new_pass = md5(trim(strip_tags($_POST['new_pass'])));
                $confirm_pass = md5(trim(strip_tags($_POST['confirm_pass'])));
                if ($confirm_pass == $new_pass)
                {
                    $this->model->changePassword($id, $old_pass, $new_pass);
                    if (isset($_SESSION['admin'])) 
                    {
                        echo("<script>location.href = '/users';</script>");
                        exit();    
                    }
                    echo("<script>location.href = '/settings';</script>");
                }
                else 
                {
                    $this->renderSettings();
                    echo("
                        <script>
                            var errorTag = document.querySelector('.error_message');
                            errorTag.innerHTML = 'Passwords do not match.'; 
                        </script>
                    ");
                }
            }
            else 
            {
                $this->renderSettings();
                echo("
                    <script>
                        var errorTag = document.querySelector('.error_message');
                        errorTag.innerHTML = 'Please, fill all inputs properly.'; 
                    </script>
                ");
            }
        }   
    }

    public function changeUsername()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['changeusername'])) 
        {
            if (isset($_POST['login']) && isset($_POST['id'])) 
            {
                $login = trim(strip_tags($_POST['login']));
                $id = $_POST['id'];
                if ($this->model->findUsername($login))
                {
                    $this->renderSettings();
                    echo("
                        <script>
                            var errorTag = document.querySelector('.error_message');
                            errorTag.innerHTML = 'This username is already taken.'; 
                        </script>
                    ");   
                }
                else
                {
                    $this->model->changeUsername($id, $login);
                    $_SESSION['user'] = $login;
                    echo("<script>location.href = '/settings';</script>");
                }
            }
        }   
    }

    public function changeEmail()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['changeemail'])) 
        {
            if (isset($_POST['email']) && isset($_POST['id'])) 
            {
                $email = trim(strip_tags($_POST['email']));
                $id = $_POST['id'];
                if ($this->model->findEmail($email))
                {
                    $this->renderSettings();
                    echo("
                        <script>
                            var errorTag = document.querySelector('.error_message');
                            errorTag.innerHTML = 'This email is already taken.'; 
                        </script>
                    ");
                        
                }
                else 
                {
                    $this->model->changeEmail($id, $email);
                    echo("<script>location.href = '/settings';</script>");
                }
            }
        }
    }
}