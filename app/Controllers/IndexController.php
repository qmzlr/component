<?php
namespace App\Controllers;
use App\QueryBuilder;
use Delight\Auth\Auth;
use JetBrains\PhpStorm\NoReturn;
use League\Plates\Engine;

class IndexController
{
    protected Engine $templates;
    protected Auth $auth;
    protected QueryBuilder $qb;

    public function __construct(QueryBuilder $qb, Engine $engine, Auth $auth)
    {
        $this->qb = $qb;
        $this->templates = $engine;
        $this->auth = $auth;
    }
    #[NoReturn] public function index(): void
    {
        echo 'index';
        if (!$this->auth->isLoggedIn()){
            header('Location: /login');
        }else{
            header('Location: /users');
        }
        exit;
    }
    public function login(): void
    {

        echo $this->templates->render('page_login');
    }
    public function register(): void
    {
        echo 'register';
    }
}