<?php

require_once 'app/models/categories.php';
require_once 'app/models/question.php';

class CategoriesController
{

    public $categories_model;
    public $question_model; 
    public $view;

    public function __construct($db, $view) 
    {
        $this->categories_model = new Categories($db);
        $this->question_model = new Question($db);
        $this->view = $view;
    }

    public function index() 
	{

        $categories = $this->categories_model->getCategories();

        foreach ($categories as $category)
		{
			$questions[$category['category']]=$this->categories_model->getQuestionsByCat($category['category']);
        }

        echo $this->view->loadTemplate('index.php')->render(['questions'=>$questions, 'session_user'=>$_SESSION['user'], 'session_admin'=>$_SESSION['admin'], 'categories'=>$categories]);

    }

    public function renderCategories()
    {
        $categories = $this->categories_model->getCategories();
		echo $this->view->loadTemplate('adminMode/categories.php')->render( ['session_user'=>$_SESSION['user'], 'session_admin'=>$_SESSION['admin'], 'categories'=>$categories] );
    }

    public function addCategory()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST")
        {
            if (!empty($_POST['new_category']))
            {
                $category = trim(strip_tags($_POST['new_category']));
                $this->categories_model->addCategory($category);
                echo("<script>location.href = '/categories';</script>");
            }
            else 
            {
                $this->renderCategories();
                echo("
                    <script>
                        var errorTag = document.querySelector('.error_message');
                        errorTag.innerHTML = 'Please, fill all inputs properly.';
                    </script>
                    ");
            }
        }
    }

    public function deleteCategory($id)
    {
        $this->categories_model->deleteCategory($id);
        echo("<script>location.href = '/categories';</script>");
    }

    public function changeCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if (isset($_POST['changecategory']) && isset($_POST['category_id']) && isset($_POST['id']))
            {
                $id = $_POST['id'];
                $category_id = trim(strip_tags($_POST['category_id']));
                $this->question_model->changeCategory($id, $category_id);
                echo("<script>location.href = '/panel';</script>");
            }
        }
    }

    public function changeTitle()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if (isset($_POST['id']) && !empty($_POST['new_title']))
            {
                $category = trim(strip_tags($_POST['new_title']));
                $id = $_POST['id'];
                $this->categories_model->updateCategory($id, $category);
                echo("<script>location.href = '/categories';</script>");
            }
            else 
            {
                $this->renderCategories();
                echo("
                    <script>
                        var errorTag = document.querySelector('.error_message');
                        errorTag.innerHTML = 'New title missing!';
                    </script>
                    ");
            }
        }
    }

}