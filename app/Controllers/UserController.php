<?php

namespace App\Controllers;

use App\QueryBuilder;
use Delight\Auth\Auth;
use League\Plates\Engine;
use Tamtamchik\SimpleFlash\Flash;

class UserController
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

    public function index($id): void
    {
        if (!$this->auth->isLoggedIn()) {
            header('Location: /login');
            exit();
        }
        if (!$this->auth->hasRole('admin') && $this->auth->id() != $id) {
            Flash::error('Можно редактировать только свой аккаунт');
        }

        echo $this->templates->render('page_users', ['flash' => Flash::display()]);
    }
}