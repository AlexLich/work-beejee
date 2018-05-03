<?php
namespace App\Controller;

use App\Core\controller;
use App\Service\authService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct($context)
    {
        parent::__construct($context);
        $this->authService = new AuthService;
    }

    public function index()
    {
        $this->view->render('login.html.twig');
    }

    public function login()
    {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $isAuth = $this->authService->login($username, $password);

        header("Location: /");
    }

    public function logout()
    {
        $this->authService->logout();
        header("Location: /");
    }
}
