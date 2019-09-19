<?php

require_once 'app/controllers/categories_controller.php';
require_once 'app/controllers/login_controller.php';
require_once 'app/controllers/admins_controller.php';
require_once 'app/controllers/panel_controller.php';
require_once 'app/controllers/question_controller.php';
require_once 'app/controllers/suggestions_controller.php';
require_once 'app/controllers/users_controller.php';

$app->get('/', function($request, $response, $args) {
    $controller = new CategoriesController($this->db, $this->view);

    $controller->index();
});

$app->get('/about', function($request, $response, $args) {
    echo $this->view->loadTemplate('about.php')->render(['session_user'=>$_SESSION['user'], 'session_admin'=>$_SESSION['admin']]);
});

# LOGIN/REGISTRATION

$app->get('/login', function($request, $response, $args) {
	echo $this->view->loadTemplate('login.php')->render(['session_user'=>$_SESSION['user'], 'session_admin'=>$_SESSION['admin']]);
});

$app->get('/login_admin', function($request, $response, $args) {
	echo $this->view->loadTemplate('login_admin.php')->render(['session_user'=>$_SESSION['user'], 'session_admin'=>$_SESSION['admin']]);
});

$app->get('/register', function($request, $response, $args) {
	echo $this->view->loadTemplate('register.php')->render(['session_user'=>$_SESSION['user'], 'session_admin'=>$_SESSION['admin']]);
});

$app->post('/login/check', function($request, $response, $args) {
	$controller = new LoginController($this->db, $this->view);

    $controller->checkUser();
});

$app->post('/login_admin/check', function($request, $response, $args) {
	$controller = new LoginController($this->db, $this->view);

    $controller->checkAdmin();
});

$app->post('/register/check', function($request, $response, $args) {
	$controller = new LoginController($this->db, $this->view);

    $controller->checkRegistration();
});

$app->get('/login/logout', function($request, $response, $args) {
	$controller = new LoginController($this->db, $this->view);

    $controller->logout();
});

# PANEL

$app->get('/panel', function($request, $response, $args) {
	$controller = new PanelController($this->db, $this->view);

    $controller->render();
});

# ADMIN FUNCTIONALITY

$app->post('/panel/change_category', function($request, $response, $args) {
	$controller = new CategoriesController($this->db, $this->view);

    $controller->changeCategory();
});

$app->get('/edit_question/{id}', function($request, $response, $args) {
	$controller = new QuestionController($this->db, $this->view);

    $controller->renderEditQuestion($this->urlId);
});

$app->post('/edit_question/submission', function($request, $response, $args) {
	$controller = new QuestionController($this->db, $this->view);

    $controller->editQuestion();
});

$app->get('/panel/delete_question/{id}', function($request, $response, $args) {
	$controller = new PanelController($this->db, $this->view);

    $controller->deleteQuestion($this->urlId);
});

$app->get('/panel/dispublish_question/{id}', function($request, $response, $args) {
	$controller = new PanelController($this->db, $this->view);

    $controller->dispublishQuestion($this->urlId);
});

$app->get('/panel/publish_question/{id}', function($request, $response, $args) {
	$controller = new PanelController($this->db, $this->view);

    $controller->publishQuestion($this->urlId);
});

$app->get('/suggestions', function($request, $response, $args) {
	$controller = new SuggestionsController($this->db, $this->view);

    $controller->renderSuggestions();
});

$app->get('/suggestions/delete_suggestion/{id}', function($request, $response, $args) {
	$controller = new SuggestionsController($this->db, $this->view);

    $controller->deleteSuggestion($this->urlId);
});

$app->get('/suggestions/publish_suggestion/{id}', function($request, $response, $args) {
	$controller = new SuggestionsController($this->db, $this->view);

    $controller->publishSuggestion($this->urlId);
});

$app->get('/admins', function($request, $response, $args) {
	$controller = new AdminsController($this->db, $this->view);

    $controller->render();
});

$app->get('/admins/delete_admin/{id}', function($request, $response, $args) {
	$controller = new AdminsController($this->db, $this->view);

    $controller->deleteAdmin($this->urlId);
});

$app->post('/admins/make_user', function($request, $response, $args) {
	$controller = new AdminsController($this->db, $this->view);

    $controller->makeUser();
});

$app->post('/admins/change_password', function($request, $response, $args) {
	$controller = new AdminsController($this->db, $this->view);

    $controller->changePassword();
});

$app->get('/users', function($request, $response, $args) {
	$controller = new UsersController($this->db, $this->view);

    $controller->renderUsers();
});

$app->get('/users/delete_user/{id}', function($request, $response, $args) {
	$controller = new UsersController($this->db, $this->view);

    $controller->deleteUser($this->urlId);
});

$app->post('/users/make_admin', function($request, $response, $args) {
	$controller = new AdminsController($this->db, $this->view);

    $controller->makeAdmin();
});

$app->post('/users/change_password', function($request, $response, $args) {
	$controller = new UsersController($this->db, $this->view);

    $controller->changePassword();
});

$app->get('/categories', function($request, $response, $args) {
	$controller = new CategoriesController($this->db, $this->view);

    $controller->renderCategories();
});

$app->get('/categories/delete_category/{id}', function($request, $response, $args) {
	$controller = new CategoriesController($this->db, $this->view);

    $controller->deleteCategory($this->urlId);
});

$app->post('/categories/change_title', function($request, $response, $args) {
	$controller = new CategoriesController($this->db, $this->view);

    $controller->changeTitle();
});

$app->post('/categories/add_category', function($request, $response, $args) {
	$controller = new CategoriesController($this->db, $this->view);

    $controller->addCategory();
});


# USER FUNCTIONALITY

$app->get('/give_a_suggestion/{id}', function($request, $response, $args) {
	$controller = new SuggestionsController($this->db, $this->view);

    $controller->renderSuggestionForm($this->urlId);
});

$app->post('/give_a_suggestion/submission/{id}', function($request, $response, $args) {
	$controller = new SuggestionsController($this->db, $this->view);

	$controller->give();
});

$app->get('/ask_question', function($request, $response, $args) {
	$controller = new QuestionController($this->db, $this->view);

	$controller->renderAskQuestion();
});

$app->post('/ask_question', function($request, $response, $args) {
	$controller = new QuestionController($this->db, $this->view);

	$controller->ask();
});

$app->get('/settings', function($request, $response, $args) {
	$controller = new UsersController($this->db, $this->view);

    $controller->renderSettings();
});

$app->post('/settings/change_username', function($request, $response, $args) {
	$controller = new UsersController($this->db, $this->view);

    $controller->changeUsername();
});

$app->post('/settings/change_email', function($request, $response, $args) {
	$controller = new UsersController($this->db, $this->view);

    $controller->changeEmail();
});

$app->post('/settings/change_password', function($request, $response, $args) {
	$controller = new UsersController($this->db, $this->view);

    $controller->changePassword();
});



?>