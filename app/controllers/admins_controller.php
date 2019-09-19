<?php

require_once 'app/models/admins.php';

class AdminsController
{

    public $model;
    public $view;

    public function __construct($db, $view) 
    {
        $this->model = new Admins($db);
        $this->view = $view;
    }

    public function render()
    {
        $admins = $this->model->getAdmins();
        echo $this->view->loadTemplate('adminMode/admins.php')->render( ['session_user'=>$_SESSION['user'], 'session_admin'=>$_SESSION['admin'], 'admins'=>$admins] );
    }

    public function deleteAdmin($id)
    {
        $this->model->deleteAdmin($id);
        echo("<script>location.href = '/admins';</script>");
    }

    public function makeAdmin()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") 
        {
            if (isset($_POST['makeadmin']))
            {
                if (isset($_POST['login']) && isset($_POST['id']) && isset($_POST['email'])) 
                {
                    $email = trim(strip_tags($_POST['email']));
                    $login = trim(strip_tags($_POST['login']));
                    $id = $_POST['id'];
                    $this->model->makeAdmin($email, $login, $id);
                    echo("<script>location.href = '/users';</script>");
                }
            }
        }   
    }


    public function makeUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") 
        {
            if (isset($_POST['makeuser']))
            {
                if (isset($_POST['login']) && isset($_POST['id']) && isset($_POST['email'])) 
                {
                    $email = trim(strip_tags($_POST['email']));
                    $login = trim(strip_tags($_POST['login']));
                    $id = $_POST['id'];
                    $this->model->makeUser($email, $login, $id);
                    echo("<script>location.href = '/admins';</script>");
                }
            }
        }   
    }

    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") 
        {
            if (isset($_POST['changepassword']))
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
                        echo("<script>location.href = '/admins';</script>");
                    }
                    else 
                    {
                        $this->render();
                        echo("
                        <script>
                            var errorTag = document.querySelector('.error_message');
                            errorTag.innerHTML = 'Incorrect username or password.'; 
                        </script>
                        ");
                    }
                }
                else 
                {
                    $this->render();
                    echo("
                    <script>
                        var errorTag = document.querySelector('.error_message');
                        errorTag.innerHTML = 'Incorrect username or password.'; 
                    </script>
                    ");
                }
            }
        }   
    }
}