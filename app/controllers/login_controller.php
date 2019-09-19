<?php 

require_once 'app/models/login.php';


class LoginController 
{

    public $model;
    public $view;

    public function __construct($db, $view) 
    {
        $this->model = new Login($db);
        $this->view = $view;
    }

    public function checkUser() 
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')   
        {
            if (isset($_POST['sign_in']))
            {
                if (!empty($_POST['login']) && !empty($_POST['pass']))
                {
                    $login = trim(strip_tags($_POST['login']));
                    $pass = md5(trim(strip_tags($_POST['pass'])));
                    if ($this->model->findUser($login, $pass))
                    {
                        $_SESSION['user'] = $login;
                        echo("<script>location.href = '/panel';</script>");
                        exit();
                    }
                    else
                    {
                        echo $this->view->loadTemplate('login.php')->render([]);
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
                    echo $this->view->loadTemplate('login.php')->render([]);
                    echo("
                        <script>
                            var errorTag = document.querySelector('.error_message');
                            errorTag.innerHTML = 'Please, fill all inputs properly.';
                        </script>
                        ");
                }  
            }
        }
    }

    public function checkAdmin() 
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')   
        {
            if (isset($_POST['sign_in']))
            {
                if (!empty($_POST['login']) && !empty($_POST['pass']))
                {
                    $login = trim(strip_tags($_POST['login']));
                    $pass = md5(trim(strip_tags($_POST['pass'])));
                    if ($this->model->findAdmin($login, $pass))
                    {
                        $_SESSION['admin'] = $login;
                        echo("<script>location.href = '/panel';</script>");
                        exit();
                    }
                    else
                    {
                        echo $this->view->loadTemplate('login_admin.php')->render([]);
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
                    echo $this->view->loadTemplate('login_admin.php')->render([]);
                    echo("
                        <script>
                            var errorTag = document.querySelector('.error_message');
                            errorTag.innerHTML = 'Please, fill all the inputs properly.';
                        </script>
                    ");
                }  
            }
        }
    }

    public function checkRegistration()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')   
        {
            if (isset($_POST['sign_in']))
            {
                if (!empty($_POST['login']) && !empty($_POST['email']) && !empty($_POST['pass']) && !empty($_POST['pass_2']))
                {
                    if ($_POST['pass'] == $_POST['pass_2']) 
                    {
                        $login = trim(strip_tags($_POST['login']));
                        $email = trim(strip_tags($_POST['email']));
                        $pass = md5(trim(strip_tags($_POST['pass'])));
                        if ($this->model->isUser($login))
                        {
                            echo $this->view->loadTemplate('register.php')->render([]);
                            echo("
                                <script>
                                    var errorTag = document.querySelector('.error_message');
                                    errorTag.innerHTML = 'This user alredy exists.';
                                </script>
                            ");
                        }
                        else 
                        {
                            $this->model->registerUser($email, $login, $pass);
                            $_SESSION['user'] = $login;
                            echo("<script>location.href = '/panel';</script>");
                            exit();
                        }
                    }
                    else 
                    {
                        echo $this->view->loadTemplate('register.php')->render([]);
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
                    echo $this->view->loadTemplate('register.php')->render([]);
                    echo("
                        <script>
                            var errorTag = document.querySelector('.error_message');
                            errorTag.innerHTML = 'Please, fill all inputs properly.';
                        </script>
                    ");
                }   
            }
        }
    } 

    
    public function logout() 
    {
        session_destroy();
        echo("<script>location.href = '/';</script>");
        exit();
    }


}