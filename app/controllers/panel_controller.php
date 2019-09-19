<?php

require_once 'app/models/panel.php';
require_once 'app/models/categories.php';

class PanelController 
{
    public $panel_model;
    public $view;

    public function __construct($db, $view) 
    {
        $this->panel_model = new Panel($db);
        $this->categories_model = new Categories($db);
        $this->view = $view;
    }

    public function render()
    {
        $categories = $this->categories_model->getCategories();
        $questions = $this->categories_model->getQuestionsAndCategories();
        if (isset($_SESSION['admin']))
        {
            $template = $this->view->loadTemplate('adminMode/panel.php');
        }
        else
        {
            $template = $this->view->loadTemplate('userMode/panel.php');
        }
		echo $template->render( ['session_user'=>$_SESSION['user'], 'session_admin'=>$_SESSION['admin'], "questions"=>$questions, "categories"=>$categories] );
    }

    public function deleteQuestion($id)
    {
        $this->panel_model->deleteQuestion($id);
        echo("<script>location.href = '/panel';</script>");
    }

    public function dispublishQuestion($id)
    {
        $this->panel_model->dispublishQuestion($id);
        echo("<script>location.href = '/panel';</script>");
    }

    public function publishQuestion($id)
    {
        $this->panel_model->publishQuestion($id);
        echo("<script>location.href = '/panel';</script>");
    }

    public function changeCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if (isset($_POST['changecategory']) && isset($_POST['category_id']) && isset($_POST['id']))
            {
                $id = $_POST['id'];
                $category = trim(strip_tags($_POST['category_id']));
                $this->panel_model->updateCategory($id, $category);
                echo("<script>location.href = '/panel';</script>");
            }
        }
    }
}

?>