<?php 

require_once 'app/models/suggestions.php';
require_once 'app/models/question.php';

class SuggestionsController
{

    public $suggestions_model;
    public $question_model;
    public $view;

    public function __construct($db, $view) 
    {
        $this->suggestions_model = new Suggestions($db);
        $this->question_model = new Question($db);
        $this->view = $view;
    }

    public function renderSuggestions()
    {
        $suggestions = $this->suggestions_model->getSuggestions();
        echo $this->view->loadTemplate('adminMode/suggestions.php')->render( ['session_admin'=>$_SESSION['admin'], 'suggestions'=>$suggestions] );
    }

    public function renderSuggestionForm($id)
    {
        $question_info = $this->question_model->getQuestion($id);
        echo $this->view->loadTemplate('userMode/give_a_suggestion.php')->render( ['session_user'=>$_SESSION['user'], 'question_info'=>$question_info] );
    }

    public function deleteSuggestion($id)
    {
        $this->suggestions_model->deleteSuggestion($id);
        echo("<script>location.href = '/suggestions';</script>");
    }

    public function publishSuggestion($id)
    {
        $this->suggestions_model->publishSuggestion($id);
        echo("<script>location.href = '/suggestions';</script>");
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if (isset($_POST['update']) && isset($_POST['id']) && isset($_POST['question']) && isset($_POST['username']) && isset($_POST['suggestion']) && isset($_POST['email']) )
            {
                $id = trim(strip_tags($_POST['id']));
                $question = trim(strip_tags($_POST['question']));
                $username = trim(strip_tags($_POST['username']));
                $email = trim(strip_tags($_POST['email']));
                $suggestion = trim(strip_tags($_POST['suggestion']));


                $this->suggestions_model->updateSuggestion($id, $question, $username, $email, $suggestion);
                echo("<script>location.href = '/suggestions';</script>");
            }
        }
    }

    public function give()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if (isset($_POST['suggest']) && isset($_POST['id']) && isset($_POST['suggestion']) && isset($_POST['username']) && !empty($_POST['suggestion']))
            {
                $question_id = $_POST['id'];
                $question_info = $this->question_model->getQuestion($question_id);
                $question = $question_info[0]['question'];
                
                $category_id_info = $this->question_model->getCategoryIdById($question_id);
                $category_id = $category_id_info[0]['category_id'];

                $suggestion = trim(strip_tags($_POST['suggestion']));
                $username = trim(strip_tags($_POST['username']));
                $email_array = $this->question_model->getEmailByUsername($username);  
                $email = $email_array[0]['email'];
                $this->suggestions_model->giveSuggestion($question_id, $username, $question, $suggestion, $email, $category_id);

                echo("<script>location.href = '/panel';</script>");
                exit();
            }
            else 
            {
                $this->renderSuggestionForm($_POST['id']);
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