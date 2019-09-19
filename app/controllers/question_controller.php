<?php

require_once 'app/models/question.php';
require_once 'app/models/categories.php';

class QuestionController
{

    public $question_model;
    public $categories_model;
    public $view;

    public function __construct($db, $view) 
    {
        $this->question_model = new Question($db);
        $this->categories_model = new Categories($db);
        $this->view = $view;
    }

    public function renderAskQuestion()
    {
        $categories = $this->categories_model->getCategories();
        echo $this->view->loadTemplate('userMode/ask_question.php')->render( ['session_user'=>$_SESSION['user'], 'session_admin'=>$_SESSION['admin'], 'categories'=>$categories] );
    }

    public function renderEditQuestion($id)
    {
        $question_info = $this->question_model->getQuestion($id);
        echo $this->view->loadTemplate('adminMode/edit_question.php')->render( ['session_user'=>$_SESSION['user'], 'session_admin'=>$_SESSION['admin'], 'question_info'=>$question_info] );
    
    }

    public function editQuestion()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if (isset($_POST['update']) && isset($_POST['id']) && isset($_POST['question']) && isset($_POST['author']) && isset($_POST['answer']) && isset($_POST['email']) && isset($_POST['visibility']) )
            {
                $id = trim(strip_tags($_POST['id']));
                $question = trim(strip_tags($_POST['question']));
                $author = trim(strip_tags($_POST['author']));
                $email = trim(strip_tags($_POST['email']));
                $answer = trim(strip_tags($_POST['answer']));
                $visibility = trim(strip_tags($_POST['visibility']));
                if ($visibility ==  '1')
                {
                    $this->question_model->updatePublic($id, $question, $author, $email, $answer);
                    echo("<script>location.href = '/panel';</script>");
                }
                else {
                    $this->question_model->update($id, $question, $author, $email, $answer);
                    echo("<script>location.href = '/panel';</script>");
                }
            }
            else 
            {
                $this->renderEditQuestion($_POST['id']);
                echo("
                    <script>
                        var errorTag = document.querySelector('.error_message');
                        errorTag.innerHTML = 'Please, fill all inputs properly.';
                    </script>
                    ");
            }
        }
    }

    public function ask()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") 
        {
            if (isset($_POST['question_submit']))
            {
                if (!empty($_POST['question_author']) && !empty($_POST['question_category']) && !empty($_POST['question_body'])) 
                {
                    $author = trim(strip_tags($_POST['question_author']));
                    $email_array = $this->question_model->getEmailByUsername($author);  
                    $email = $email_array[0]['email'];
                    $category = trim(strip_tags($_POST['question_category']));
                    $question = trim(strip_tags($_POST['question_body']));
                    $this->question_model->insertQuestion($question, $author, $email, $category);
                    echo("<script>location.href = '/panel';</script>");
                    exit();
                }
                else 
                {
                    echo $this->view->loadTemplate('userMode/ask_question.php')->render(['session_user'=>$_SESSION['user'], 'session_admin'=>$_SESSION['admin'], 'categories'=>$categories]);
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
}


























?>